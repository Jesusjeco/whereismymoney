@extends('layouts.app')

@section('content')
<div>
    <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>
    
    <div class="space-y-4">
        <p>Welcome, {{ $user->name }}!</p>
        <p>Email: {{ $user->email }}</p>
        <p>Google ID: {{ $user->google_id }}</p>
        
        <div class="pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-900 underline">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection