<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body{font-family:Inter,system-ui,sans-serif;background:#f8fafc;color:#0f172a;margin:0}
        .container{max-width:1200px;margin:0 auto;padding:2rem}
        header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem}
        .btn{display:inline-block;background:#2563eb;color:#fff;padding:.6rem 1rem;border-radius:8px;text-decoration:none;border:none;cursor:pointer}
        .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1rem}
        .card{background:#fff;border:1px solid #e2e8f0;border-radius:12px;box-shadow:0 4px 6px rgba(0,0,0,.05);padding:1rem}
        h2{font-size:1rem;margin:.25rem 0;color:#334155}
        .stat{font-size:2rem;font-weight:800}
        table{width:100%;border-collapse:collapse}
        th,td{padding:.6rem;border-bottom:1px solid #e2e8f0;text-align:left}
        th{color:#334155;font-weight:700}
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn" type="submit">Logout</button>
            </form>
        </header>

        <div class="grid">
            <div class="card">
                <h2>Total Website Views</h2>
                <div class="stat">{{ number_format($totalViews) }}</div>
            </div>
            <div class="card">
                <h2>Total View Details Clicks</h2>
                <div class="stat">{{ number_format($totalViewDetails) }}</div>
            </div>
        </div>

        <div class="card" style="margin-top:1rem;">
            <h2>View Details by Job</h2>
            <table>
                <thead>
                    <tr>
                        <th>Job</th>
                        <th>Clicks</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($perJobViewDetails as $row)
                        <tr>
                            <td>
                                @php($title = $jobIdToTitle[$row->job_id] ?? ('ID ' . $row->job_id))
                                {{ $title }}
                            </td>
                            <td>{{ $row->total }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card" style="margin-top:1rem;">
            <h2>Subscriptions</h2>
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Subscribed At</th>
                        <th>IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $sub)
                        <tr>
                            <td>{{ $sub->email }}</td>
                            <td>{{ $sub->status }}</td>
                            <td>{{ $sub->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $sub->ip_address }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No subscriptions yet</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="margin-top:.5rem;">
                {{ $subscriptions->links() }}
            </div>
        </div>
    </div>
</body>
</html>


