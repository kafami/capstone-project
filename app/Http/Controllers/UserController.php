<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;

    class UserController extends Controller
    {
        public function index()
        {
            $users = User::all(); // Fetch all users
            return view('users', [
                'title' => 'User Information',
                'users' => $users
            ]);
        }
        public function showUsers()
        {
            $users = User::all();
            return view('users', [
                'title' => 'Users',
                'users' => $users,
            ]);
        }
    }
