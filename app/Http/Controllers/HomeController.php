<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }

    public function getUsers()
    {
        if (Auth::check()) {
            return view('users');
        }else{
            return "Cannot View";
        } 
    }

    public function getOrganizations()
    {
        if (Auth::check()) {
            return view('organizations');
        }else{
            return "Cannot View";
        }
    }


}
