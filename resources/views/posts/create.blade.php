@include('partials.header')
<div class="flex flex-col h-dvh p-4 gap-4">
    <div class="grow w-full flex flex-col overflow-hidden">
        <form enctype="multipart/form-data" method="post" action="{{ route('posts.create') }}" class="grow flex flex-col gap-4 overflow-hidden">
            @csrf
            <div class="flex justify-between items-center">
                <h2>New Blog</h2>
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>
            <div>
                <div id="image-preview" class="flex flex-col gap-2 py-2">
                    <div id="image-preview" class="bg-base-300 rounded-sm w-full h-62 overflow-hidden">
                        <figure
                          id="preview-img"
                          class="bg-cover bg-center h-full" >
                        </figure>
                    </div>
                    <button type="button" id="remove-image" class="btn btn-primary w-full btn-disabled">Remove Image</button>
                </div>
                <fieldset class="fieldset">
                    <input id="image-input" name="imagePost" type="file" class="file-input w-full" />
                </fieldset>
            </div>
            <div>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Title</legend>
                  <input name="title" type="text" class="input input-bordered w-full" placeholder="Enter Title" />
                </fieldset>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Description</legend>
                  <textarea name="description" class="resize-none textarea w-full" placeholder="Description"></textarea>
                </fieldset>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Ingredients</legend>
                  <input name="ingredients" type="text" class="input input-bordered w-full" placeholder="Ingrediens1, Ingredients2, ..." />
                </fieldset>
            </div>
            <div class="grow flex flex-col gap-2 overflow-hidden">
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Instructions</legend>
                  <button type="button" id="add-instruction" class="btn btn-primary">Add Instruction</button>
                </fieldset>
                <div id="instructions-container" class="flex flex-col gap-4 grow overflow-auto p-2">
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

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.style.backgroundImage = `url(${e.target.result})`;
                removeImageBtn.classList.remove('btn-disabled');
            };
            reader.readAsDataURL(file);
        }
    });

    removeImageBtn.addEventListener('click', function() {
        imageInput.value = '';
        removeImageBtn.classList.add('btn-disabled');
        previewImg.style.backgroundImage = '';
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
