const contrls = $(".contorls-container");
const video = document.querySelector("video");

let isAuto = localStorage.getItem("auto") === "true";

if (isAuto === true) {
  video.muted = true;
  video.play();
}

contrls.addEventListener("click", (e) => {
  if (e.target.classList.contains("ctrl01")) {
    video.play();
  }
  if (e.target.classList.contains("ctrl02")) {
    video.pause();
  }
  if (e.target.classList.contains("ctrl03")) {
    video.pause();
    video.currentTime = 0;
  }
  if (e.target.classList.contains("ctrl04")) {
    video.currentTime -= 10;
  }
  if (e.target.classList.contains("ctrl05")) {
    video.currentTime += 10;
  }
  if (e.target.classList.contains("ctrl06")) {
    video.playbackRate -= 0.1;
  }
  if (e.target.classList.contains("ctrl07")) {
    video.playbackRate += 0.1;
  }
  if (e.target.classList.contains("ctrl08")) {
    video.playbackRate = 1;
  }
  if (e.target.classList.contains("ctrl09")) {
    video.loop = !video.loop;
  }
  if (e.target.classList.contains("ctrl10")) {
    if (isAuto === true) {
      video.pause();
      video.currentTime = 0;
      isAuto = false;
    } else {
      video.play();
      isAuto = true;
    }
    localStorage.setItem("auto", isAuto);
  }
  if (e.target.classList.contains("ctrl11")) {
    if ($(".controls").style.display == "none") {
      $(".controls").style.display = "block";
    } else {
      $(".controls").style.display = "none";
    }
  }
});

// 영상제어

const userId = $(".userId");
let cartItems = $$(".non-user-container .product-container .item");
const modal = $(".non-user-bg");
const drop = $(".drop");
const openModal = $(".open");
const closeModal = $(".close");

closeModal.addEventListener("click", () => {
  $("body").style.overflowY = "scroll";
  modal.style.display = "none";
});
openModal.addEventListener("click", () => {
  $("body").style.overflow = "hidden";
  modal.style.display = "flex";
});

function gen() {
  const IDS = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890".split("");
  for (let i = 0; i < 6; i++) {
    const random = Math.floor(Math.random() * IDS.length);
    userId.textContent += IDS[random];
  }
}

gen();

function giveDrag() {
  cartItems = $$(".non-user-container .product-container .item");

  $$(".drop .item").forEach((e) => {
    console.log(e.querySelector("img").alt);
    if ($(`.cart .item:has(img[alt="${e.querySelector("img").alt}"])`)) {
      $(
        `.cart .item:has(img[alt="${e.querySelector("img").alt}"])`
      ).style.opacity = 0.5;
    }
  });

  cartItems.forEach((e) => {
    e.setAttribute("draggable", true);

    e.addEventListener("dragstart", (event) => {
      const data = event.dataTransfer.setData("html", e.innerHTML);
      const id = event.dataTransfer.setData("id", e.querySelector("img").alt);
    });
  });
}

function dargAndDrop() {
  drop.addEventListener("dragover", (e) => {
    e.preventDefault();
  });

  drop.addEventListener("drop", (e) => {
    const data = e.dataTransfer.getData("html");
    const id = e.dataTransfer.getData("id");
    const newBox = document.createElement("div");
    newBox.classList.add("item");
    newBox.classList.add("cloned");

    if (
      $(`.non-user-container .product-container .item:has(img[alt="${id}"])`)
    ) {
      $(
        `.non-user-container .product-container .item:has(img[alt="${id}"])`
      ).style.opacity = 0.5;
    }

    newBox.innerHTML += data;
    if (drop.querySelector(`img[alt="${id}"]`)) {
      const inputValue = drop
        .querySelector(`img[alt="${id}"]`)
        .closest(".item")
        .querySelector("input").value;
      drop
        .querySelector(`.item:has(img[alt="${id}"])`)
        .querySelector("input").value = parseInt(inputValue) + 1;
    } else {
      try {
        newBox.querySelector(".item-content").innerHTML += `
                 <div class="count">
                <input type="number" value="1" min="1" onInput="priceChange()" onChange="priceChange()" />
                <div>총: <span class="total">65,000</span> 원</div>
              </div>

    `;
        newBox.setAttribute("draggable", true);

        newBox.addEventListener("dragstart", (event) => {
          const dropId = event.dataTransfer.setData(
            "dropId",
            newBox.querySelector("img").alt
          );
          const classCheck = event.dataTransfer.setData(
            "class",
            newBox.classList
          );
        });

        $("body").addEventListener("dragover", (event) => {
          event.preventDefault();
        });

        $("body").addEventListener("drop", (event) => {
          const id = event.dataTransfer.getData("dropId");
          const classCheck = event.dataTransfer.getData("class");
          if (event.target.classList.contains("drop")) return;
          if (classCheck.includes("cloned")) {
            if ($(`.drop .item:has(img[alt="${id}"])`)) {
              $(`.drop .item:has(img[alt="${id}"])`).remove();
            }

            $(
              `.non-user-container .product-container .item:has(img[alt="${id}"])`
            ).style.opacity = 1;
            priceChange();
          }
        });
        drop.appendChild(newBox);
      } catch (error) {}
    }

    priceChange();
  });
}

function category(name, e) {
  $$(".cate div").forEach((el) => {
    el.classList.remove("active");
  });

  e.classList.add("active");

  fetch("./data.json")
    .then((res) => res.json())
    .then((data) => {
      const item = data[name];
      let i = 0;

      $(".non-user-container .product-container").innerHTML = "";

      Object.keys(item).forEach((e2) => {
        const item2 = item[e2];
        if (item2.dis !== "0") {
          $(".non-user-container .product-container").innerHTML += `
          <div class="item">
            <div class="img-cover">
              <img
                src="./asaset/A-Module/images/${name}/${parseInt(e2) + 1}.PNG"
                alt="${name}${e2}Img"
                title="${name}${e2}Img"
              />
            </div>

            <div class="item-content">
              <div class="item-title">${item2.title}</div>
              <div class="item-price">
                <span class="price">${item2.price}</span>
                <span style="text-decoration: line-through; color: gray"
                  >${item2.dis}</span
                >
              </div>
        
            </div>
          </div>
        `;
        } else {
          $(".non-user-container .product-container").innerHTML += `
          <div class="item">
            <div class="img-cover">
              <img
                src="./asaset/A-Module/images/${name}/${parseInt(e2) + 1}.PNG"
                alt="${name}${e2}Img"
                title="${name}${e2}Img"
              />
            </div>

            <div class="item-content">
              <div class="item-title">${item2.title}</div>
              <div class="item-price">
<span class="price">${item2.price}</span>              </div>
      
            </div>
          </div>
        `;
        }

        i++;
      });

      giveDrag();
    });
}

function priceChange() {
  cartItems = $$(".non-user-container .drop.product-container .item");
  let total = 0;
  cartItems.forEach((e) => {
    const price = parseInt(
      e.querySelector(".price").textContent.replace(/[^0-9]/g, "")
    );
    const inputValue = parseInt(e.querySelector("input").value);
    let cost = 0;
    if (inputValue == 0 || !e.querySelector("input").value.trim()) {
      cost = 0;
    } else {
      cost = price * inputValue;
    }

    e.querySelector(".total").textContent = cost.toLocaleString("en-us");

    total += cost;
  });

  $(".total span").textContent = total.toLocaleString("en-us");
}

category("건강식품", $(".active"));
dargAndDrop();

$(".checoutBtn").addEventListener("click", (e) => {
  if ($(".total span").textContent === "0") {
    alert("물건을 선택해주세요");
  } else {
    $(".user-alert").style.display = "block";
    $(".user-name").textContent = $(".userId").textContent.replace("ID:  ", "");
    $(".cost").textContent = $(".total span").textContent;

    $(".drop.product-container").innerHTML = "";
    category("건강식품", $(".active"));
    $("body").style.overflowY = "scroll";

    setTimeout(() => {
      $(".user-alert").style.display = "none";
    }, 3000);

    modal.style.display = "none";
  }
});
category("건강식품", $(".active"));

// 드래그앤드롭

const buyBtns = $$(".get");

buyBtns.forEach((e) => {
  e.addEventListener("click", () => {
    fetch(`./addCart.php?idx=${e.closest(".item").getAttribute("data-id")}`)
      .then((res) => res.text())
      .then((data) => {
        alert(data);
      });
  });
});

$$(".item-price .price").forEach((e) => {
  const num = parseInt(e.textContent.replace(/[^0-9]/g, ""));
  if (num == 1) {
    e.textContent = e.textContent = (
      parseInt(
        e
          .closest(".item-price")
          .querySelector("span:nth-child(2)")
          .textContent.replace(/[^0-9]/g, "")
      ) - 10000
    ).toLocaleString("en-us");
  } else if (num == 2) {
    e.textContent = (
      parseInt(
        e
          .closest(".item-price")
          .querySelector("span:nth-child(2)")
          .textContent.replace(/[^0-9]/g, "")
      ) * 0.9
    ).toLocaleString("en-us");
  } else if (num == 3) {
    e.textContent = (
      parseInt(
        e
          .closest(".item-price")
          .querySelector("span:nth-child(2)")
          .textContent.replace(/[^0-9]/g, "")
      ) * 0.7
    ).toLocaleString("en-us");
  }
});
