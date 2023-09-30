@extends('layouts.base')
@section('content')
    <main class="mt-10 mb-10">
        <div class="min-h-screen space-y-6">
            @if (auth()->user()->hak_akses == 'admin')
                @include('pages.taskAdmin')
            @else
                @include('pages.taskEmployee')
            @endif
        </div>
    </main>
@endsection