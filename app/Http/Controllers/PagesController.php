<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view("index");
    }

    public function contacts()
    {
        return view("contacts");
    }

    public function info()
    {
        return view("info");
    }
}
