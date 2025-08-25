<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // pastikan file view ada di resources/views/admin/dashboard.blade.php
    }
    public function dashboardContent()
    {
        return view('admin.dashboard-content')->render();
    }
}
