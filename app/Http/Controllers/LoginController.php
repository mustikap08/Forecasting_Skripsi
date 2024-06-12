<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('Authentication.cardLogin');
    }


    public function register()
    {
        return view('Authentication.cardRegister');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:filter',
            'password' => 'required|min:8',
        ]);

        if($validate->fails()){
            return back()->withInput();
        }

        try
        {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
        } catch (\Exception $e){
            return back()->withInput();
        }

        return redirect('/');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email:filter|min:8',
            'password' => 'required|min:8',
        ]);

        try
        {
            if(Auth::attempt($credentials)){
                $request->session()->regenerate();

                return redirect('/dashboard');
            } else {
                return redirect('/')->withInput();
            }
        } catch (\Exception $e) {
            return redirect('/')->withInput();
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
