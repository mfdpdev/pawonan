@include('partials.header')
<div class="flex flex-col h-dvh p-4 gap-4">
    <div class="grow w-full">
        <ul class="list h-full bg-base-100 rounded-box">
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
            <ul>
                @foreach($posts as $post)
                    <li class="p-4">
                        <a href="">
                            <div class="flex bg-base-100 shadow-sm w-full rounded-sm overflow-hidden">
                                <figure class="w-82 h-44 bg-base-300">
                                    <div
                                      class="h-full bg-cover bg-center"
                                      style="background-image: url('{{ Storage::url($post->image_url) }}');"
                                    </div>
                                </figure>
                                <div class="p-4 w-full flex flex-col justify-between">
                                    <div>
                                        <h2 class="card-title">{{ $post->title }}</h2>
                                        <p>{{ $post->description }}</p>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <div class="avatar">
                                          <div class="w-8 rounded">
                                            <img src="{{ asset('images/default-profile.jpeg') }}" />
                                          </div>
                                        </div>
                                        <p>{{ $post->user->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </ul>
    </div>
    @include('partials.navbar')
</div>
@include('partials.footer')
