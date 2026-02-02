<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
    * Show the daily schedule.
    */
    public function index(Request $request)
    {
        // In a real Laravel app, you would use $request->user()->id.
        // For now we assume a single teacher with id = 1.
        $userId = 1;

        $date = $request->input('date', now()->toDateString());

        // Create 30-minute slots from 14:00 (2 PM) to 23:30 (11:30 PM)
        $period = CarbonPeriod::create('14:00', '30 minutes', '23:30');

        $lessons = Lesson::where('user_id', $userId)
            ->whereDate('date', $date)
            ->get()
            ->keyBy('start_time'); // key by 'HH:MM:SS'

        return view('schedule.index', compact('date', 'period', 'lessons'));
    }

    /**
    * Save the daily schedule.
    */
    public function store(Request $request)
    {
        $userId = 1;
        $date = $request->input('date');

        $slots = $request->input('slots', []); // [ '14:00:00' => [...], ... ]

        foreach ($slots as $time => $data) {
            $hasData = filled($data['student_name'] ?? null)
                || filled($data['age'] ?? null)
                || filled($data['notes'] ?? null);

            if (! $hasData) {
                Lesson::where('user_id', $userId)
                    ->whereDate('date', $date)
                    ->where('start_time', $time)
                    ->delete();
                continue;
            }

            Lesson::updateOrCreate(
                [
                    'user_id'     => $userId,
                    'date'        => $date,
                    'start_time'  => $time,
                ],
                [
                    'student_name' => $data['student_name'] ?? null,
                    'age'          => $data['age'] ?? null,
                    'notes'        => $data['notes'] ?? null,
                ]
            );
        }

        return redirect()
            ->route('schedule.index', ['date' => $date])
            ->with('status', 'Schedule updated.');
    }
}

