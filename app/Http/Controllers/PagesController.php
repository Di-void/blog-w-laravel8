<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
//        print_r(route('products'));
        return view('welcome');
    }
}
