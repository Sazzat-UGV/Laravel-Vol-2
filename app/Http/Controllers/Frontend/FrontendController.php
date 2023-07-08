<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\page;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index($page_slug){
        $page=page::findBySlug($page_slug);
        return view('about-us',compact('page'));
    }
}
