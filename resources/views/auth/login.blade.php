<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - E-Locker entregas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link sizes="76x76" href="../assets/img/e-locker.png">
    <link rel="icon" type="image/png" href="../assets/img/e-locker.png">
</head>
<body>

<div class="container">
    <div class="card shadow p-4 mx-auto card-format">
        <img src="{{ asset('assets/img/e-locker.png') }}" class="img-format mx-auto mb-3">
        <h4 class="mb-4 text-center font-weight-bold"><b>Área de membros</b></h4>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label"><b>E-mail</b></label>
                <input type="email" class="form-control" id="email" value="admin@e-locker.online" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"><b>Senha</b></label>
                <input type="password" class="form-control" id="password" value="master$;" name="password" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>

            <div class="text-center mt-3">
                <a href="#">Esqueceu a senha?</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
