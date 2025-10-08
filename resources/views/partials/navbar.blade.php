<div class="navbar bg-base-100 shadow-sm">
  <div class="w-full">
    <ul class="px-1 flex justify-around items-center">
      <li><a href="{{ route('posts') }}" >Posts</a></li>
      <li>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+</a>
      </li>
      <li>
        <div class="dropdown dropdown-top dropdown-end">
          <div tabindex="0" role="button" class="btn">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-5 w-5 stroke-current"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path> </svg>
          </div>
          <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-28 p-2 shadow-sm mb-2">
            <li>
                <form method="post" action="{{ route('signout') }}">
                    @csrf
                    <button type="submit">SignOut</a>
                </form>
            </li>
            <li><a href="{{ route('profiles') }}" >Profiles</a></li>
            <li><a href="{{ route('authenticated.posts') }}" >My Posts</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
