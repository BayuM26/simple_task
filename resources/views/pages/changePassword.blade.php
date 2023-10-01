@extends('layouts.base')
@section('content')
    <main class="min-h-screen">
        <div class="hero min-h-screen">
            <div class="hero-content flex-col lg:flex-row-reverse">
                <div class="text-center lg:text-left">
                    <h1 class="md:text-5xl sm:text-3xl text-xl font-bold">CHANGE PASSWORD</h1>
                </div>
                <div class="card flex-shrink-0 w-full max-w-xl shadow-2xl bg-base-100">
                    <form action="/" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Old Password</span>
                                </label>
                                <input type="password" name="oldPassword" id="oldPassword" placeholder="oldPassword" class="input input-bordered" />
                                @error('oldPassword')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">New Password</span>
                                </label>
                                <input type="password" name="newPassword" id="newPassword" placeholder="newPassword" class="input input-bordered" />
                                @error('newPassword')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Repeat New Password</span>
                                </label>
                                <input type="password" name="repeatNewPassword" id="repeatNewPassword" placeholder="repeatNewPassword" class="input input-bordered" />
                                @error('repeatNewPassword')
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ Str::upper($message) }}</span></p>
                                @enderror
                            </div>
                            
                            <div class="form-control">
                                <label class="label cursor-pointer">
                                    <span class="label-text">Look Password</span> 
                                    <input type="checkbox" id="lookPassword" name="RememberMe" class="checkbox" />
                                </label>
                            </div>

                            <div class="form-control mt-6">
                                <button type="submit" class="btn btn-primary">Change</button>
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
                if ($('#oldPassword').attr('type') === 'password') {
                    $('#oldPassword').attr('type', 'text');
                    $('#newPassword').attr('type', 'text');
                    $('#repeatNewPassword').attr('type', 'text');
                }else{
                    $('#oldPassword').attr('type', 'password');
                    $('#newPassword').attr('type', 'password');
                    $('#repeatNewPassword').attr('type', 'password');
                }
            });
        </script>
    {{-- end password look --}}
@endsection
