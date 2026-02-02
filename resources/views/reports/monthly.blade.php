@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Monthly Report</h1>

    <form method="GET" action="{{ route('reports.monthly') }}" class="mb-3 row g-2">
        <div class="col-auto">
            <input type="month" name="month" value="{{ $month }}" class="form-control">
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary">Change Month</button>
        </div>
    </form>

    <table class="table table-bordered table-sm bg-white">
        <thead class="table-light">
            <tr>
                <th style="width: 120px;">Date</th>
                <th style="width: 80px;">Day</th>
                <th style="width: 100px;">Classes</th>
                <th style="width: 90px;">Absent?</th>
                <th>Daily Salary (PHP)</th>
            </tr>
        </thead>
        <tbody>
        @foreach($days as $d)
            <tr>
                <td>{{ $d['date'] }}</td>
                <td>{{ $d['dow'] }}</td>
                <td>{{ $d['classes_count'] }}</td>
                <td>{{ $d['absent'] ? 'Yes' : 'No' }}</td>
                <td>{{ number_format($d['daily_salary'], 2) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot class="table-light">
            <tr>
                <th colspan="2">Totals</th>
                <th>{{ $totalClasses }} classes</th>
                <th>{{ $totalAbsent }} days absent</th>
                <th>{{ number_format($totalSalary, 2) }} PHP</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

