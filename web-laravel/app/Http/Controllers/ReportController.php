<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $categorySummary = Incident::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        $prioritySummary = Incident::select('priority', DB::raw('count(*) as total'))
            ->groupBy('priority')
            ->get();

        $statusSummary = Incident::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return view('reports.index', compact('categorySummary', 'prioritySummary', 'statusSummary'));
    }
}
