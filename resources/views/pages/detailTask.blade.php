@extends('layouts.base')
@section('content')
    <main class="mt-10 mb-10">
        <div class="min-h-screen space-y-6 ">
            @foreach ($dataTask as $valueTask)
                <div class="card block m-auto w-full md:max-w-6xl sm:max-w-xl max-w-md glass p-6">
                    @include('component.arrowBack')
                    <p class="absolute right-12 {{ ($valueTask->status == 'inconclusive')? 'bg-red-500' : 'bg-green-500' }} py-1.5 px-1 rounded-lg">{{ $valueTask->status }}</p>
                    <h1 class="text-center text-lg font-bold uppercase">
                        TASK {{ $valueTask->task_name }}
                    </h1>
                    <div class="card-body">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Deskription</td>
                                        <td>:</td>
                                        <td>
                                            <p class="text-lg text-justify">
                                                {{ $valueTask->deskrip_task }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Category Task</td>
                                        <td>:</td>
                                        <td>
                                            <p class="text-md text-justify">
                                                {{ $valueTask->m_category->category_name }}
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <form action="/detail/task?d={{ Crypt::encryptString($valueTask->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-success hover:text-green-500 right-12 absolute">Done Task</button>
                    </form>
                </div>
            @endforeach
        </div>
    </main>
@endsection
