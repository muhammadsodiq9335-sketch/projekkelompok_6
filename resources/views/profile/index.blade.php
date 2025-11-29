@extends('layouts.modern')

@section('title', 'Profile')
@section('header-title', 'Profile Saya')
@section('breadcrumb', 'Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random&size=128" class="rounded-circle mb-3" width="128" height="128">
                <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
                <p class="text-muted mb-4">{{ ucfirst($user->role) }}</p>
                
                <div class="row justify-content-center text-start">
                    <div class="col-md-8">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item py-3">
                                <small class="text-muted d-block">Email</small>
                                <span class="fw-medium">{{ $user->email }}</span>
                            </div>
                            <div class="list-group-item py-3">
                                <small class="text-muted d-block">Bergabung Sejak</small>
                                <span class="fw-medium">{{ $user->created_at->format('d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
