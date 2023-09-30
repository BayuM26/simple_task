<div class="card block m-auto w-full md:max-w-6xl sm:max-w-xl max-w-md glass py-3 md:px-6 px-0">
    <h1 class="text-center text-lg font-bold">
        DATA TASK
    </h1>
    <div class="card-body">
        {{-- form tambah user --}}
            <button class="btn w-14 hover:animate-bounce bg-blue-500 hover:bg-blue-600 text-white" onclick="tambahTask.showModal()">
                +
            </button>
            
            <dialog id="tambahTask" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        <h3 class="font-bold text-lg">INPUT NEW TASK</h3>
                    </form>
                    <form action="/task" method="post" class="space-y-3  py-7 px-4">
                        @csrf
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Task Name</span>
                            </label>
                            <input value="{{ old('taskName') }}" type="text" name="taskName" placeholder="Task Name ...." class="input input-bordered @error('taskName') border-red-500 @enderror w-full" />
                            @error('taskName')
                                <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                            @enderror
                        </div>
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Deskription Task</span>
                            </label>
                            {{-- <input value="{{ old('deskription') }}" type="text" name="deskription" placeholder="deskription ...." class="input @error('deskription') border-red-500 @enderror input-bordered w-full" /> --}}
                            <textarea class="prose prose-stone  @error('taskDeskription') border-red-500 @enderror" name="taskDeskription" id="taskDeskription" rows="10" cols="80">
                                {{ old("taskDeskription") }}
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
                            <option disabled selected>choose a Name</option>
                                @forelse ($dataUser as $valueUser)
                                    <option value="{{ $valueUser->id }}">{{ $valueUser->name }}</option>
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
                            <option disabled selected>choose a category</option>
                                @forelse ($dataCategory as $valueCategory)
                                    <option value="{{ $valueCategory->id }}">{{ $valueCategory->category_name }}</option>
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
                </div>
            </dialog>
        {{-- end form tambah user --}}
        
        {{-- tabel --}}
            <div class="overflow-x-auto shadow-xl rounded-xl">
                <table class="table">
                    <thead>
                        <tr class="bg-base-300 text-center text-md text-black">
                            <th class="font-bold">No.</th>
                            <th class="font-bold">Task Name</th>
                            <th class="font-bold">Category</th>
                            <th class="font-bold">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = $dataTask->firstItem();
                        @endphp

                        @forelse ($dataTask as $valueData)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $valueData->task_name }}</td>
                                <td class="text-center">{{ $valueData->m_category->category_name }}</td>
                                <td class="text-center rounded-lg">
                                    <span class="{{ ($valueData->status == 'done')? 'bg-green-500' : 'bg-red-500' }} py-1.5 px-1 rounded-md font-semibold ">
                                        {{ $valueData->status }}
                                    </span>
                                </td>
                                <td class="flex justify-center space-x-3">
                                    <button onclick="BtnDelete({{ $valueData->id }})" class="btn bg-red-400 hover:bg-red-500">
                                        <img src="{{ asset('storage/icons/trash.svg') }}" class="text-white" alt="trash_icon" srcset="">
                                    </button>
                                    <a href="/update/task?t={{ Crypt::encryptString($valueData->id) }}" class="btn bg-blue-400 hover:bg-blue-500">
                                        <img src="{{ asset('storage/icons/pencil.svg') }}" alt="pencil_icon" srcset="">
                                    </a>
                                    <button class="btn w-14 bg-blue-500 hover:bg-blue-600 text-white" onclick={{ "detail$valueData->id.showModal()" }}>
                                        <img src="{{ asset('storage/icons/info-circle.svg') }}" alt="detail_icon" srcset="">
                                    </button>
                                    <dialog id={{ "detail".$valueData->id }} class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h3 class="font-bold text-lg">Detail Task <span class="{{ ($valueData->status == 'done')? 'bg-green-500' : 'bg-red-500' }} rounded-lg py-1.5 px-1">({{ $valueData->status }})</span></h3>
                                            <div class="mt-5 space-y-5 py-7 px-4">
                                                <h3 class="text-black text-md">Task Name : {{ $valueData->task_name }}</h3>
                                                <h3 class="text-black text-md">Category Task : {{ $valueData->m_category->category_name }}</h3>
                                                <h3 class="prose text-black">Deskription Task : <p class="text-justify">{!! $valueData->deskrip_task !!}</p> </h3>
                                            </div>
                                        </div>
                                    </dialog>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center h-20" colspan="6">DATA TASK NOT FOUND</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $dataTask->onEachSide(1)->links() }}
        {{-- end table  --}}
    </div>
</div>

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
                    url: "/task/d",
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