<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {

        return Inertia::render('Dashboard', [
            'users' => User::where('role', 'user')->paginate(10)
        ]);
    }
}
