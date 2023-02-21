<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function index() {
        return view('admin.dashboard');
    }
}
