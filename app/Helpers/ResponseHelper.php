<?php

namespace App\Helpers;

class ResponseHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function success($message, $route)
    {
        return redirect()->route($route)->with([
            'success' => $message
        ]);
    }

    public static function error($message)
    {
        return redirect()->back()->withErrors([
            'errors' => $message
        ]);
    }
}
