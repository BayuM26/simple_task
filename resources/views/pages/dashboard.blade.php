@extends('layouts.base')
@section('content')
    <main>
        <div class="min-h-screen p-10 text-center">
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-value">{{ $persentase }}%</div>
                    <div class="stat-title">Tasks done</div>
                    <div class="stat-desc text-secondary">{{ $countTaskInconclusive }} tasks remaining</div>
                </div>
            </div>
        </div>
    </main>
@endsection
