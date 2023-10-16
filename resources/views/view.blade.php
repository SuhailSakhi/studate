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
                        <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
