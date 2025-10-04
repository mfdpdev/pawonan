@include('partials.header')
<div class="h-dvh mx-auto flex justify-center items-center p-4">
        <!-- Sign In Card -->
        <div class="card w-full bg-base-100 shadow-lg">
        <div class="card-body">
            <h2 class="card-title text-2xl justify-center">Sign In</h2>
            <form autocomplete="off" method="post" action="{{ route('signin') }}" class="space-y-4">
                @csrf
                <div class="form-control">
                    <input name="email" value="{{ old('email') }}" type="email" placeholder="Email" class="w-full input input-bordered" required />
                </div>
                <div class="form-control">
                    <input name="password" type="password" class="w-full input input-bordered" required placeholder="Password" />
                </div>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div>
                            <div role="alert" class="alert alert-error">
                              <span>{{ $error }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="flex items-center justify-between">
                    <label class="label cursor-pointer space-x-2">
                        <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" />
                        <span class="label-text">Remember me</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-full">Sign In</button>
            </form>
            <p class="text-center text-sm mt-4">
                Don't have an account? <a href="{{ route('signup') }}" class="link link-primary link-hover">Sign Up</a>
            </p>
        </div>
    </div>
</div>
@include('partials.footer')
