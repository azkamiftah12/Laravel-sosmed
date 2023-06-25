<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\modelProfile;
use App\Models\modelUser;
use App\Models\modelUserRole;
use App\Models\modelRole;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = modelUser::all();
        $user_role = modelUserRole::all();

        return view('users.index', compact('users', 'user_role'));
    }

    public function create()
    {
        $roles = modelRole::all();
        $users_role = modelUserRole::with('role')->get();
        return view('users.create', compact('users_role', 'roles'));
    }

    public function store(Request $request)
    {
        // insert user
        $insertuser = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $usercreate = modelUser::create($insertuser);

        // insert user role

        $insertUserRole = $request->validate([
            'id_role' => 'required',
        ]);
        $insertUserRole['id_user'] = $usercreate->id_user;

        ModelUserRole::create($insertUserRole);

        // insert profile
        $insertProfile = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
        ]);
        $insertProfile['id_user'] = $usercreate->id_user;

        modelProfile::create($insertProfile);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(modelUser $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, modelUser $user)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(modelUser $user)
    {
        $user->delete();
        // $user->profile()->delete();
        // $user->user_role()->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function loginpage()
    {

        return view('login');
    }
    public function login(Request $request)
    {
        $user = modelUser::where('username', $request->username)->first();

        if ($user && $user->password === $request->password) {
            // Store id_user and id_role in cookies
            Cookie::queue('username', $user->username);
            Cookie::queue('id_role', $user->id_role);
            Cookie::queue('nama_role', $user->user_role->role->nama_role);

            // Start a session for the authenticated user
            $request->session()->regenerate();

            return redirect()->route('index');
        }

            // Authentication failed
            return redirect()->back()->withErrors(['login' => 'Invalid login credentials.']);

        // $credentials = $request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);

        // if (Auth::attempt($credentials)) {
        //     // Authentication passed
        //     return redirect()->route('index'); // Replace 'dashboard' with your desired route
        // }
        // $form_username = $request->username;
        // $form_password = $request->password;

        // $payload = ['username' => $form_username, 'password' => $form_password];

        // $cek = Auth::guard('userlogin')->attempt($payload);
        // if(!$cek) {
        //     Session::flash('alert', 'warning|Login Gagal. Username atau Password Salah!');
        //     return redirect()->route('landing.login.index');
        // }
        // $request->session()->regenerate();
        // return redirect()->intended(route('landing.index'));
    }

    public function logout()
    {
        // Remove id_user and id_role cookies
        Cookie::queue(Cookie::forget('username'));
        Cookie::queue(Cookie::forget('id_role'));
        Cookie::queue(Cookie::forget('nama_role'));

        session()->invalidate();
        session()->regenerateToken();
        Session::flash('alert', 'success|Logged Out!');
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
