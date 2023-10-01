@extends('layouts.base')
@section('content')
    <main class="mt-10 mb-10">
        <div class="min-h-screen space-y-6">
            <div class="card block m-auto w-full md:max-w-6xl sm:max-w-xl max-w-md glass p-6">
                @include('component.arrowBack')
                <h1 class="text-center text-lg font-bold">
                    DATA TASK
                </h1>
                <div class="card-body">
                    @foreach ($dataTask as $valueTask)
                        <form action="/update/task/{{ Crypt::encryptString($valueTask->id) }}" method="post" class="space-y-3 py-7 px-4">
                            @csrf
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Task Name</span>
                                </label>
                                <input value="{{ $valueTask->task_name }}" type="text" name="taskName" placeholder="Task Name ...." class="input input-bordered @error('taskName') border-red-500 @enderror w-full" />
                                @error('taskName')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Deskription Task</span>
                                </label>
                                <textarea class="prose prose-stone  @error('taskDeskription') border-red-500 @enderror" name="taskDeskription" id="taskDeskription" rows="10" cols="80">
                                    {{ $valueTask->deskrip_task }}
                                </textarea>
                                @error('taskDeskription')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">whose task is it for?</span>
                                </label>
                                <select name="employee" class="select select-bordered @error('employee') border-red-500 @enderror w-full">
                                <option disabled>choose a Name</option>
                                    @forelse ($dataUser as $valueUser)
                                        <option {{ ($valueTask->id_user == $valueUser->id)? 'selected' : '' }} value="{{ $valueUser->id }}">{{ $valueUser->name }}</option>
                                    @empty
                                        <a href="/user">
                                            <option>EMPLOYEE NOT FOUND</option>
                                        </a>
                                    @endforelse
                                </select>
                                @error('employee')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Category Task</span>
                                </label>
                                <select name="category" class="select select-bordered @error('category') border-red-500 @enderror w-full">
                                <option disabled >choose a category</option>
                                    @forelse ($dataCategory as $valueCategory)
                                        <option {{ ($valueTask->id_category == $valueCategory->id)? 'selected' : '' }} value="{{ $valueCategory->id }}">{{ $valueCategory->category_name }}</option>
                                    @empty
                                        <a href="/category">
                                            <option>CATEGORY NOT FOUND</option>
                                        </a>
                                    @endforelse
                                </select>
                                @error('category')
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
    
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
        .create( document.querySelector( '#taskDeskription' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
    </script>
@endsection