<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function index()
    {
        return view('pages.email-verification.verify');
    }

    public function handler(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('account.overview');
    }

    public function resending(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with([
            'success' => 'Verification link sent!'
        ]);
    }
}
