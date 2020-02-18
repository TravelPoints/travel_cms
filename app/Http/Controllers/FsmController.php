<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Routing\Controller;

class FsmController extends Controller
{
    public function index(Request $request) : IlluminateResponse
    {
        return (new IlluminateResponse())->setContent(['data' => '0101']);
    }
}
