<?php

namespace Reinholdjesse\Usermanager\Livewire\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    private $paginate = 50;
    public $search;
    public $openEdit = false;

    public $editId = null;
    public $tempProfilePhoto = null;

    public $name = null;
    public $email = null;
    public $password = null;

    public $folder = 'users/';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (!empty($this->search)) {
            $content = User::where(function ($query) {
                return $query
                    ->where('name', 'LIKE', '%' . trim($this->search) . '%')
                    ->orWhere('email', 'LIKE', '%' . trim($this->search) . '%');
            })->orderBy('name')->paginate($this->paginate);
        } else {
            $content = User::orderBy('name')->paginate($this->paginate);
        }
        return view('usermanager::livewire.user.index', compact('content'));
    }

    public function create()
    {
        $this->clear();
        $this->openEditWindow();
    }

    public function edit(User $user)
    {
        $this->clear();
        $this->editId = $user->id;

        $this->name = $user->name;
        $this->email = $user->email;

        $this->openEditWindow();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'nullable|email|min:3',
            'password' => 'nullable|string|min:3',
        ]);

        if (!empty($this->editId)) {
            //update
            $query = User::find($this->editId);
        } else {
            // create
            $query = new User;
        }

        $query->name = $this->name;
        $query->email = $this->email;

        if (!empty($this->password)) {
            $query->password = Hash::make($this->password);
        }

        if (!empty($this->tempProfilePhoto)) {

            $filename = strtolower(Str::slug($this->name)) . '.jpg';
            $this->tempProfilePhoto->storeAs($this->folder, $filename, 'app');
            $query->profile_photo_url = $this->folder . $filename;
        }

        $this->cloasEditWindow();
        $this->clear();

        if ($query->save()) {
            $this->bannerMessage('success', 'User wurde erfolgreich erstellt.');
        } else {
            $this->bannerMessage('success', 'User wurde erfolgreich aktualisiert.');
        }
    }

    public function openEditWindow()
    {
        $this->openEdit = true;
    }

    public function cloasEditWindow()
    {
        $this->openEdit = false;
    }

    public function deleteProfilePhoto()
    {
        if ($this->deleteImage($this->profile_photo_url)) {
            User::where('id', $this->editId)->update([
                'profile_photo_url' => null,
            ]);
            $this->profile_photo_url = null;
        }
    }

    public function removeTempProfilePhoto()
    {
        $this->tempProfilePhoto = null;
    }

    public function delete(User $user)
    {
        if (isset($user->profile_photo_url) && !empty($user->profile_photo_url) && file_exists(public_path($user->profile_photo_url))) {
            $this->deleteImage(public_path($user->profile_photo_url));
        }

        if (User::where('id', $user->id)->delete()) {
            $this->bannerMessage('success', 'User wurde erfolgreich gelöscht.');
        } else {
            $this->bannerMessage('danger', 'Fehler beim löschen des Users.');
        }
    }

    public function switchUser(User $id)
    {
        Auth::user()->impersonate($id);
        return redirect()->route('package.users.manager.user.index');
    }

    private function clear()
    {
        $this->editId = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
    }

    private function deleteImage(string $path)
    {
        try {
            return unlink($path);
        } catch (Exception $e) {
            unset($e);
        }
        return false;
    }

    private function bannerMessage(string $type, string $message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => $type,
            'message' => $message,
        ]);
    }
}
