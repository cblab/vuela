<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Storage;

class Avatar
{
    public static function getPath() {
        $authId          = auth()->id();
        $avatarPath      = "avatars/" . $authId . "/avatar.jpg";
        return Storage::disk('s3')->url($avatarPath);
    }

}