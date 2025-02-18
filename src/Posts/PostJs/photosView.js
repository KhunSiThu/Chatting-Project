const photoInput = document.getElementById('photo-input');
const previewContainer = document.getElementById('preview-container');

photoInput.addEventListener('change', function() {
    previewContainer.innerHTML = '';
    for (const file of this.files) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'preview-item';
            div.innerHTML = `
                <img src="${e.target.result}" class="preview-image">
                <button type="button"  onclick="this.parentElement.remove()">×</button>
            `;
            previewContainer.appendChild(div);
        }
        reader.readAsDataURL(file);
    }
});

function clearPreview() {
    previewContainer.innerHTML = '';
    photoInput.value = '';
}