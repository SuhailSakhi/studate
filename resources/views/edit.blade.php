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
    <form method="POST" action="{{ route('update.profile', $profile->id) }}" enctype="multipart/form-data">
        @csrf
    @method('PUT')
        <div class="mb-3">
            <label for="image" class="form-label">Profielfoto</label>
            <input type="file" class="form-control" id="image" name="image">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Naam</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $profile->name }}" required autofocus>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Geslacht</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="male" @if($profile->gender == 'male') selected @endif>Man</option>
                <option value="female" @if($profile->gender == 'female') selected @endif>Vrouw</option>
                <option value="other" @if($profile->gender == 'other') selected @endif>Anders</option>
            </select>
            @error('gender')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Leeftijd</label>
            <input type="text" class="form-control" id="age" name="age" value="{{ $profile->age }}" required>
            @error('age')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" name="bio" required>{{ $profile->bio }}</textarea>
            @error('bio')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Profiel bijwerken</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

