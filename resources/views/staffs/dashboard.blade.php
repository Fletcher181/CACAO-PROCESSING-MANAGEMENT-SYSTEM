@extends('layouts.sidebar')
@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h2>Welcome, {{ session('staff_name') }}!</h2>

        {{-- You can add more dashboard content here --}}
        <p>This is your dashboard.</p>
    </div>
@endsection
