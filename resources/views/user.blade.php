<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Profiel bewerken</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Profiel bewerken</h1>
    <form method="POST" action="{{ route('update.user', ['user' => $user->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Naam</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required autofocus>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

{{--        <div class="mb-3">--}}
{{--            <label for="password" class="form-label">Nieuw wachtwoord (optioneel)</label>--}}
{{--            <input type="password" class="form-control" id="password" name="password">--}}
{{--        </div>--}}

{{--        <div class="mb-3">--}}
{{--            <label for="password_confirmation" class="form-label">Bevestig nieuw wachtwoord (optioneel)</label>--}}
{{--            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">--}}
{{--        </div>--}}

        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
