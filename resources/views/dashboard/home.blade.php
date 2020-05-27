@extends('layouts.app')

@section('title', 'Dashboard Home')

@section('content')
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            {{ env('APP_NAME') }} Dashboard
        </div>
    </div>

    <div class="card-deck">
        @hook('admin_dashboard_home_quick_panel')
    </div>
@endsection
