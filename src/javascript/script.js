function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function () {
        const imageElement = document.getElementById('profileImage');
        imageElement.src = reader.result;
    };
    reader.readAsDataURL(file);
}