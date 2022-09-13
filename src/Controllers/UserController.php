<?php

namespace Reinholdjesse\Usermanager\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function userImagesCheck()
    {
        $users = User::whereNotNull('profile_photo_url')->get();

        foreach ($users as $user) {
            if (!file_exists($user->profile_photo_url)) {
                User::where('id', $user->id)->update([
                    'profile_photo_url' => null,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                print '<pre>';
                print_r($user);
                print '</pre>';
            }
        }
    }

    public function imageFolderCheck()
    {
        $path = 'users';
        $files = scandir('./' . $path);

        print '<pre>';
        print 'Datei wurde nicht gefunden in der Datenbank.';
        print '<br />';
        print '<br />';

        foreach ($files as $file) {
            if ($file != '..' && $file != '.') {
                if (!User::where('profile_photo_url', 'LIKE', '%' . $file . '%')->exists()) {
                    print_r($path . '/' . $file);
                    print '<br />';
                }
            }
        }
        print '</pre>';
    }
}
