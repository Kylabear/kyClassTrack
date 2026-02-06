@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <h1 class="mb-3 text-white">Past Schedules</h1>
    @if($lessons->isEmpty())
        <div class="alert alert-info">No past lessons found.</div>
    @else
        <div class="app-card">
            <div class="p-3">
                <table class="table table-sm table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Student Name</th>
                            <th>Age</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($lessons as $lesson)
                        <tr>
                            <td>{{ $lesson->date }}</td>
                            <td>{{ \Carbon\Carbon::parse($lesson->start_time)->format('g:i A') }}</td>
                            <td>{{ $lesson->student_name }}</td>
                            <td>{{ $lesson->age }}</td>
                            <td>{{ $lesson->notes }}</td>
                            <td>
                                @if($lesson->is_fixed_student)
                                    <span class="badge bg-success">Fixed</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('schedule.delete', $lesson->id) }}" onsubmit="return confirm('Delete this schedule entry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
