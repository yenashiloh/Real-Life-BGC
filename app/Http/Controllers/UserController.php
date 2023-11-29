<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Real LIFE Foundation - Home';
        return view('index')->with('title', $title);
    }

    public function announcement()
    {
        $title = 'Announcement';
        return view('announcement')->with('title', $title);
    }

    public function contact()
    {
        $title = 'Contact Us';
        return view('contact')->with('title', $title);
    }

    public function faq()
    {
        $title = 'FAQ';
        return view('faq')->with('title', $title);
    }

    public function login(){
        $title = 'Login';
        return view('user.login')->with('title', $title);
    }

    public function register(){
        $title = 'Register';
        return view('user.register')->with('title', $title);
    }
}
