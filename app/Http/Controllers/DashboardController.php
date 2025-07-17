<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\LoaRequest;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDokumen = LoaRequest::count();
        $jumlahJurnal = Journal::count();
        $dokumenApproved = LoaRequest::where('status', 'approved')->count();
        $dokumenPending = LoaRequest::where('status', 'pending')->count();

        // Bar Chart
        $rawData = LoaRequest::select(
            DB::raw("MONTH(created_at) as bulan"),
            DB::raw("COUNT(*) as total")
        )->groupBy(DB::raw("MONTH(created_at)"))
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $bulanLabels = [];
        $dataTotal = [];

        foreach ($rawData as $bulan => $total) {
            $bulanLabels[] = \Carbon\Carbon::create()->month($bulan)->format('F');
            $dataTotal[] = $total;
        }

        $statusCounts = LoaRequest::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')->pluck('total', 'status');

        $recentActivities = ActivityLog::orderBy('created_at', 'desc')->limit(10)->get();

        return view('admin.dashboard.index', compact(
            'totalDokumen',
            'jumlahJurnal',
            'dokumenApproved',
            'dokumenPending',
            'rawData',
            'statusCounts',
            'bulanLabels',
            'dataTotal',
            'statusCounts',
            'recentActivities'
        ));
    }

    public function recentActivity()
    {
        $logs = ActivityLog::latest()->take(5)->get();

        $view = view('components.recent-activity', compact('logs'))->render();

        return response()->json(['html' => $view]);
    }
}
