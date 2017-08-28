<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return 'test';
    }

    public function test()
    {
        echo '123456';
    }
}
