

const moveleft = $(".moveleft");
const moveright = $(".moveright");
const noticebody = $(".overfolow");

let type = "all";
let order = "desc";
let page = 1;
let len = 0;

fetch(`getNotice.php?type=${type}&order=${order}`)
  .then(res => res.json())
  .then(data => {
    gen(data)

  })


function gen(data) {
  page = 0;
  $(".page").textContent = page + 1

  noticebody.style.transform = `translateX(0px)`
  noticebody.innerHTML = ''
  Object.keys(data).forEach(e => {
    const item = data[e]
    noticebody.innerHTML +=
      `
  <div class="notice">
    <p>${item.type}</p>
    <p>${item.title}</p>
    <p>${item.date}</p>
  </div>
      
      `
  })

  len = data.length / 6

  if (len === 3) {
    len = 2
  }
}

function nomal() {
  type = "일반"
  fetch(`getNotice.php?type=${type}&order=${order}`)
    .then(res => res.json())
    .then(data => {
      gen(data)
    })
}


function even() {
  type = "이벤트"
  fetch(`getNotice.php?type=${type}&order=${order}`)
    .then(res => res.json())
    .then(data => {
      gen(data)
    })
}

function desc() {
  order = "desc"
  fetch(`getNotice.php?type=${type}&order=${order}`)
    .then(res => res.json())
    .then(data => {
      gen(data)
    })
}

function asc() {
  order = "asc"
  fetch(`getNotice.php?type=${type}&order=${order}`)
    .then(res => res.json())
    .then(data => {
      gen(data)
    })
}

function Funmoveleft() {
  if (page <= 0) return;
  page--
  $(".page").textContent = page + 1
  noticebody.style.transform = `translateX(-${1400 * page}px)`

}
function FunmoveRight() {
  if (page >= parseInt(len)) return;
  page++
  $(".page").textContent = page + 1
  noticebody.style.transform = `translateX(-${1400 * page}px)`

}