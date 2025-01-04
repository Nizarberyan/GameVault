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
  slug = title.value.replace(/\s+/g, "-").toLowerCase();

  fetch(`https://api.rawg.io/api/games/${slug}?key=${key}`)
    .then((response) => response.json())
    .then((data) => {
      title.value = data.name;
      description.value = data.description
        .replace(/^<p>/, "")
        .replace(/<\/p>$/, "");
      image.value = data.background_image;
      release_date.value = data.released;
      developer.value = data.developers[0].name;
      publisher.value = data.publishers[0].name;
      console.log(data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});

AddGame.addEventListener("click", function () {
  AddGame.preventDefault();
  title.value = "";
  steam_id.value = "";
  description.value = "";
  image.value = "";
  release_date.value = "";
  developer.value = "";
  publisher.value = "";
});
