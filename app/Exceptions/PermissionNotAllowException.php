<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Response;

class PermissionNotAllowException extends Exception
{
    public function report()
    {
        
    }

    public function render()
    {
        return responseSuccess([
            'success' => false,
            'message' => 'Error: Permission not allow'
        ], 403);
    }
}
