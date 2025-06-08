<form method="POST" action="{{ route('login') }}">
    @csrf

    <input type="text" name="email" class="form-control">
    <input type="text" name="password" class="form-control">
    <button type="submit">enviar</button>
</form>
