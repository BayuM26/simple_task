@extends('layouts.base')
@section('content')
    <main class="mt-10 mb-10">
        <div class="min-h-screen space-y-6">
            <div class="card block m-auto w-full md:max-w-6xl sm:max-w-xl max-w-md glass p-6">
                @include('component.arrowBack')
                <h1 class="text-center text-lg font-bold">
                    DATA UPDATE USER
                </h1>
                <div class="card-body">
                    @foreach ($dataUser as $valueUser)
                        <form action="/update/user/{{ Crypt::encryptString($valueUser->id) }}" method="post" class="space-y-3 py-7 px-4">
                            @csrf
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Name</span>
                                </label>
                                <input value="{{ $valueUser->name }}" type="text" name="name" placeholder="Name ...." class="input input-bordered @error('name') border-red-500 @enderror w-full" />
                                @error('name')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Username</span>
                                </label>
                                <input value="{{ $valueUser->username }}" type="text" name="username" placeholder="Username ...." class="input @error('username') border-red-500 @enderror input-bordered w-full" />
                                @error('username')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Position</span>
                                </label>
                                <select name="position" class="select select-bordered @error('position') border-red-500 @enderror w-full">
                                    <option disabled>choose a position</option>
                                    <option {{ ($valueUser->hak_akses == 'Employe')? 'selected' : '' }} value="Employe">Employe</option>
                                </select>
                                @error('position')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>

                            <div class="modal-action mt-5">
                                <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 w-full font-bold text-white">Input</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
