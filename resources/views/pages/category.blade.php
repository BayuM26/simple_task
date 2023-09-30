@extends('layouts.base')
@section('content')
    <main class="mt-10 mb-10">
        <div class="min-h-screen space-y-6">
            <div class="card block m-auto w-full md:max-w-6xl sm:max-w-xl max-w-md glass p-6">
                <h1 class="text-center text-lg font-bold">
                    DATA CATEGORY
                </h1>
                <div class="card-body">
                    <div class="overflow-x-auto shadow-xl rounded-xl">
                        <table class="table">
                            <thead>
                                <tr class="bg-base-300 text-center text-md text-black">
                                    <th class="font-bold">No.</th>
                                    <th class="font-bold">Category Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($dataCategory as $valueData)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">{{ $valueData->category_name}}</td>
                                        <td class="flex justify-center space-x-3">
                                            <button onclick="BtnDelete({{ $valueData->id }})" class="btn bg-red-400">
                                                <img src="{{ asset('storage/icons/trash.svg') }}" class="text-white" alt="trash_icon" srcset="">
                                            </button>
                                            <button class="btn bg-blue-400">
                                                <img src="{{ asset('storage/icons/pencil.svg') }}" alt="pencil_icon" srcset="">
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center h-20" colspan="5">DATA CATEGORY NOT FOUND</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $dataCategory->onEachSide(1)->links() }}
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
                        url: "/category/d",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': id,
                        },
                        success: function (response) {
                            if (response.code === 200) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'DATA BERHASIL DIHAPUS'
                                }).then(function (){
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