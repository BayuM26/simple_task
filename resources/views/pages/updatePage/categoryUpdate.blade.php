@extends('layouts.base')
@section('content')
    <main class="mt-10 mb-10">
        <div class="min-h-screen space-y-6">
            <div class="card block m-auto w-full md:max-w-6xl sm:max-w-xl max-w-md glass p-6">
                @include('component.arrowBack')
                <h1 class="text-center text-lg font-bold">
                    DATA CATEGORY
                </h1>
                <div class="card-body">
                    @foreach ($dataCategory as $valueCategory)
                        <form action="/update/category/{{ Crypt::encryptString($valueCategory->id) }}" method="post" class="space-y-3  py-7 px-4">
                            @csrf
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Category Name</span>
                                </label>
                                <input value="{{ $valueCategory->category_name }}" type="text" name="categoryName" placeholder="Category Name ...." class="input input-bordered @error('categoryName') border-red-500 @enderror w-full" />
                                @error('categoryName')
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