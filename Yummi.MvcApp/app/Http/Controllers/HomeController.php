<?php

namespace App\Http\Controllers;


use Yummi\Domain\Entities\Genius;

class HomeController extends Controller
{
    /**
     * Start page form php
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }
}
