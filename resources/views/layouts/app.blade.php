<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tasks') — Lumière</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --rose-50:   #fff1f4;
            --rose-100:  #ffe4ea;
            --rose-200:  #fecdd6;
            --rose-300:  #fda4b4;
            --rose-400:  #fb7093;
            --rose-500:  #f43f6e;
            --blush:     #f9e8ee;
            --petal:     #f5d0dc;
            --champagne: #f7e7ce;
            --gold:      #c9a96e;
            --gold-light:#e8d5b0;
            --gold-shine:#fdf3e3;
            --cream:     #fdf8f5;
            --text:      #3d2535;
            --text-soft: #7d5a6a;
            --text-muted:#b08a9a;
            --border:    rgba(201,169,110,0.2);
            --border-rose: rgba(253,160,180,0.3);
            --radius:    20px;
            --radius-sm: 12px;
            --radius-xs: 8px;
            --transition: 0.25s cubic-bezier(0.4,0,0.2,1);
            --shadow-sm: 0 2px 12px rgba(180,80,110,0.08);
            --shadow:    0 8px 32px rgba(180,80,110,0.12);
            --shadow-lg: 0 20px 60px rgba(180,80,110,0.18);

            --status-new:         #d97fa8;
            --status-in_progress: #c9a96e;
            --status-completed:   #7bbf9e;
        }

        html { font-size: 16px; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ── Decorative background ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 5% 0%,   rgba(253,160,180,0.22) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 95% 5%,  rgba(247,231,206,0.35) 0%, transparent 50%),
                radial-gradient(ellipse 60% 50% at 90% 95%, rgba(253,160,180,0.18) 0%, transparent 55%),
                radial-gradient(ellipse 40% 35% at 10% 90%, rgba(201,169,110,0.12) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        /* Floating petal shapes */
        body::after {
            content: '';
            position: fixed;
            top: -120px; right: -80px;
            width: 500px; height: 500px;
            background: radial-gradient(ellipse, rgba(253,160,180,0.15) 0%, transparent 70%);
            border-radius: 60% 40% 70% 30% / 50% 60% 40% 50%;
            pointer-events: none;
            z-index: 0;
            animation: float 12s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%       { transform: translateY(20px) rotate(5deg); }
        }

        /* ── Nav ── */
        .nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(253,248,245,0.85);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid var(--border-rose);
            padding: 0 2.5rem;
            height: 72px;
            display: flex; align-items: center; justify-content: space-between;
        }

        .nav-brand {
            display: flex; align-items: center; gap: 12px;
            text-decoration: none;
        }

        .nav-brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #f9a8c0 0%, #c9a96e 100%);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(249,168,192,0.4);
        }

        .nav-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 600;
            font-style: italic;
            background: linear-gradient(135deg, #d97fa8 0%, #c9a96e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 0.01em;
        }

        .nav-tagline {
            font-size: 0.7rem;
            color: var(--text-muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 500;
        }

        /* ── Layout ── */
        .page {
            position: relative; z-index: 1;
            max-width: 1080px; margin: 0 auto;
            padding: 3rem 1.5rem 5rem;
        }

        /* ── Card ── */
        .card {
            background: rgba(255,255,255,0.75);
            border: 1px solid var(--border-rose);
            border-radius: var(--radius);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-header {
            padding: 1.1rem 1.75rem;
            border-bottom: 1px solid var(--border-rose);
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            background: linear-gradient(90deg, rgba(253,160,180,0.06) 0%, transparent 100%);
        }

        .card-body { padding: 1.75rem; }

        /* ── Buttons ── */
        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 0.6rem 1.4rem;
            border-radius: 100px;
            font-size: 0.85rem; font-weight: 500;
            font-family: inherit; cursor: pointer;
            border: none; text-decoration: none;
            transition: var(--transition); white-space: nowrap;
            letter-spacing: 0.01em;
        }

        .btn-primary {
            background: linear-gradient(135deg, #f9a8c0 0%, #e8789e 40%, #c9a96e 100%);
            color: #fff;
            box-shadow: 0 4px 18px rgba(232,120,158,0.4);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(232,120,158,0.5);
        }

        .btn-ghost {
            background: rgba(255,255,255,0.8);
            color: var(--text-soft);
            border: 1px solid var(--border-rose);
            box-shadow: var(--shadow-sm);
        }
        .btn-ghost:hover {
            background: var(--blush);
            border-color: var(--rose-300);
        }

        .btn-warning {
            background: rgba(201,169,110,0.12);
            color: var(--gold);
            border: 1px solid rgba(201,169,110,0.3);
        }
        .btn-warning:hover { background: rgba(201,169,110,0.22); }

        .btn-danger {
            background: rgba(244,63,110,0.08);
            color: #e05a7a;
            border: 1px solid rgba(244,63,110,0.18);
        }
        .btn-danger:hover { background: rgba(244,63,110,0.15); }

        .btn-sm { padding: 0.35rem 1rem; font-size: 0.78rem; }

        /* ── Forms ── */
        .form-group { margin-bottom: 1.5rem; }

        label {
            display: block;
            font-size: 0.72rem; font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.1em; text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 0.75rem 1.1rem;
            background: rgba(255,255,255,0.9);
            border: 1.5px solid var(--border-rose);
            border-radius: var(--radius-sm);
            color: var(--text);
            font-family: inherit; font-size: 0.9rem;
            transition: var(--transition);
            outline: none; appearance: none;
            box-shadow: var(--shadow-sm);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--rose-300);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(253,160,180,0.15), var(--shadow-sm);
        }

        .form-control::placeholder { color: var(--text-muted); }
        textarea.form-control { resize: vertical; min-height: 130px; }

        .form-select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23b08a9a' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem; cursor: pointer;
        }

        .form-select option { background: #fff; color: var(--text); }

        .invalid-feedback { color: #e05a7a; font-size: 0.8rem; margin-top: 0.4rem; display: block; }
        .is-invalid { border-color: #f9a8c0 !important; background: rgba(249,168,192,0.05) !important; }

        /* ── Badge ── */
        .badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 0.3rem 0.9rem;
            border-radius: 100px;
            font-size: 0.72rem; font-weight: 600;
            letter-spacing: 0.04em;
        }

        .badge::before {
            content: ''; width: 5px; height: 5px;
            border-radius: 50%; background: currentColor;
            flex-shrink: 0;
        }

        .badge-new {
            color: var(--status-new);
            background: rgba(217,127,168,0.1);
            border: 1px solid rgba(217,127,168,0.25);
        }
        .badge-in_progress {
            color: var(--status-in_progress);
            background: rgba(201,169,110,0.1);
            border: 1px solid rgba(201,169,110,0.25);
        }
        .badge-completed {
            color: var(--status-completed);
            background: rgba(123,191,158,0.1);
            border: 1px solid rgba(123,191,158,0.25);
        }

        /* ── Alert ── */
        .alert {
            padding: 1rem 1.4rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            margin-bottom: 1.75rem;
            display: flex; align-items: center; gap: 10px;
        }

        .alert-success {
            background: linear-gradient(90deg, rgba(123,191,158,0.12), rgba(123,191,158,0.06));
            border: 1px solid rgba(123,191,158,0.3);
            color: #5a9e7e;
        }

        /* ── Pagination ── */
        .pagination {
            display: flex; gap: 6px; list-style: none;
            justify-content: center; margin-top: 2.5rem; flex-wrap: wrap;
        }
        .pagination .page-item .page-link {
            display: flex; align-items: center; justify-content: center;
            min-width: 38px; height: 38px; padding: 0 12px;
            border-radius: 100px;
            background: rgba(255,255,255,0.8);
            border: 1px solid var(--border-rose);
            color: var(--text-soft);
            text-decoration: none; font-size: 0.85rem;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #f9a8c0, #c9a96e);
            border-color: transparent; color: #fff;
            box-shadow: 0 4px 14px rgba(232,120,158,0.35);
        }
        .pagination .page-item .page-link:hover {
            background: var(--blush);
            border-color: var(--rose-300);
            color: var(--text);
        }
        .pagination .page-item.disabled .page-link { opacity: 0.4; pointer-events: none; }

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
        .text-soft       { color: var(--text-soft); }
        .text-sm         { font-size: 0.85rem; }
        .font-semibold   { font-weight: 600; }

        /* ── Page heading ── */
        .page-heading {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; font-weight: 700;
            letter-spacing: -0.01em; line-height: 1.2;
            background: linear-gradient(135deg, #d97fa8 0%, #c9a96e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-heading-sub {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem; font-weight: 600;
            background: linear-gradient(135deg, #d97fa8 0%, #c9a96e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* ── Divider ── */
        .divider {
            border: none;
            border-top: 1px solid var(--border-rose);
            margin: 1.5rem 0;
        }

        /* ── Gold accent line ── */
        .gold-line {
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold-light), transparent);
            border: none; margin: 0;
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center; padding: 5rem 2rem;
            color: var(--text-muted);
        }
        .empty-state-icon { font-size: 3.5rem; margin-bottom: 1rem; opacity: 0.5; }
        .empty-state p { font-size: 0.95rem; line-height: 1.8; }

        /* ── Table row hover ── */
        .task-row { transition: background var(--transition); }
        .task-row:hover { background: rgba(253,160,180,0.05); }
    </style>
</head>
<body>

<nav class="nav">
    <a href="{{ route('tasks.index') }}" class="nav-brand">
        <div class="nav-brand-icon">✿</div>
        <div>
            <div class="nav-brand-name">Lumière</div>
            <div class="nav-tagline">Task Manager</div>
        </div>
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
