const box = document.querySelector(".prodcut")

fetch("./data.json")
  .then(res => res.json())
  .then(data => {
    Object.keys(data).forEach((e) => {
      const newBox = document.createElement("div")
      newBox.classList.add("items")
      newBox.classList.add(e)
      const item = data[e]
      Object.keys(item).forEach((e2) => {
        const item2 = item[e2]
        if (item2.dis !== "0") {
          newBox.innerHTML += `
          <div class="item">
            <div class="img-cover">
              <img
                src="./asaset/A-Module/images/${e}/${parseInt(e2) + 1}.PNG"
                alt="${e}${e2}Img"
                title="${e}${e2}Img"
              />
            </div>

            <div class="item-content">
              <div class="item-title">${item2.title}</div>
              <div class="item-price">
                ${item2.price}
                <span style="text-decoration: line-through; color: gray"
                  >${item2.dis}</span
                >
              </div>
              <div class="btns">
                <a class="buy">구매하기</a>
                <a class="get">장바구니담기</a>
              </div>
            </div>
          </div>
        `

        } else {
          newBox.innerHTML += `
          <div class="item">
            <div class="img-cover">
              <img
                src="./asaset/A-Module/images/${e}/${parseInt(e2) + 1}.PNG"
                alt="${e}${e2}Img"
                title="${e}${e2}Img"
              />
            </div>

            <div class="item-content">
              <div class="item-title">${item2.title}</div>
              <div class="item-price">
                ${item2.price}
              </div>
              <div class="btns">
                <a class="buy">구매하기</a>
                <a class="get">장바구니담기</a>
              </div>
            </div>
          </div>
        `

        }
      })
      box.appendChild(newBox)
    })
  })