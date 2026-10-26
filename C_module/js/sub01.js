// 소개 페이지 모토 상호작용
// 한 칸에 마우스(또는 키보드 포커스)를 올리면 모든 칸이 그 이미지를 나눠 보여주고,
// 마지막 칸에 해당 모토 설명을 띄운다. 벗어나면 원래대로 돌아온다.
const motto = $(".motto");
const cols = $$(".motto-col");

function activate(col) {
  motto.classList.add("is-active");
  cols.forEach((c) => {
    c.style.backgroundImage = `url(${col.dataset.img})`;
    c.classList.toggle("is-current", c === col);
  });
  $(".motto-caption").textContent = col.dataset.des;
}

function reset() {
  motto.classList.remove("is-active");
  cols.forEach((c) => {
    c.style.backgroundImage = `url(${c.dataset.img})`;
    c.classList.remove("is-current");
  });
}

cols.forEach((col) => {
  col.addEventListener("mouseenter", () => activate(col));
  col.addEventListener("focus", () => activate(col));
});
motto.addEventListener("mouseleave", reset);
motto.addEventListener("focusout", (e) => {
  if (!motto.contains(e.relatedTarget)) reset();
});
