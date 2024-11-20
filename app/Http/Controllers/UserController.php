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
        
        public function updateProfileImage(Request $request)
        {
            $request->validate([
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
            ]);

            $user = auth()->user();

            // Delete old profile image if it exists
            if ($user->profile_image && \Storage::exists('public/' . $user->profile_image)) {
                \Storage::delete('public/' . $user->profile_image);
            }

            // Store the new profile image
            $path = $request->file('profile_image')->store('profile_images', 'public');

            // Update the user's profile image path
            $user->update(['profile_image' => $path]);

            return back()->with('success', 'Profile image updated successfully!');
        }

    }
