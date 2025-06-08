<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Minha Aplicação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #27272a, #f97316);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .card h4 {
            color: #27272a;
        }

        .btn-primary {
            background-color: #f97316;
            border-color: #f97316;
        }

        .btn-primary:hover {
            background-color: #d25f10;
            border-color: #d25f10;
        }

        .form-check-label,
        .form-label,
        a {
            color: #27272a;
        }

        .form-control:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 0.2rem rgba(249, 115, 22, 0.25);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card shadow p-4 mx-auto" style="max-width: 420px; width: 100%;">
        <h4 class="mb-4 text-center font-weight-bold"><b>Área de membros</b></h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label"><b>E-mail</b></label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"><b>Senha</b></label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>

            <div class="text-center mt-3">
                <a href="/forgot-password">Esqueceu a senha?</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
