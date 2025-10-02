@include('partials.header')
<div class="max-w-md min-h-dvh mx-auto flex justify-center items-center">
    <div class="container w-full mx-auto h-full p-4">
        <!-- Sign In Card -->
        <div class="card w-full max-w-sm bg-base-100 shadow-lg">
        <div class="card-body">
            <h2 class="card-title text-2xl justify-center">Sign In</h2>
            <form class="space-y-4">
                <div class="form-control">
                    <input type="email" placeholder="Email" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <input type="password" placeholder="Password" class="input input-bordered" required />
                </div>
                <div class="flex items-center justify-between">
                    <label class="label cursor-pointer space-x-2">
                        <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" />
                        <span class="label-text">Remember me</span>
                    </label>
                    <a href="#" class="link link-primary link-hover text-sm">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn-primary w-full">Sign In</button>
            </form>
            <p class="text-center text-sm mt-4">
                Don't have an account? <a href="signup.html" class="link link-primary link-hover">Sign Up</a>
            </p>
        </div>
    </div>
    </div>
</div>
@include('partials.footer')
