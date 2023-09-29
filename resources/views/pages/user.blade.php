@extends('layouts.base')
@section('content')
    <main class="mt-10">
        <div class="min-h-screen space-y-6">
            <div class="card block m-auto w-full md:max-w-6xl sm:max-w-xl max-w-md glass">
                <div class="card-body">
                    <div class="overflow-x-auto shadow-xl rounded-xl">
                        <table class="table">
                            <thead>
                                <tr class="bg-base-300 text-center text-md text-black">
                                    <th class="font-bold">No.</th>
                                    <th class="font-bold">Name</th>
                                    <th class="font-bold">Username</th>
                                    <th class="font-bold">Jabatan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($dataUser as $valueData)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">{{ $valueData->name }}</td>
                                        <td class="text-center">{{ $valueData->username }}</td>
                                        <td class="text-center">{{ $valueData->hak_akses }}</td>
                                        <td class="flex justify-center">
                                            <button class="btn bg-red-400">
                                                <img src="{{ asset('storage/icons/trash.svg') }}" class="text-white" alt="" srcset="">
                                            </button>
                                            <button class="btn bg-blue-400">
                                                <img src="{{ asset('storage/icons/trash.svg') }}" alt="" srcset="">
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center h-40" colspan="4">DATA USER NOT FOUND</td>
                                    </tr>
                                @endforelse
                            </tbody>

                            <tfoot>
                                {{ $dataUser->onEachSide(1)->links() }}
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
