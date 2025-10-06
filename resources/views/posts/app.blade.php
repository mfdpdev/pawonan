@include('partials.header')
<div class="flex flex-col h-dvh p-4 gap-4">
    <div class="grow w-full">
        <ul class="list h-full bg-base-100 rounded-box shadow-sm">
            <li class="p-4">
                <label class="input w-full">
                  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g
                      stroke-linejoin="round"
                      stroke-linecap="round"
                      stroke-width="2.5"
                      fill="none"
                      stroke="currentColor"
                    >
                      <circle cx="11" cy="11" r="8"></circle>
                      <path d="m21 21-4.3-4.3"></path>
                    </g>
                  </svg>
                  <input type="search" required placeholder="Search" />
                </label>
            </li>
            <li class="p-4">
                <a href="">
                    <div class="flex bg-base-100 shadow-sm w-full rounded-sm overflow-hidden">
                        <figure>
                            <div class="w-36 h-44">
                                <img
                                  src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                                  alt="Movie" />
                            </div>
                        </figure>
                        <div class="p-4 w-full flex flex-col justify-between">
                            <div>
                                <h2 class="card-title">Title</h2>
                                <p>Click the button to watch on Jetflix app.</p>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div class="avatar">
                                  <div class="w-8 rounded">
                                    <img src="https://img.daisyui.com/images/profile/demo/batperson@192.webp" />
                                  </div>
                                </div>
                                <p>Username</p>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    @include('partials.navbar')
</div>
@include('partials.footer')
