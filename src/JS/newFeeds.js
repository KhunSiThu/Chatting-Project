let galleryImages = [];
let currentIndex = 0;

function openGallery(images, index) {
    galleryImages = images;
    currentIndex = index;
    document.getElementById("galleryModal").classList.remove("hidden");
    updateGalleryImage();
}

function updateGalleryImage() {
    document.getElementById("galleryImage").src = "../Posts/uploads/" + galleryImages[currentIndex];
}

function closeGallery() {
    document.getElementById("galleryModal").classList.add("hidden");
}

function prevImage() {
    if (currentIndex > 0) {
        currentIndex--;
        updateGalleryImage();
    }
}

function nextImage() {
    if (currentIndex < galleryImages.length - 1) {
        currentIndex++;
        updateGalleryImage();
    }
}

// Close on Escape Key
document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        closeGallery();
    }
});