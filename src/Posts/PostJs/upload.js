
const fileInput = document.getElementById('fileInput');
const imageContainer = document.getElementById('imageContainer');

function triggerFileUpload() {
    fileInput.click();
}

fileInput.addEventListener('change', function (event) {
    const files = Array.from(event.target.files);
    imageContainer.innerHTML = ''; // Clear previous previews
    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const div = document.createElement('div');
            div.innerHTML = `
            <img src="${e.target.result}" class="image-preview" alt="Preview" />
            <button  onclick="removeImage(this)">Remove</button>
          `;
            imageContainer.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});

function removeImage(button) {
    const parent = button.parentElement;
    imageContainer.removeChild(parent);
}

function submitPost() {
    const postText = document.getElementById('postText').value;
    const images = Array.from(imageContainer.querySelectorAll('img')).map(img => img.src);

    if (!postText && images.length === 0) {
        alert('Please add text or upload an image.');
        return;
    }

    console.log({
        text: postText,
        images
    });
    alert('Post submitted successfully!');

    // Clear fields
    document.getElementById('postText').value = '';
    imageContainer.innerHTML = '';
    fileInput.value = '';
}
