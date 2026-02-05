<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Class Schedule</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root{
            --bg0: #0b1220;
            --bg1: #0e1b3a;
            --card: rgba(255,255,255,.92);
            --text: #0f172a;
            --muted: #64748b;
            --gradA: linear-gradient(135deg, #7c3aed 0%, #2563eb 45%, #06b6d4 100%);
            --gradB: linear-gradient(135deg, rgba(124,58,237,.18) 0%, rgba(37,99,235,.16) 45%, rgba(6,182,212,.14) 100%);
        }

        body{
            background: radial-gradient(1200px 700px at 10% 0%, rgba(124,58,237,.22), transparent 60%),
                        radial-gradient(900px 600px at 90% 10%, rgba(6,182,212,.18), transparent 55%),
                        radial-gradient(900px 700px at 60% 100%, rgba(37,99,235,.18), transparent 55%),
                        linear-gradient(180deg, #0b1220 0%, #0b1220 35%, #eef2ff 100%);
            min-height: 100vh;
        }

        .app-nav{
            background: var(--gradA);
            box-shadow: 0 10px 30px rgba(2,6,23,.25);
        }

        .navbar-brand{
            font-weight: 700;
            letter-spacing: .2px;
        }

        .app-shell{
            padding-bottom: 48px;
        }

        .app-card{
            background: var(--card);
            border: 1px solid rgba(15,23,42,.08);
            border-radius: 16px;
            box-shadow: 0 18px 40px rgba(2,6,23,.10);
            overflow: hidden;
        }

        .app-card-header{
            background: var(--gradB);
            border-bottom: 1px solid rgba(15,23,42,.08);
        }

        .table thead th{
            position: sticky;
            top: 0;
            z-index: 1;
            background: rgba(248,250,252,.95) !important;
            backdrop-filter: blur(8px);
        }

        table.table-sm td, table.table-sm th{
            vertical-align: middle;
        }

        .btn-gradient{
            background: var(--gradA);
            border: 0;
            color: #fff;
            box-shadow: 0 12px 28px rgba(37,99,235,.25);
        }
        .btn-gradient:hover{
            filter: brightness(1.02);
            color: #fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark app-nav mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('schedule.index') }}">ESL Schedule</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('schedule.index') }}">Daily Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reports.monthly') }}">Monthly Report</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="app-shell">
        @yield('content')
    </main>
</body>
</html>

