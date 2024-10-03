<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AgeController extends Controller
{
    public function showForm()
    {
        return view('login'); // Return the login view (which is the form)
    }

    public function checkAge(Request $request)
    {
        // Validate the age input
        $request->validate([
            'check.age' => 'required|integer|min:0',
        ]);

        // Store the age in session
        Session::put('age', $request->age);

        // Redirect to the home page after successful age verification
        return redirect('/home'); 
    }
}
