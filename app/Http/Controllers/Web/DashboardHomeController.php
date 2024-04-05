<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardHomeController extends Controller
{
    public function index(){
        return Inertia('Dashboard/Index');
    }
}
