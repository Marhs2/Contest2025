// 전체상품 페이지: 광고 동영상 컨트롤, 비회원 주문(드래그&드롭)

/* ---------- 동영상 컨트롤 ---------- */
const video = $("#player video");
const AUTO_KEY = "giftsmall-autoplay";
let autoPlay = localStorage.getItem(AUTO_KEY) === "true";

// 배속은 0.1 단위로 소수점 오차 없이 계산 (0.1배 ~ 4배)
function setRate(rate) {
  video.playbackRate = Math.min(4, Math.max(0.1, Math.round(rate * 10) / 10));
}

function updateStatus() {
  $("#vRate").textContent = video.playbackRate.toFixed(1) + "x";
  $("#vLoop").textContent = video.loop ? "반복 켜짐" : "반복 꺼짐";
  $("#vAuto").textContent = autoPlay ? "자동재생 켜짐" : "자동재생 꺼짐";
  $('[data-v="loop"]').setAttribute("aria-pressed", video.loop);
  $('[data-v="auto"]').setAttribute("aria-pressed", autoPlay);
  $("#player").classList.toggle("is-playing", !video.paused);
}

// 브라우저 정책상 소리가 있으면 자동재생이 막히므로 음소거 후 재생
function safePlay() {
  video.play().catch(() => {
    video.muted = true;
    video.play().catch(() => {});
  });
}

const actions = {
  play: () => safePlay(),
  pause: () => video.pause(),
  stop: () => {
    video.pause();
    video.currentTime = 0;
  },
  back: () => (video.currentTime = Math.max(0, video.currentTime - 10)),
  forward: () => (video.currentTime = Math.min(video.duration || 0, video.currentTime + 10)),
  slower: () => setRate(video.playbackRate - 0.1),
  faster: () => setRate(video.playbackRate + 0.1),
  normal: () => setRate(1),
  loop: () => (video.loop = !video.loop),
  auto: () => {
    autoPlay = !autoPlay;
    localStorage.setItem(AUTO_KEY, autoPlay);
    if (autoPlay && video.paused) safePlay();
  },
  toggle: (btn) => {
    const hidden = $("#player").classList.toggle("controls-hidden");
    btn.setAttribute("aria-expanded", !hidden);
    btn.querySelector("span").textContent = hidden ? "컨트롤러 보이기" : "컨트롤러 숨기기";
  },
};

$("#player").addEventListener("click", (e) => {
  const btn = e.target.closest("[data-v]");
  if (!btn) return;
  actions[btn.dataset.v](btn);
  updateStatus();
});
["play", "pause", "ratechange", "ended"].forEach((ev) => video.addEventListener(ev, updateStatus));

if (autoPlay) {
  video.muted = true;
  safePlay();
}
updateStatus();

/* ---------- 비회원 주문 ---------- */
const guestModal = $("#guestModal");
const display = $("#guestDisplay");
const orderZone = $("#guestOrder");
const orderList = $("#guestOrderList");
const order = new Map(); // idx -> 수량
let draggingFromOrder = null;

// 영숫자 6자리 랜덤 ID
function randomId() {
  const chars = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
  return Array.from({ length: 6 }, () => chars[Math.floor(Math.random() * chars.length)]).join("");
}

const itemOf = (idx) => GUEST_ITEMS.find((it) => it.idx === idx);
const esc = (s) =>
  String(s).replace(/[&<>"']/g, (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" })[c]);

// 전시영역: 카테고리별 전체상품
function renderDisplay() {
  display.innerHTML = CATES.map(
    (cate) => `
    <div class="g-cate">
      <h4>${esc(cate)}</h4>
      <div class="g-items">
        ${GUEST_ITEMS.filter((it) => it.cate === cate)
          .map(
            (it) => `
          <div class="g-item" draggable="true" data-idx="${it.idx}">
            <img src="${esc(it.img)}" alt="${esc(it.title)}" title="${esc(it.title)}" draggable="false" />
            <p class="g-name">${esc(it.title)}</p>
            <p class="g-price">${won(it.price)}원 ${it.badge ? `<del>${won(it.origin)}</del>` : ""}</p>
          </div>`
          )
          .join("")}
      </div>
    </div>`
  ).join("");
}

// 주문영역 + 결제영역
function renderOrder() {
  if (order.size === 0) {
    orderList.innerHTML = `<p class="g-empty">여기에 상품을 끌어다 놓으세요</p>`;
  } else {
    orderList.innerHTML = [...order]
      .map(([idx, qty]) => {
        const it = itemOf(idx);
        return `
        <div class="g-line" draggable="true" data-idx="${idx}">
          <img src="${esc(it.img)}" alt="${esc(it.title)}" title="${esc(it.title)}" draggable="false" />
          <div class="g-line-info">
            <p class="g-name">${esc(it.title)}</p>
            <p class="muted">단가 ${won(it.price)}원</p>
          </div>
          <label class="g-qty"><span class="sr-only">수량</span>
            <input type="number" min="1" max="99" value="${qty}" data-qty="${idx}" />
          </label>
          <p class="g-amount">${won(it.price * qty)}원</p>
          <button type="button" class="icon-btn sm" data-remove="${idx}" aria-label="${esc(it.title)} 빼기"><i class="fa fa-times"></i></button>
        </div>`;
      })
      .join("");
  }

  // 주문영역에 옮겨진 상품은 전시영역에서 반투명 처리
  $$(".g-item", display).forEach((el) => el.classList.toggle("is-picked", order.has(+el.dataset.idx)));

  const total = [...order].reduce((sum, [idx, qty]) => sum + itemOf(idx).price * qty, 0);
  $("#guestTotal").textContent = won(total);
}

// 전시영역 → 주문영역 끌기 시작
display.addEventListener("dragstart", (e) => {
  const el = e.target.closest(".g-item");
  if (!el) return;
  e.dataTransfer.setData("text/plain", "add:" + el.dataset.idx);
  e.dataTransfer.effectAllowed = "copy";
});

// 주문영역 → 밖으로 끌기 시작 (선택 취소용)
orderList.addEventListener("dragstart", (e) => {
  const el = e.target.closest(".g-line");
  if (!el) return;
  draggingFromOrder = +el.dataset.idx;
  e.dataTransfer.setData("text/plain", "remove:" + el.dataset.idx);
  e.dataTransfer.effectAllowed = "move";
  el.classList.add("is-dragging");
});
orderList.addEventListener("dragend", () => {
  draggingFromOrder = null;
  $$(".g-line.is-dragging").forEach((el) => el.classList.remove("is-dragging"));
});

orderZone.addEventListener("dragover", (e) => {
  e.preventDefault();
  orderZone.classList.add("is-over");
});
orderZone.addEventListener("dragleave", (e) => {
  if (!orderZone.contains(e.relatedTarget)) orderZone.classList.remove("is-over");
});
orderZone.addEventListener("drop", (e) => {
  e.preventDefault();
  e.stopPropagation();
  orderZone.classList.remove("is-over");
  const [act, id] = e.dataTransfer.getData("text/plain").split(":");
  if (act !== "add") return;
  const idx = +id;
  order.set(idx, (order.get(idx) || 0) + 1);
  renderOrder();
});

// 주문영역 밖 어디에 놓아도 선택 취소
guestModal.addEventListener("dragover", (e) => {
  if (draggingFromOrder !== null) e.preventDefault();
});
guestModal.addEventListener("drop", (e) => {
  if (draggingFromOrder === null || orderZone.contains(e.target)) return;
  e.preventDefault();
  order.delete(draggingFromOrder);
  draggingFromOrder = null;
  renderOrder();
});

// 수량 변경 → 금액/결제금액 즉시 반영
orderList.addEventListener("input", (e) => {
  const input = e.target.closest("[data-qty]");
  if (!input) return;
  const idx = +input.dataset.qty;
  const qty = Math.min(99, Math.max(1, parseInt(input.value, 10) || 1));
  order.set(idx, qty);
  const it = itemOf(idx);
  input.closest(".g-line").querySelector(".g-amount").textContent = won(it.price * qty) + "원";
  const total = [...order].reduce((sum, [i, q]) => sum + itemOf(i).price * q, 0);
  $("#guestTotal").textContent = won(total);
});
orderList.addEventListener("change", (e) => {
  if (e.target.matches("[data-qty]")) e.target.value = order.get(+e.target.dataset.qty);
});
orderList.addEventListener("click", (e) => {
  const btn = e.target.closest("[data-remove]");
  if (!btn) return;
  order.delete(+btn.dataset.remove);
  renderOrder();
});

// 모달 열기
$("#guestOpen").addEventListener("click", () => {
  $("#guestId").textContent = randomId();
  order.clear();
  renderDisplay();
  renderOrder();
  guestModal.showModal();
});

// 주문하기 → 모달 닫고 3초간 결제 메시지
let paidTimer = null;
$("#guestSubmit").addEventListener("click", () => {
  if (order.size === 0) {
    toast("주문할 상품을 주문 목록으로 끌어다 놓아주세요.");
    return;
  }
  const id = $("#guestId").textContent;
  const total = $("#guestTotal").textContent;
  guestModal.close();
  order.clear();

  const banner = $(".paid-banner");
  banner.textContent = `방금 비회원 ${id}님이 ${total}원을 결제하셨습니다!`;
  banner.hidden = false;
  clearTimeout(paidTimer);
  paidTimer = setTimeout(() => (banner.hidden = true), 3000);
});
