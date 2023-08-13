@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 flex justify-center items-center">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
@endsection
