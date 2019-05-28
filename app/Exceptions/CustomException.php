<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class CustomException extends Exception
{

    public function render(Request $request)
    {
        return view('error', ['msg' => $this->getMessage()]);
    }
}
