@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="GET" action="{{ route('search') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Zoek op naam" value="{{ old('search') }}">
                <select class="form-select" name "gender" id="gender">
                <option value="" selected>Alle geslachten</option>
                <option value="male">Man</option>
                <option value="female">Vrouw</option>
                </select>
                <button type="submit" class="btn btn-primary">Zoeken</button>
            </div>
        </form>
        <a href="{{ route('create') }}" class="btn btn-primary mb-3 @if(auth()->user()->likes->count() < 2) disabled @endif">Profiel aanmaken</a>
        <br>
        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('manage') }}" class="btn btn-primary mb-3">Profielen beheren</a>
            @endif
        @endauth
        <div class="row">
            @if($profiles !== null)
                @if(count($profiles) > 0)
                    @foreach($profiles as $profile)
                        @if($profile->is_active == 1) <!-- Voeg deze voorwaarde toe om alleen actieve profielen weer te geven -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/images/' . $profile->image) }}" class="card-img-top" alt="{{ $profile->name }} Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $profile->name }}</h5>
                                    <p class="card-text">{{ $profile->gender }}</p>
                                    <p class="card-text">{{ $profile->age }}</p>
                                    <p class="card-text">{{ $profile->bio }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('view.profile', ['id' => $profile->id]) }}" class="btn btn-primary">Bekijk profiel</a>
                                        <form method="POST" action="{{ route('like.profile', ['id' => $profile->id]) }}">
                                            @csrf
                                            <div id="like-notification" class="alert alert-success" style="display: none;">
                                                Profiel geliket!
                                            </div>
                                            <button type="submit" class="btn @if(auth()->user()->likes->contains($profile->id)) unlike-button @else like-button @endif" style="color: black;">
                                                @if(auth()->user()->likes->contains($profile->id))
                                                    Unlike
                                                @else
                                                    Like
                                                @endif
                                            </button>
                                        </form>
                                        <span class="like-count">{{ $profile->likes->count() }} likes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @else
                    <p>Geen overeenkomsten gevonden.</p>
                @endif
            @else
                <p>Geen overeenkomsten gevonden.</p>
            @endif
        </div>
    </div>
@endsection
