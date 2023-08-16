@extends('layouts.provider')

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                    role="menuitem"
                >
                    Logout
                </button>
            </form>

            <h1>Provider</h1>
        </div>
    </section>
@endsection
