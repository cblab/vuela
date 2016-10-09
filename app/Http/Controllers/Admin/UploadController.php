<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Avatar;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class UploadController extends Controller
{
    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        return view('admin.upload')->with('avatarPath', Avatar::getPath());
    }

    public function getAvatar(Request $request)
    {
        $response = [
            'avatarurl' => Avatar::getPath()
        ];

        return response()->json($response);
    }

    /**
     * Store avatar image.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('avatar');

        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $thumbDestinationPath = storage_path('thumbnail').'/'.$input['imagename'];

        $img = Image::make($image->getRealPath());
        $image_thumb = $img->resize(null, 25, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg', 80);

        //preserve original image?
        //$image->move(storage_path('/images'), $input['imagename']);

        $s3StoragePath = "avatars/". auth()->id(). "/avatar.jpg";
        Storage::disk('s3')->put($s3StoragePath, $image_thumb->__toString());
        return back();
    }

}