<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class IDController extends Controller
{

    public function createDataFirstPage () {

        return Inertia::render('FormDataFirstPage');
    }

    public function storeData( Request $request) {

        $attributes = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $uuid = Str::uuid();

        User::create([
            'uuid' => $uuid,
            'name' => $attributes['firstname'] . ' ' . $attributes['lastname'],
            'firstname' => $attributes['firstname'],
            'lastname' => $attributes['lastname'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password'])
        ]);

        return redirect()->route('seconde-page-data', $uuid);
    }

    public function createDataSecondePage ($uuid) {

        $user = User::where('uuid', $uuid)->first();

        if(!$user) {
            return redirect()->route('first-page-data');
        }

        return Inertia::render('FormDataSecondePage', [
            'countries' =>  config('countries'),
            'uuid' => $uuid
        ]);
    }

    public function storeSecondeData (Request $request, $uuid) {

        $user = User::where('uuid', $uuid)->first();

        if(!$user) {
            return redirect()->route('first-page-data');
        }

        $attributes = $request->validate([
            'phone' => ['required'],
            'address' => ['required'],
            'country' => ['required'],
            'city' => ['required'],
            'code' => ['required'],
            'birthday' => ['required', 'date'],
            'birth_place' => ['required']
        ]);

        $user->update([
            'phone' => $attributes['phone'],
            'address' => $attributes['address'],
            'country' => $attributes['country'],
            'city' => $attributes['city'],
            'code' => $attributes['code'],
            'birthday' => $attributes['birthday'],
            'birth_place' => $attributes['birth_place']
        ]);

        return redirect()->route('capture-front-side', $uuid);
    }

    public function captureFrontSide ($uuid) {

        $user = User::where('uuid', $uuid)->first();

        if(!$user) {
            return redirect()->route('first-page-data');
        }

        if(! $user->country) {
            return redirect()->route('seconde-page-data', $uuid);
        }

        return Inertia::render('CaptureIDFrontSide', [
            'uuid' => $uuid
        ]);
    }

    public function storeFrontSide (Request $request, $uuid) {

        $user = User::where('uuid', $uuid)->first();

        if(!$user) {
            return redirect()->route('first-page-data');
        }

        if(! $user->country) {
            return redirect()->route('seconde-page-data', $uuid);
        }

        $request->validate([
            'image' => ['required'],
            'video' => ['required'],
        ]);

        $image = Storage::disk('public')->put('/images', $request->file('image'));
        $video = Storage::disk('public')->put('/videos', $request->file('video'));

        $data = [
            'image' => $image,
            'video' => $video
        ];

        $user->update([
            'id_front_side' => json_encode($data)
        ]);

        return redirect()->route('capture-back-side', $uuid);
    }

    public function captureBackSide ($uuid) {

        $user = User::where('uuid', $uuid)->first();

        if(!$user) {
            return redirect()->route('first-page-data');
        }

        if(! $user->id_front_side) {
            return redirect()->route('capture-front-side', $uuid);
        }

        return Inertia::render('CaptureIDBackSide', [
            'uuid' => $uuid
        ]);
    }

    public function storeBackSide (Request $request, $uuid) {

        $user = User::where('uuid', $uuid)->first();

        if(!$user) {
            return redirect()->route('first-page-data');
        }

        if(! $user->id_front_side) {
            return redirect()->route('capture-front-side', $uuid);
        }

        $request->validate([
            'image' => ['required'],
            'video' => ['required'],
        ]);

        $image = Storage::disk('public')->put('/images', $request->file('image'));
        $video = Storage::disk('public')->put('/videos', $request->file('video'));

        $data = [
            'image' => $image,
            'video' => $video
        ];

        $user->update([
            'id_back_side' => json_encode($data)
        ]);

        return redirect()->route('capture-selfie', $uuid);
    }

    public function captureSelfie ($uuid) {

        $user = User::where('uuid', $uuid)->first();

        if(!$user) {
            return redirect()->route('first-page-data');
        }

        if(! $user->id_back_side) {
            return redirect()->route('capture-back-side', $uuid);
        }

        return Inertia::render('CaptureSelfie', [
            'uuid' => $uuid
        ]);
    }

    public function storeSelfie (Request $request, $uuid) {

        $user = User::where('uuid', $uuid)->first();

        if(!$user) {
            return redirect()->route('first-page-data');
        }

        if(! $user->id_back_side) {
            return redirect()->route('capture-back-side', $uuid);
        }

        $request->validate([
            'image' => ['required'],
            'video' => ['required'],
        ]);

        $image = Storage::disk('public')->put('/images', $request->file('image'));
        $video = Storage::disk('public')->put('/videos', $request->file('video'));

        $data = [
            'image' => $image,
            'video' => $video
        ];

        $user->update([
            'selfie' => json_encode($data)
        ]);

        return redirect()->route('wait-verification', $uuid);
    }

    public function waitForVerification ($uuid) {

        $user = User::where('uuid', $uuid)->first();

        if(!$user) {
            return redirect()->route('first-page-data');
        }

        if(! $user->selfie) {
            return redirect()->route('capture-selfie', $uuid);
        }

        return Inertia::render('WaitForVerification', [
            'user' => $user,
            'uuid' => $uuid
        ]);
    }
}
