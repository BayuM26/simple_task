<div class="space-y-6 grid grid-cols-3 gap-3 place-items-center">
    @foreach ($dataTask as $valueTask)
        <div class="indicator">
            @if ($valueTask->read == 0)
                <span class="indicator-item badge badge-primary">new</span>
            @endif
            <a href="">
                <div class="card w-96 bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <h2 class="card-title">{{ $valueTask->task_name }}</h2>
                            <h2 class="text-xs">{{ $valueTask->m_category->category_name }}</h2>
                            {{-- <h2 class="text-md bg-red-500 rounded-md py-1.5 px-1 relative">{{ $valueTask->status }}</h2> --}}
                        </div>
                        <p>If a dog chews shoes whose shoes does he choose?</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
