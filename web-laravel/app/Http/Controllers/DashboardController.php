<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Incident::count(),
            'resolved' => Incident::where('status', 'Resolved')->orWhere('status', 'Closed')->count(),
            'pending' => Incident::where('status', 'New')->count(),
            'high_priority' => Incident::where('priority', 'High')->orWhere('priority', 'Critical')->count(),
        ];

        $recentIncidents = Incident::with('assignedStaff')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentIncidents'));
    }
}