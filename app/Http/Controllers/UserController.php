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

        public function editProfile()
        {
            $user = auth()->user(); // Get the authenticated user
            return view('edit_profile', [
                'title' => 'Edit Profile',
                'user' => $user
            ]);
        }
        
        public function updateProfile(Request $request)
        {
            $user = auth()->user();

            // Validate input data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                // Delete old profile image if it exists
                if ($user->profile_image && \Storage::exists('public/' . $user->profile_image)) {
                    \Storage::delete('public/' . $user->profile_image);
                }

                // Store the new profile image
                $path = $request->file('profile_image')->store('profile_images', 'public');

                // Update profile image path
                $user->profile_image = $path;
            }

            // Update user details
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()->route('edit-profile')->with('success', 'Profile updated successfully!');
        }
    }
