@include('partials.header')
<div class="flex flex-col h-dvh p-4 gap-4">
    <div class="grow w-full flex flex-col overflow-hidden">
        <div class="grow flex flex-col gap-4 overflow-hidden">
            <div class="flex justify-between items-center">
                <h2>New Blog</h2>
                <button class="btn btn-primary">Publish</button>
            </div>
            <div>
                <div id="image-preview" class="flex flex-col gap-2 py-2 hidden">
                    <figure id="image-preview" class="rounded-sm w-full h-62 overflow-hidden">
                        <img
                          id="preview-img"
                          class="" />
                    </figure>
                    <button type="button" id="remove-image" class="btn btn-primary w-full">Remove Image</button>
                </div>
                <fieldset class="fieldset">
                    <input id="image-input" name="profileImage" type="file" class="file-input w-full" />
                </fieldset>
            </div>
            <div>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Title</legend>
                  <input type="text" class="input input-bordered w-full" placeholder="Enter Title" />
                </fieldset>
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Description</legend>
                  <textarea class="resize-none textarea h-24 w-full" placeholder="Description"></textarea>
                </fieldset>
            </div>
            <div class="grow flex flex-col gap-2 overflow-hidden">
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Instructions</legend>
                  <button id="add-instruction" class="btn btn-primary">Add Instruction</button>
                </fieldset>
                <div id="instructions-container" class="flex flex-col gap-4 grow overflow-auto">
                </div>
            </div>
        </div>
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
                console.log(e.target.result)
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    removeImageBtn.addEventListener('click', function() {
        imageInput.value = '';
        imagePreview.classList.add('hidden');
        previewImg.src = '';
    });

    // Dynamic Instructions Functionality
    document.getElementById('add-instruction').addEventListener('click', function () {
        const container = document.getElementById('instructions-container');
        const index = container.children.length;
        const newField = document.createElement('div');
        newField.className = 'flex gap-2';
        newField.innerHTML = `
            <input placeholder="Enter instruction" name="instruction[]" class="input input-bordered" />
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
