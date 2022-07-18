<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected $imageService;

    public function __construct() {
        $this->imageService = new ImageService();
    }

    public function profile(Customers $user)
    {
        $user = $user->load(['active_profile.media']);
        return response()->json($user);
    }

    public function updateProfile(Request $request, Customers $user)
    {
        $image = $this->imageService->base64($request->image);
        Storage::disk('profile')->put($image['filename'], base64_decode($image['image']));
        $user->profile()->update(['status' => 0]);
        $profile = $user->profile()->create([
            'status' => 1
        ]);
        $profile->media()->create([
            'type' => $request->type,
            'file_name' => $image['filename']
        ]);
        $user = $user->load(['active_profile.media']);
        return response()->json($user);
    }
    public function updateInfo(Request $request, Customers $user)
    {
        $user = $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'sexe' => $request->sexe
        ]);
        return response()->json($user);
    }
}
