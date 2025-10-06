@include('partials.header')
<div class="flex flex-col h-dvh p-4 gap-4">
    <div class="grow w-full flex flex-col">
        <div class="card bg-base-100 shadow-sm">
          <figure class="p-6">
            <div class="w-32 h-32 rounded-md overflow-hidden ring-2 ring-primary ring-offset-base-100 ring-offset-2">
                <img
                  src="{{ asset($user->profile_image_path ?? 'images/default-profile.jpeg') }}"
                  alt="Movie" />
            </div>
          </figure>
          <h2 class="card-title mx-auto">{{ $user->name ?? 'Guest' }}</h2>
            <form class="card-body" method="post" action="{{ route('updateProfile') }}" >
                @csrf
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Your Profile</legend>
                    <input name="profileImage" type="file" class="file-input w-full" />
                </fieldset>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Your Name</legend>
                  <input name="name" value="{{ old('name', $user->name) }}" type="text" class="input input-bordered w-full" placeholder="Type here..." />
                </fieldset>
                <button type="submit" class="btn btn-primary w-full">Update Profile</button>
            </form>
        </div>
        <div class="card bg-base-100 shadow-sm mt-4 grow">
            <form class="card-body" method="post" action="{{ route('updatePassword') }}" >
                @csrf
                <h2 class="card-title">Change Password</h2>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">New Password</legend>
                  <input name="password" type="password" class="input input-bordered w-full" placeholder="Type here..." />
                </fieldset>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Confirm New Password</legend>
                  <input name="password_confirmation" type="password" class="input input-bordered w-full" placeholder="Type here..." />
                </fieldset>
                <button type="submit" class="btn btn-primary w-full">Update Password</button>
            </form>
        </div>
    </div>
    @include('partials.navbar')
</div>
@include('partials.footer')
