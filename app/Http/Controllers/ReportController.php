<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
    * Show monthly summary: classes/day, absent days, salary.
    */
    public function monthly(Request $request)
    {
        $userId = 1;
        $month = $request->input('month', now()->format('Y-m')); // e.g. "2026-02"

        $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $end   = (clone $start)->endOfMonth();

        $classesPerDay = Lesson::select(
                DB::raw('DATE(date) as day'),
                DB::raw('COUNT(*) as classes_count')
            )
            ->where('user_id', $userId)
            ->whereBetween('date', [$start, $end])
            ->groupBy('day')
            ->pluck('classes_count', 'day');

        $days = [];
        foreach (CarbonPeriod::create($start, $end) as $day) {
            $dateStr = $day->toDateString();
            $count   = $classesPerDay[$dateStr] ?? 0;
            $days[] = [
                'date'          => $dateStr,
                'dow'           => $day->format('D'),
                'classes_count' => $count,
                'daily_salary'  => $count * 60,
                'absent'        => $count === 0,
            ];
        }

        $totalClasses = array_sum(array_column($days, 'classes_count'));
        $totalAbsent  = collect($days)->where('absent', true)->count();
        $totalSalary  = $totalClasses * 60;

        return view('reports.monthly', compact(
            'month',
            'days',
            'totalClasses',
            'totalAbsent',
            'totalSalary'
        ));
    }
}

