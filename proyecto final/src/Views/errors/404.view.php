<?php http_response_code(404); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>404 - Página no encontrada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 30% 30%, #1e293b 0%, #0f172a 60%);
            color: #e2e8f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 2rem;
        }

        .code {
            font-size: 7rem;
            font-weight: 800;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        p {
            color: #94a3b8;
            margin-bottom: 2rem;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.6rem;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: #6366f1;
            color: white;
        }

        .btn-primary:hover {
            background: #4f46e5;
        }

        .btn-secondary {
            background: #1f2937;
            color: #e2e8f0;
            border: 1px solid #334155;
        }

        .btn-secondary:hover {
            background: #334155;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            font-size: 0.8rem;
            color: #64748b;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="code">404</div>
        <h1>Página no encontrada</h1>
        <p>
            La ruta que intentas acceder no existe o ha sido eliminada.
            Verifica la URL o vuelve al panel principal.
        </p>

        <div class="actions">
            <a href="/" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i>
                Volver al Panel
            </a>

            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="bi bi-arrow-counterclockwise"></i>
                Volver atrás
            </a>
        </div>
    </div>
</body>

</html>