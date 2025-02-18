
function gridClasses(count, index) {
    if(count === 1) return 'row-span-2 col-span-2'; // Single photo
    if(count === 2) return 'col-span-1 row-span-2 h-96'; // Two photos side by side
    if(count === 3) {
        if(index === 0) return 'col-span-2 row-span-2 h-96'; // First photo larger
        return 'col-span-1 h-48'; // Smaller for others
    }
    return 'h-48'; // Default grid for 4+ photos
}

function openLightbox(src, showAll = false) {
    if(showAll) {
        // Implement logic to show all photos in carousel
    }
    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox-img').src = src;
}

function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
}
