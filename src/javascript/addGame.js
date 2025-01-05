let title;
let description;
let image;
let release_date;
let developer;
let publisher;
let auto_fill = document.getElementById("AutoFill");
let AddGame = document.getElementById("addGame");

let slug;

let key = "1766f20ace564900a3f023080d4be43e";
auto_fill.addEventListener("click", function () {
  title = document.getElementById("title");
  if (title.value === "") {
    alert("Please enter a title first");
  }
  description = document.getElementById("description");
  image = document.getElementById("image");
  release_date = document.getElementById("release_date");
  developer = document.getElementById("developer");
  publisher = document.getElementById("publisher");
  additional_img = document.getElementById("additional_img");
  rating = document.getElementById("rating");
  slug = title.value.replace(/\s+/g, "-").toLowerCase();

  fetch(`https://api.rawg.io/api/games/${slug}?key=${key}`)
    .then((response) => response.json())
    .then((data) => {
      title.value = data.name;
      description.value = data.description.replace(/^<p>/, "").replace(/<\/p>$/, "");
      image.value = data.background_image;
      release_date.value = data.released;
      developer.value = data.developers[0].name;
      publisher.value = data.publishers[0].name;
      additional_img.value = data.background_image_additional;
      rating.value = data.metacritic;
      console.log(data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});

const additionalImgInput = document.getElementById('additional_img2');
const imagePreviewsContainer = document.getElementById('imagePreviews');

additionalImgInput.addEventListener('change', handleImageUpload);

function handleImageUpload(event) {
  const file = event.target.files[0];
  imagePreviewsContainer.innerHTML = '';

  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const imgPreview = document.createElement('div');
      imgPreview.classList.add('relative', 'w-20', 'h-20', 'border', 'rounded');

      const img = document.createElement('img');
      img.src = e.target.result;
      img.alt = 'Preview';
      img.classList.add('w-full', 'h-full', 'object-cover', 'rounded');

      const removeBtn = document.createElement('button');
      removeBtn.classList.add('absolute', 'top-0', 'right-0', 'bg-red-600', 'text-white', 'rounded-full', 'p-1', 'text-xs');
      removeBtn.innerText = 'X';
      removeBtn.addEventListener('click', removeImage);

      imgPreview.appendChild(img);
      imgPreview.appendChild(removeBtn);
      imagePreviewsContainer.appendChild(imgPreview);
    };
    reader.readAsDataURL(file);
  }
}

function removeImage() {
  additionalImgInput.value = '';
  imagePreviewsContainer.innerHTML = '';
}
