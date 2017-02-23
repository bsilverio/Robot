<?php

namespace App\Http\Controllers\StoreManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\RobotController;

use Validator;

class StoreController extends RobotController
{
    public function create(Request $request) {
        $credentials = $request->only('width', 'height');

        
    }
}
