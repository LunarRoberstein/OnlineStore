<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function about()
    {
        $viewData = [];
        $viewData["title"] = "About us - Bulan's Store";
        $viewData["subtitle"] =  "About us";
        $viewData["description"] =  "Aplikasi ini di buat untuk Ujian Akhir Semester ...";
        $viewData["author"] = "Developed by: Bulan Nursyfa";
        return view('home.about')->with("viewData", $viewData);

        return view('about')->with("viewData", $viewData);
    }
}
