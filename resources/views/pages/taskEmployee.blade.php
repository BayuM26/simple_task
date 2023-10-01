<div class="space-y-6 grid md:grid-cols-3 grid-cols-1 gap-3 place-items-center">
    @forelse ($dataTask as $valueTask)
        <div class="indicator">
            @if ($valueTask->read == 0)
                <span class="indicator-item badge badge-primary">new</span>
            @endif
            <a class="tooltip" data-tip="Click me for more detail"
                href="/detail/task?dt={{ Crypt::encryptString($valueTask->id) }}">
                <div class="card w-96 bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <h2 class="card-title">{{ $valueTask->task_name }}</h2>
                            <h2 class="text-xs">{{ $valueTask->m_category->category_name }}</h2>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <h1 class="text-2xl font-bold absolute mt-96">
            YOU DON'T HAVE TASK
        </h1>
    @endforelse
</div>

