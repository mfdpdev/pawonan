@include('partials.header')
<div class="flex flex-col h-dvh p-4 gap-4">
    <div class="grow w-full flex flex-col overflow-hidden">
        <form enctype="multipart/form-data" method="POST" action="{{ route('posts.update', $post->slug) }}" class="grow flex flex-col gap-4 overflow-hidden">
            @csrf
            @method('PUT')
            <div class="flex justify-between items-center">
                <h2>Update Blog</h2>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            <div>
                <div id="image-preview" class="flex flex-col gap-2 py-2">
                    <figure id="image-preview" class="bg-base-300 rounded-sm w-full h-42 overflow-hidden">
                        <img
                          src="{{ Storage::url($post->image_url) ?? '' }}"
                          id="preview-img"
                          class="" />
                    </figure>
                    <button type="button" id="remove-image" class="btn btn-primary w-full btn-disabled">Remove Image</button>
                </div>
                <fieldset class="fieldset">
                    <input id="image-input" name="imagePost" type="file" class="file-input w-full" />
                </fieldset>
            </div>
            <div>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Title</legend>
                  <input value="{{ $post->title }}" name="title" type="text" class="input input-bordered w-full" placeholder="Enter Title" />
                </fieldset>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Description</legend>
                  <textarea name="description" class="resize-none textarea w-full" placeholder="Description">{{ $post->description }}</textarea>
                </fieldset>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Ingredients</legend>
                  <input value="{{ $post->ingredients }}" name="ingredients" type="text" class="input input-bordered w-full" placeholder="Ingrediens1, Ingredients2, ..." />
                </fieldset>
            </div>
            <div class="grow flex flex-col gap-2 overflow-hidden">
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Instructions</legend>
                  <button type="button" id="add-instruction" class="btn btn-primary">Add Instruction</button>
                </fieldset>
                <div id="instructions-container" class="flex flex-col gap-4 grow overflow-auto p-2">
                    @foreach(json_decode($post->instructions) ?? [] as $instruction)
                        <div class="flex gap-2">
                            <input value={{ $instruction }} placeholder="Enter instruction" name="instructions[]" class="input input-bordered" />
                            <button type="button" class="btn btn-primary remove-instruction">Remove</button>
                        </div>
                    @endforeach
                </div>
            </div>
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
    const defaultImage = "{{ Storage::url($post->image_url) ?? '' }}";

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
        previewImg.src = defaultImage;
    });


    // Dynamic Instructions Functionality
    //document.getElementById('add-instruction').addEventListener('click', function () {
    //    const container = document.getElementById('instructions-container');
    //    const newField = document.createElement('div');
    //    newField.className = 'flex gap-2';
    //    newField.innerHTML = `
    //        <input placeholder="Enter instruction" name="instructions[]" class="input input-bordered" />
    //        <button type="button" class="btn btn-primary remove-instruction">Remove</button>
    //    `;
    //    container.appendChild(newField);

    //    // Add event listener to the remove button
    //    newField.querySelector('.remove-instruction').addEventListener('click', function () {
    //        newField.remove();
    //    });
    //});


    // Dynamic Instructions Functionality
    const instructionsContainer = document.getElementById('instructions-container');

    // Function to add remove events for dynamic instructions
    function attachRemoveEvents() {
        const removeButtons = instructionsContainer.querySelectorAll('.remove-instruction');
        removeButtons.forEach(button => {
            button.removeEventListener('click', handleRemove); // Avoid duplicates
            button.addEventListener('click', handleRemove);
        });
    }

    // Handle the remove button functionality
    function handleRemove(e) {
        const instructionDiv = e.target.closest('.flex');

        // Hapus input dan tombol dari DOM
        instructionDiv.remove();

        // Jika form di-submit, pastikan input yang sudah dihapus tidak terkirim
        // Setiap input yang dihapus, tambahkan atribut hidden atau beri flag untuk tidak terkirim
    }

    // Initial attach on page load (for existing instructions from DB)
    attachRemoveEvents();

    document.getElementById('add-instruction').addEventListener('click', function () {
        const newField = document.createElement('div');
        newField.className = 'flex gap-2';
        newField.innerHTML = `
            <input placeholder="Enter instruction" name="instructions[]" class="input input-bordered" />
            <button type="button" class="btn btn-primary remove-instruction">Remove</button>
        `;
        instructionsContainer.appendChild(newField);

        // Attach remove event to the new "Remove" button
        attachRemoveEvents();
    });
</script>
@include('partials.footer')
