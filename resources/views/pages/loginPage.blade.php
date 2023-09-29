@extends('layouts.base')
@section('content')
    <main class="min-h-screen">
        <div class="hero min-h-screen bg-base-200">
            <div class="hero-content flex-col lg:flex-row-reverse">
                <div class="text-center lg:text-left">
                    <h1 class="md:text-5xl sm:text-3xl text-xl font-bold">TASK APPLICATION LOGIN!</h1>
                </div>
                <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                    <form action="/" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Username</span>
                                </label>
                                <input type="username" name="username" placeholder="username" class="input input-bordered" />
                                @error('username')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Password</span>
                                </label>
                                <input type="password" name="password" id="password" placeholder="password" class="input input-bordered" />
                                <button type="button" id="lookPassword" class="text-white absolute right-10 font-medium rounded-lg text-sm px-4 py-2 mt-11">
                                    <img id="mataPassword" src={{ asset("storage/icons/eye.svg") }} alt="" srcset="">
                                </button>
                                @error('password')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label cursor-pointer">
                                    <span class="label-text">Remember me</span> 
                                    <input type="checkbox" name="RememberMe" class="checkbox" />
                                </label>
                            </div>

                            <div class="form-control mt-6">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    {{-- password look --}}
        <script>
            $('#lookPassword').click(function (e) {
                if ($('#password').attr('type') === 'password') {
                    $('#mataPassword').attr('src', '{{ asset("storage/icons/eye-slash.svg") }}');
                    $('#password').attr('type', 'text');
                }else{
                    $('#mataPassword').attr('src', '{{ asset("storage/icons/eye.svg") }}');
                    $('#password').attr('type', 'password');
                }
            });
        </script>
    {{-- end password look --}}
@endsection
