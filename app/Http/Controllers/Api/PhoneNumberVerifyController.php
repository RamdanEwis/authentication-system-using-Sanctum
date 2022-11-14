<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PhoneNumberVerifyController extends Controller
{
    public function show(Request $request)
    {
        if($request->user->userPhoneVerified()) {
              return redirect()->route('home');
        }else{
            return view('phoneverify.show');
        }
    }

    public function verify(Request $request)
    {
        if ($request->user()->verification_code !== $request->code) {
            return back()->withErrors(['msg', 'Invalid Code Please Try Again!']);
        }

        if ($request->user()->userPhoneVerified()) {
            return redirect()->route('home');
        }

        $request->user()->phoneVerifiedAt();

        return redirect()->route('home')->with('status', 'Your phone was successfully verified!');
    }
}
