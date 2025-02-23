<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse 
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'mobileNumber' => ['required', 'string', 'max:255'],           
            'customerType' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required',
                'string',
                'min:8',              // Minimum 8 characters
                'regex:/[A-Z]/',      // Must contain at least one uppercase letter
                'regex:/[0-9]/',      // Must contain at least one number
                'regex:/[@$!%*#?&]/', // Must contain at least one special character
            ],
        ]);


      //  if ($request->fails()) {
      //      return redirect()->back()->withErrors($request)->withInput();
       // }

        $user = User::create([
            'firstName' => $request->firstName,
            'surname' => $request->surname,
            'mobileNumber' => $request->mobileNumber,
            'customerType' => $request->customerType,
            'email' => $request->email,
            'password' => Hash::make($request->password),



            
        ]);

        //
        

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('leaves.dashboard', absolute: false));

        
    }
   
}

