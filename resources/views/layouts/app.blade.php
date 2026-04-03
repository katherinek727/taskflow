<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tasks') — TaskFlow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brand-1: #6c63ff;
            --brand-2: #48cfad;
            --brand-grad: linear-gradient(135deg, #6c63ff 0%, #48cfad 100%);
            --bg: #0f0f1a;
            --surface: rgba(255,255,255,0.04);
            --surface-hover: rgba(255,255,255,0.08);
            --border: rgba(255,255,255,0.08);
            --text: #e8e8f0;
            --text-muted: #7b7b9a;
            --radius: 16px;
            --radius-sm: 8px;
            --shadow: 0 8px 32px rgba(0,0,0,0.4);
            --transition: 0.2s cubic-bezier(0.4,0,0.2,1);
            --status-new: #a78bfa;
            --status-in_progress: #38bdf8;
            --status-completed: #34d399;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            line-height: 1.6;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(108,99,255,0.15) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 80%, rgba(72,207,173,0.12) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── Nav ── */
        .nav {
            position: sticky; top: 0; z-index: 100;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(15,15,26,0.8);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }

        .nav-brand {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none; font-weight: 700;
            font-size: 1.2rem; color: var(--text); letter-spacing: -0.02em;
        }

        .nav-brand-icon {
            width: 32px; height: 32px;
            background: var(--brand-grad);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
        }

        .nav-brand span {
            background: var(--brand-grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* ── Layout ── */
        .page {
            position: relative; z-index: 1;
            max-width: 1100px; margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
        }

        /* ── Card ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid var(--border);
            font-weight: 600; font-size: 0.75rem;
            color: var(--text-muted);
            letter-spacing: 0.04em; text-transform: uppercase;
        }

        .card-body { padding: 1.75rem; }

        /* ── Buttons ── */
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 0.55rem 1.2rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem; font-weight: 500;
            font-family: inherit; cursor: pointer;
            border: none; text-decoration: none;
            transition: var(--transition); white-space: nowrap;
        }

        .btn-primary {
            background: var(--brand-grad); color: #fff;
            box-shadow: 0 4px 15px rgba(108,99,255,0.35);
        }
        .btn-primary:hover { opacity: 0.88; transform: translateY(-1px); }

        .btn-ghost {
            background: var(--surface); color: var(--text);
            border: 1px solid var(--border);
        }
        .btn-ghost:hover { background: var(--surface-hover); }

        .btn-warning {
            background: rgba(251,191,36,0.15); color: #fbbf24;
            border: 1px solid rgba(251,191,36,0.25);
        }
        .btn-warning:hover { background: rgba(251,191,36,0.25); }

        .btn-danger {
            background: rgba(239,68,68,0.12); color: #f87171;
            border: 1px solid rgba(239,68,68,0.2);
        }
        .btn-danger:hover { background: rgba(239,68,68,0.22); }

        .btn-sm { padding: 0.35rem 0.85rem; font-size: 0.8rem; }

        /* ── Forms ── */
        .form-group { margin-bottom: 1.4rem; }

        label {
            display: block; font-size: 0.8rem; font-weight: 500;
            color: var(--text-muted); letter-spacing: 0.05em;
            text-transform: uppercase; margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            width: 100%; padding: 0.7rem 1rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text); font-family: inherit;
            font-size: 0.9rem; transition: var(--transition);
            outline: none; appearance: none;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--brand-1);
            background: rgba(108,99,255,0.08);
            box-shadow: 0 0 0 3px rgba(108,99,255,0.15);
        }

        .form-control::placeholder { color: var(--text-muted); }
        textarea.form-control { resize: vertical; min-height: 120px; }

        .form-select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%237b7b9a' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem; cursor: pointer;
        }

        .form-select option { background: #1a1a2e; color: var(--text); }

        .invalid-feedback { color: #f87171; font-size: 0.8rem; margin-top: 0.35rem; display: block; }
        .is-invalid { border-color: #f87171 !important; }

        /* ── Badge ── */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 0.25rem 0.75rem; border-radius: 100px;
            font-size: 0.75rem; font-weight: 600; letter-spacing: 0.03em;
        }

        .badge::before {
            content: ''; width: 6px; height: 6px;
            border-radius: 50%; background: currentColor;
        }

        .badge-new         { color: var(--status-new);         background: rgba(167,139,250,0.12); border: 1px solid rgba(167,139,250,0.25); }
        .badge-in_progress { color: var(--status-in_progress); background: rgba(56,189,248,0.12);  border: 1px solid rgba(56,189,248,0.25); }
        .badge-completed   { color: var(--status-completed);   background: rgba(52,211,153,0.12);  border: 1px solid rgba(52,211,153,0.25); }

        /* ── Alert ── */
        .alert {
            padding: 0.9rem 1.2rem; border-radius: var(--radius-sm);
            font-size: 0.875rem; margin-bottom: 1.5rem;
            display: flex; align-items: center; gap: 10px;
        }

        .alert-success {
            background: rgba(52,211,153,0.1);
            border: 1px solid rgba(52,211,153,0.25);
            color: #34d399;
        }

        /* ── Pagination ── */
        .pagination { display: flex; gap: 4px; list-style: none; justify-content: center; margin-top: 2rem; flex-wrap: wrap; }
        .pagination .page-item .page-link {
            display: flex; align-items: center; justify-content: center;
            min-width: 36px; height: 36px; padding: 0 10px;
            border-radius: var(--radius-sm);
            background: var(--surface); border: 1px solid var(--border);
            color: var(--text-muted); text-decoration: none;
            font-size: 0.85rem; transition: var(--transition);
        }
        .pagination .page-item.active .page-link {
            background: var(--brand-grad); border-color: transparent; color: #fff;
        }
        .pagination .page-item .page-link:hover { background: var(--surface-hover); color: var(--text); }
        .pagination .page-item.disabled .page-link { opacity: 0.35; pointer-events: none; }

        /* ── Utilities ── */
        .flex            { display: flex; }
        .items-center    { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2           { gap: 0.5rem; }
        .gap-3           { gap: 0.75rem; }
        .mt-1            { margin-top: 0.25rem; }
        .mt-3            { margin-top: 0.75rem; }
        .mb-4            { margin-bottom: 1rem; }
        .mb-6            { margin-bottom: 1.5rem; }
        .text-muted      { color: var(--text-muted); }
        .text-sm         { font-size: 0.85rem; }
        .font-semibold   { font-weight: 600; }

        .page-heading {
            font-size: 1.75rem; font-weight: 700;
            letter-spacing: -0.03em;
            background: var(--brand-grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .divider { border: none; border-top: 1px solid var(--border); margin: 1.5rem 0; }

        .empty-state { text-align: center; padding: 4rem 2rem; color: var(--text-muted); }
        .empty-state-icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.4; }
    </style>
</head>
<body>

<nav class="nav">
    <a href="{{ route('tasks.index') }}" class="nav-brand">
        <div class="nav-brand-icon">✦</div>
        <span>TaskFlow</span>
    </a>
</nav>

<main class="page">
    @if(session('success'))
        <div class="alert alert-success">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif

    @yield('content')
</main>

</body>
</html>
