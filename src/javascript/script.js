function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function () {
        const imageElement = document.getElementById('profileImage');
        imageElement.src = reader.result;
    };
    reader.readAsDataURL(file);
}

function searchGames() {
    const searchQuery = document.getElementById('search-bar').value.toLowerCase();
    const gameCards = document.querySelectorAll('.game-card');

    gameCards.forEach(card => {
        const gameTitle = card.querySelector('h3').textContent.toLowerCase();
        if (gameTitle.includes(searchQuery)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

if (document.getElementById('myForm')) {
    document.getElementById('myForm').addEventListener('submit', function(event) {
        var select = document.getElementById('rating');
        var selectedOption = select.options[select.selectedIndex];
        var extraValue = selectedOption.getAttribute('data-extra');
        
        document.getElementById('rating_value').value = extraValue;
      });
}