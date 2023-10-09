<form method="POST" action="{{ route('create') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="image" class="form-label">Profielfoto</label>
        <input type="file" class="form-control" id="image" name="image" required>
        @error('image')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Naam</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Geslacht</label>
        <select class="form-select" id="gender" name="gender" required>
            <option value="male">Man</option>
            <option value="female">Vrouw</option>
            <option value="other">Anders</option>
        </select>
        @error('gender')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="age" class="form-label">Leeftijd</label>
        <input type="text" class="form-control" id="age" name="age" value="{{ old('age') }}" required>
        @error('age')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="bio" class="form-label">Bio</label>
        <textarea class="form-control" id="bio" name="bio" required>{{ old('bio') }}</textarea>
        @error('bio')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Profiel aanmaken</button>
    </div>
</form>
