@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $profile->name }}</div>

                    <div class="card-body">
                        <img src="{{ asset('storage/images/'.$profile->image) }}" class="card-img-top" alt="{{ $profile->name }} Image">
                        <h5 class="card-title">{{$profile->name}}</h5>
                        <p class="card-text">{{$profile->gender}}</p>
                        <p class="card-text">{{$profile->age}}</p>
                        <p class="card-text">{{$profile->bio}}</p>

{{--                        <form method="POST" action="{{ route('profile.status', ['profile' => $profile->id]) }}">--}}
{{--                            @csrf--}}
{{--                            <div class="form-check form-switch">--}}
{{--                                @auth--}}
{{--                                    @if(auth()->user()->id === $profile->user_id || auth()->user()->role === 'admin')--}}
{{--                                        <input class="form-check-input" type="checkbox" name="toggle_status" id="toggle_status" {{ $profile->active ? 'checked' : '' }}>--}}
{{--                                    @endif--}}
{{--                                @endauth--}}
{{--                                <label class="form-check-label" for="toggle_status">--}}
{{--                                    {{ $profile->active ? 'Actief' : 'Non-actief' }}--}}
{{--                                </label>--}}
{{--                            </div>--}}

                            @auth
                                @if(auth()->user()->id === $profile->user_id || auth()->user()->role === 'admin')
                                    <button type="submit" class="btn btn-primary mt-2">
                                        Opslaan
                                    </button>
                                @endif
                            @endauth
                        </form>

                        <a href="{{ route('home') }}" class="btn btn-primary">Home</a>

                        @auth
                            @if(auth()->user()->id === $profile->user_id || auth()->user()->role === 'admin')
                                <a href="{{ route('edit.profile', ['profile' => $profile->id, 'id' => $profile->id]) }}" class="btn btn-primary">Bewerken</a>
                                <form method="POST" action="{{ route('delete.profile', $profile) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Verwijderen</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


