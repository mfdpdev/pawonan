@include('partials.header')
<div class="max-w-md min-h-dvh mx-auto flex justify-center items-center">
    <div class="container w-full mx-auto h-full p-4">
        <div class="card w-full max-w-sm bg-base-100 shadow-lg">
            <div class="card-body">
                <h2 class="card-title text-2xl justify-center">Sign Up</h2>
                <form autocomplete="off" method="post" action="{{ route('signup') }}" class="space-y-4">
                    @csrf
                    <div class="form-control">
                        <input name="name" type="text" placeholder="Name" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <input name="email" type="email" placeholder="Email" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <input name="password" type="password" placeholder="Password" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <input name="password_confirmation" type="password" placeholder="Confirm Password" class="input input-bordered" required />
                    </div>
                    <button type="submit" class="btn btn-primary w-full">Sign Up</button>
                </form>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div>
                            <div role="alert" class="alert alert-error">
                              <span>{{ $error }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                <p class="text-center text-sm mt-4">
                    Already have an account? <a href="signin.html" class="link link-primary link-hover">Sign In</a>
                </p>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')

