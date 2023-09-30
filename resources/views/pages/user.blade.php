@extends('layouts.base')
@section('content')
    <main class="mt-10 mb-10">
        <div class="min-h-screen space-y-6">
            <div class="card block m-auto w-full md:max-w-6xl sm:max-w-xl max-w-md glass p-6">
                <h1 class="text-center text-lg font-bold">
                    DATA USER
                </h1>
                <div class="card-body">
                    {{-- form tambah user --}}
                        <button class="btn w-14 hover:animate-bounce bg-blue-500 hover:bg-blue-600 text-white" onclick="tambahUser.showModal()">
                            +
                        </button>
                        
                        <dialog id="tambahUser" class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    <h3 class="font-bold text-lg">INPUT NEW USER</h3>
                                </form>
                                <form action="/user" method="post" class="space-y-3  py-7 px-4">
                                    @csrf
                                    <div class="form-control w-full">
                                        <label class="label">
                                            <span class="label-text">Name</span>
                                        </label>
                                        <input value="{{ old('name') }}" type="text" name="name" placeholder="Name ...." class="input input-bordered @error('name') border-red-500 @enderror w-full" />
                                        @error('name')
                                            <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                        @enderror
                                    </div>
                                    <div class="form-control w-full">
                                        <label class="label">
                                            <span class="label-text">Username</span>
                                        </label>
                                        <input value="{{ old('username') }}" type="text" name="username" placeholder="Username ...." class="input @error('username') border-red-500 @enderror input-bordered w-full" />
                                        @error('username')
                                            <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                        @enderror
                                    </div>
                                    <div class="form-control w-full">
                                        <label class="label">
                                            <span class="label-text">Password</span>
                                        </label>
                                        <input value="{{ old('password') }}" type="text" name="password" placeholder="Password ...." class="input @error('password') border-red-500 @enderror input-bordered w-full" />
                                        @error('password')
                                            <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                        @enderror
                                    </div>
                                    <div class="form-control w-full">
                                        <label class="label">
                                            <span class="label-text">Position</span>
                                        </label>
                                        <select name="position" class="select select-bordered @error('position') border-red-500 @enderror w-full">
                                        <option disabled selected>choose a position</option>
                                            <option value="Employe">Employe</option>
                                        </select>
                                        @error('position')
                                            <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                        @enderror
                                    </div>

                                    <div class="modal-action mt-5">
                                        <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 w-full font-bold text-white">Input</button>
                                    </div>
                                </form>
                            </div>
                        </dialog>
                    {{-- end form tambah user --}}

                    {{-- tabel --}}
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
                                            <td class="flex justify-center space-x-3">
                                                <button onclick="BtnDelete({{ $valueData->id }})"
                                                    class="btn bg-red-400 hover:bg-red-500">
                                                    <img src="{{ asset('storage/icons/trash.svg') }}" class="text-white"
                                                        alt="trash_icon" srcset="">
                                                </button>
                                                <a href="" class="btn bg-blue-400 hover:bg-blue-500">
                                                    <img src="{{ asset('storage/icons/pencil.svg') }}" alt="pencil_icon"
                                                        srcset="">
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center h-20" colspan="5">DATA USER NOT FOUND</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                
                            </table>
                        </div>
                        {{ $dataUser->onEachSide(1)->links() }}
                    {{-- end table --}}
                </div>
            </div>
        </div>
    </main>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });

        function BtnDelete(id) {
            Swal.fire({
                title: 'PERINGATAN',
                text: 'APAKAH ANDA YAKIN INGIN MENGHAPUS DATA INI?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'DELETE'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/user/d",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': id,
                        },
                        success: function(response) {
                            if (response.code === 200) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'DATA BERHASIL DIHAPUS'
                                }).then(function() {
                                    location.reload();
                                })
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection
