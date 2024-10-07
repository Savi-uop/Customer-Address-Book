<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Example data you might want to pass to the dashboard
        $stats = [
            'total_customers' => 150,
            'total_income' => 5000,
            'new_customers_today' => 5,
            'active_projects' => 12,
        ];

        // Return the dashboard view with the stats data
        return view('dashboard.index', compact('stats'));
    }
    
}
