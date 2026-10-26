// 모든 페이지 공통 스크립트

const $ = (sel, root = document) => root.querySelector(sel);
const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];

// 금액 문자열 (예: 75,000)
const won = (n) => Math.round(n).toLocaleString("ko-KR");

// 모달 열기/닫기 (data-open="모달id", data-close)
document.addEventListener("click", (e) => {
  const opener = e.target.closest("[data-open]");
  if (opener) {
    e.preventDefault();
    $$("dialog[open]").forEach((d) => d.close());
    const dlg = document.getElementById(opener.dataset.open);
    if (dlg) dlg.showModal();
    return;
  }
  const closer = e.target.closest("[data-close]");
  if (closer) closer.closest("dialog").close();
});

// 모달 바깥(반투명 배경)을 누르면 닫기
$$("dialog.modal").forEach((dlg) => {
  dlg.addEventListener("click", (e) => {
    if (e.target === dlg) dlg.close();
  });
});

// 삭제 등 되돌릴 수 없는 동작 확인
document.addEventListener("click", (e) => {
  const link = e.target.closest("[data-confirm]");
  if (link && !confirm(link.dataset.confirm)) e.preventDefault();
});

// 모바일 메뉴 열기/닫기
const menuToggle = $(".menu-toggle");
if (menuToggle) {
  menuToggle.addEventListener("click", () => {
    const open = document.body.classList.toggle("nav-open");
    menuToggle.setAttribute("aria-expanded", open);
  });
}

// 하단 알림 메시지
let toastTimer = null;
function toast(msg, ms = 2400) {
  const el = $(".toast");
  el.textContent = msg;
  el.hidden = false;
  requestAnimationFrame(() => el.classList.add("show"));
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => {
    el.classList.remove("show");
    setTimeout(() => (el.hidden = true), 250);
  }, ms);
}

// 헤더 장바구니 수량 뱃지 갱신
function setCartCount(n) {
  const badge = $("[data-cart-count]");
  if (!badge) return;
  badge.textContent = n;
  badge.hidden = n < 1;
}

// 장바구니 담기 요청 (로그인 안 했으면 로그인 모달을 연다)
async function addToCart(idx) {
  const body = new FormData();
  body.append("idx", idx);
  const res = await fetch("./addCart.php", { method: "POST", body });
  const data = await res.json();
  if (data.needLogin) {
    toast(data.msg);
    const dlg = document.getElementById("loginModal");
    if (dlg) dlg.showModal();
    return false;
  }
  toast(data.msg);
  if (data.ok) setCartCount(data.count);
  return data.ok;
}

// [장바구니담기] / [구매하기] 버튼
document.addEventListener("click", async (e) => {
  const addBtn = e.target.closest("[data-cart-add]");
  if (addBtn) {
    addBtn.disabled = true;
    await addToCart(addBtn.dataset.cartAdd);
    addBtn.disabled = false;
    return;
  }
  const buyBtn = e.target.closest("[data-buy]");
  if (buyBtn) {
    buyBtn.disabled = true;
    if (await addToCart(buyBtn.dataset.buy)) location.href = "./sub04.php";
    buyBtn.disabled = false;
  }
});
