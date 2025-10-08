@include('partials.header')
<div class="flex flex-col h-dvh p-4 gap-4">
    <div class="grow w-full flex flex-col overflow-hidden">
        <div class="grow flex flex-col gap-4 overflow-y-auto px-2">
            <div class="flex items-center gap-3 mb-2">
                <div class="avatar">
                    <div class="w-10 rounded-sm bg-base-300">
                        <img src="{{ asset('images/default-profile.jpeg') }}" />
                    </div>
                </div>
                <div>
                    <h2 class="font-bold">{{ $post->user->name }}</h2>
                </div>
            </div>
            <div>
                <h2 class="text-xl font-bold mb-2">{{ $post->title }}</h2>
                <div id="image-preview" class="flex flex-col gap-2 py-2">
                    <figure id="image-preview" class="bg-base-300 rounded-sm w-full h-52 overflow-hidden">
                        <div
                          class="h-full bg-cover bg-center"
                          style="background-image: url('{{ Storage::url($post->image_url) }}');"
                        </div>
                    </figure>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <div class="rating mb-4">
                      <input type="radio" name="rating-1" class="mask mask-star" aria-label="1 star" />
                      <input type="radio" name="rating-1" class="mask mask-star" aria-label="2 star" checked="checked" />
                      <input type="radio" name="rating-1" class="mask mask-star" aria-label="3 star" />
                      <input type="radio" name="rating-1" class="mask mask-star" aria-label="4 star" />
                      <input type="radio" name="rating-1" class="mask mask-star" aria-label="5 star" />
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">(4.2/5 dari 120 ulasan)</span>
                    </div>
                </div>
                <div class="mb-4">
                    <h3 class="font-semibold">Description</h3>
                    <p class="text-base">
                        {{ $post->description }}
                    </p>
                </div>
                <div class="mb-4">
                    <p class="text-base">
                        {{ $post->ingredients }}
                    </p>
                </div>
            </div>
            <ul class="list bg-base-100 rounded-box shadow-md">

              <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Instructions</li>

                @foreach(json_decode($post->instructions) ?? [] as $instruction)
                    <li class="list-row">
                        <div class="">{{ $loop->iteration}}</div>
                        <div class="flex items-center">
                          <div class="text-xs uppercase font-semibold opacity-60">{{ $instruction }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <ul class="list bg-base-100 rounded-box shadow-md">

              <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Comments</li>

              @foreach($post->comments as $comment)
                  <li class="list-row">
                    <div>
                        <img class="size-10 rounded-sm" src="{{ asset('images/default-profile.jpeg') }}" />
                    </div>
                    <div>
                      <div>{{ $comment->user->name }}</div>
                    </div>
                    <p class="list-col-wrap text-xs">
                        {{ $comment->content }}
                    </p>
                      @if($comment->user->id == $auth->id)
                          <button class="btn btn-ghost">Delete</button>
                      @endif
                  </li>
            @endforeach

            </ul>
        </div>
        <form method="POST" action="{{ route('posts.comments', $post->id) }}" class="p-2 flex gap-2">
            @csrf
            <input name="content" type="text" placeholder="Type here" class="input" />
            <button class="btn btn-primary">Send</button>
        </form>
    </div>
    @include('partials.navbar')
</div>
<script>
    // Image Preview Functionality
    const imageInput = document.getElementById('image-input');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const removeImageBtn = document.getElementById('remove-image');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.add('h-full');
                previewImg.classList.add('w-full');
                removeImageBtn.classList.remove('btn-disabled');
            };
            reader.readAsDataURL(file);
        }
    });

    removeImageBtn.addEventListener('click', function() {
        imageInput.value = '';
        removeImageBtn.classList.add('btn-disabled');
        previewImg.classList.remove('h-full');
        previewImg.classList.remove('w-full');
        previewImg.src = '';
    });


    // Dynamic Instructions Functionality
    document.getElementById('add-instruction').addEventListener('click', function () {
        const container = document.getElementById('instructions-container');
        const newField = document.createElement('div');
        newField.className = 'flex gap-2';
        newField.innerHTML = `
            <input placeholder="Enter instruction" name="instructions[]" class="input input-bordered" />
            <button class="btn btn-primary remove-instruction">Remove</button>
        `;
        container.appendChild(newField);

        // Add event listener to the remove button
        newField.querySelector('.remove-instruction').addEventListener('click', function () {
            newField.remove();
        });
    });
</script>
@include('partials.footer')
