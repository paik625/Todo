<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DevController extends Controller
{
    //
    public function session(){
        return Response::json(session()->all());
    }
}
