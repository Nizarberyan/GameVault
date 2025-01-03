document.addEventListener("DOMContentLoaded", function () {
    var toggleOpen = document.getElementById('toggleOpen');
    var toggleClose = document.getElementById('toggleClose');
    var collapseMenu = document.getElementById('collapseMenu');

    function handleClick() {
        if (collapseMenu.style.display === 'block') {
            collapseMenu.style.display = 'none';
        } else {
            collapseMenu.style.display = 'block';
        }
    }

    toggleOpen.addEventListener('click', handleClick);
    toggleClose.addEventListener('click', handleClick);


    const slides = document.querySelectorAll("#slider > div");
    if (slides) {
        let currentSlide = 0;
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = (i === index) ? 'block' : 'none';
            });
        }

        document.getElementById("next").addEventListener("click", () => {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        });

        document.getElementById("prev").addEventListener("click", () => {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        });

        setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }, 3000);

        showSlide(currentSlide);
    }
})
function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function() {
        const imageElement = document.getElementById('profileImage');
        imageElement.src = reader.result;
    };
    reader.readAsDataURL(file);
}