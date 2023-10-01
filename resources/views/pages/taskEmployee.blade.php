<div class="form-control w-full md:max-w-4xl sm:max-w-lg max-w-sm block m-auto">
    <form action="/task">
        <label class="input-group">
            <button class="bg-transparent border-2 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
            <input type="search" name="t" placeholder="Search" class="input input-bordered w-full" />
        </label>
    </form>
</div>
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

