@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mx-auto w-75 bg-dark-subtle">
            <div class="card-body">
                <a href="{{ route('home') }}" class="btn btn-outline-dark mb-3">Back to Home</a>

                <h2 class="card-title">Manage profiles</h2>

                <div class="table-responsive">
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($profiles as $profile)
                            <tr>
                                <td>{{ $profile->name }}</td>
                                <td>
                                    @if(auth()->user()->role === 'admin')
                                        @if ($profile->is_active === 1)
                                            <form method="POST" action="{{ route('toggleProfileStatus', $profile) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">Active</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('toggleProfileStatus', $profile) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger">Not Active</button>
                                            </form>
                                        @endif
                                    @else
                                        <span class="text-warning">No permission</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


