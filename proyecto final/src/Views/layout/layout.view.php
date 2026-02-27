<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Gestión Escolar' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            color: #e2e8f0;
        }

        .sidebar {
            width: 260px;
            background-color: #111827;
            border-right: 1px solid #1f2937;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: #f1f5f9;
            padding: 1.5rem;
            border-bottom: 1px solid #1f2937;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: #9ca3af;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-link:hover {
            color: #ffffff;
            background-color: #1f2937;
        }

        .nav-link.active {
            color: #ffffff;
            background-color: #312e81;
            font-weight: 600;
        }

        .nav-link i {
            font-size: 1.2rem;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #0f172a;
        }

        .topbar {
            background-color: #111827;
            height: 70px;
            border-bottom: 1px solid #1f2937;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            justify-content: space-between;
        }

        .topbar h5 {
            color: #e5e7eb;
        }

        .main-content {
            padding: 2rem;
        }

        .card {
            background-color: #1e293b;
            border: 1px solid #1f2937;
            border-radius: 1rem;
            box-shadow: none;
            color: #e2e8f0;
        }

        .table {
            color: #e2e8f0;
        }

        .table thead th {
            border-bottom: 1px solid #1f2937;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #94a3b8;
            font-weight: 600;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .table td {
            vertical-align: middle;
            padding: 1rem 0.5rem;
            border-bottom: 1px solid #1f2937;
            color: #cbd5e1;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
            color: #9ca3af;
            background: transparent;
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .btn-action:hover {
            background: #1f2937;
            color: #ffffff;
        }

        .btn-action.delete:hover {
            background: #7f1d1d;
            color: #f87171;
        }
    </style>
</head>

<body class="d-flex">

    <nav class="sidebar" aria-label="Menú principal">
        <div class="brand">
            <i class="bi bi-mortarboard-fill text-primary me-2"></i> Mi Escuela
        </div>
        <div class="py-3">
            <a href="/" class="nav-link <?= $active == 'home' ? 'active' : '' ?>">
                <i class="bi bi-grid-1x2"></i> Panel
            </a>
            <a href="/students" class="nav-link <?= $active == 'students' ? 'active' : '' ?>">
                <i class="bi bi-people"></i> Estudiantes
            </a>
            <a href="/teachers" class="nav-link <?= $active == 'teachers' ? 'active' : '' ?>">
                <i class="bi bi-person-badge"></i> Profesores
            </a>
            <a href="/courses" class="nav-link <?= $active == 'courses' ? 'active' : '' ?>">
                <i class="bi bi-book"></i> Cursos
            </a>
            <a href="/departments" class="nav-link <?= $active == 'departments' ? 'active' : '' ?>">
                <i class="bi bi-buildings"></i> Departamentos
            </a>
        </div>
    </nav>

    <div class="content-wrapper">
        <header class="topbar">
            <h5 class="m-0 text-secondary fw-semibold"><?= $pageTitle ?></h5>
        </header>

        <main class="main-content">
            <?= $content ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>