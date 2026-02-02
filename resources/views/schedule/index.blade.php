@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Daily Schedule</h1>

    <form method="GET" action="{{ route('schedule.index') }}" class="mb-3 row g-2">
        <div class="col-auto">
            <input type="date" name="date" value="{{ $date }}" class="form-control">
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary">Change Day</button>
        </div>
    </form>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('schedule.store') }}">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">

        <table class="table table-bordered table-sm bg-white">
            <thead class="table-light">
                <tr>
                    <th style="width: 150px;">Time</th>
                    <th style="width: 220px;">Student Name</th>
                    <th style="width: 80px;">Age</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
            @foreach($period as $time)
                @php
                    $start  = $time->format('H:i:s');
                    $lesson = $lessons[$start] ?? null;
                @endphp
                <tr>
                    <td>
                        {{ $time->format('g:i A') }}
                        <br>
                        <small class="text-muted">{{ $time->format('H:i') }}</small>
                    </td>
                    <td>
                        <input type="text"
                               name="slots[{{ $time->format('H:i:s') }}][student_name]"
                               class="form-control form-control-sm"
                               value="{{ old("slots.{$time->format('H:i:s')}.student_name", $lesson->student_name ?? '') }}">
                    </td>
                    <td>
                        <input type="text"
                               name="slots[{{ $time->format('H:i:s') }}][age]"
                               class="form-control form-control-sm"
                               value="{{ old("slots.{$time->format('H:i:s')}.age", $lesson->age ?? '') }}">
                    </td>
                    <td>
                        <input type="text"
                               name="slots[{{ $time->format('H:i:s') }}][notes]"
                               class="form-control form-control-sm"
                               value="{{ old("slots.{$time->format('H:i:s')}.notes", $lesson->notes ?? '') }}">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <button class="btn btn-primary">Save Schedule</button>
    </form>
</div>
@endsection

