const inputFile = document.querySelector('input[type="file"]');
const img = document.querySelector("img");

file.addEventListener("change", (e) => {
  const file = e.target.files[0];
  const reader = new FileReader();

  reader.onload = (event) => {
    const im = event.target.result;

    img.src = event.target.result;
  };

  reader.readAsDataURL(file);
});

const disContainer = document.querySelector(".isFamous");
const isFamous = document.querySelector("input[id='famous']");

isFamous.addEventListener("change", (e) => {
  if (e.target.checked) {
    disContainer.style.display = "flex";
  } else {
    disContainer.style.display = "none";
  }
});
