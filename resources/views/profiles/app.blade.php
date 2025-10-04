@include('partials.header')
<div class="flex flex-col h-dvh p-4 gap-4">
    <div class="grow w-full flex flex-col">
        <div class="card bg-base-100 shadow-sm">
          <figure class="p-6">
            <div class="w-32 h-32 rounded-md overflow-hidden ring-2 ring-primary ring-offset-base-100 ring-offset-2">
                <img
                  src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                  alt="Movie" />
            </div>
          </figure>
          <div class="card-body">
            <fieldset class="fieldset">
                  <legend class="fieldset-legend">Your Profile</legend>
                <input type="file" class="file-input w-full" />
            </fieldset>
            <fieldset class="fieldset">
              <legend class="fieldset-legend">Your Name</legend>
              <input type="text" class="input input-bordered w-full" placeholder="Type here..." />
            </fieldset>
            <button type="submit" class="btn btn-primary w-full">Update Profile</button>
          </div>
        </div>
        <div class="card bg-base-100 shadow-sm mt-4 grow">
          <div class="card-body">
            <h2 class="card-title">Change Password</h2>
            <fieldset class="fieldset">
              <legend class="fieldset-legend">New Password</legend>
              <input type="text" class="input input-bordered w-full" placeholder="Type here..." />
            </fieldset>
            <fieldset class="fieldset">
              <legend class="fieldset-legend">Confirm New Password</legend>
              <input type="text" class="input input-bordered w-full" placeholder="Type here..." />
            </fieldset>
            <button type="submit" class="btn btn-primary w-full">Update Password</button>
          </div>
        </div>
    </div>
    @include('partials.navbar')
</div>
@include('partials.footer')
