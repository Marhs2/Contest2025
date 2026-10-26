// 메인 페이지: 비주얼 슬라이드, 카테고리 탭, 공지사항

/* ---------- 비주얼 슬라이드 ---------- */
// 3초마다 오른쪽→왼쪽으로 이동, 마우스를 올리면 즉시 멈추고 벗어나면 이어서 진행
const hero = $(".hero");
const track = $(".hero-track");
const REAL = 3; // 실제 슬라이드 수 (마지막 하나는 1번 복제본)
let cur = 0;
let timer = null;
let moving = false;

function goTo(n, animate = true) {
  track.style.transition = animate ? "" : "none";
  cur = n;
  track.style.transform = `translateX(${-100 * cur}%)`;
  if (!animate) track.offsetHeight; // 위치를 즉시 반영
}

function next() {
  if (moving) return;
  moving = true;
  goTo(cur + 1);
}

function prev() {
  if (moving) return;
  moving = true;
  // 1번에서 이전으로 가면 복제본(맨 끝)으로 순간 이동 후 3번으로 이동
  if (cur === 0) goTo(REAL, false);
  goTo(cur - 1);
}

// 복제본(1번)에 도착하면 진짜 1번 위치로 조용히 되돌려 무한 반복
track.addEventListener("transitionend", (e) => {
  if (e.target !== track) return; // 버튼 등 자식 요소의 전환 이벤트는 무시
  moving = false;
  if (cur === REAL) goTo(0, false);
});

function play() {
  stop();
  timer = setInterval(next, 3000);
}
function stop() {
  clearInterval(timer);
}

hero.addEventListener("mouseenter", stop);
hero.addEventListener("mouseleave", play);
$$(".hero-arrow.next").forEach((b) => b.addEventListener("click", next));
$$(".hero-arrow.prev").forEach((b) => b.addEventListener("click", prev));

// 로딩 애니메이션이 끝난 뒤 슬라이드 시작
setTimeout(play, 3500);

/* ---------- 판매상품 카테고리 탭 ---------- */
$$(".chip[data-tab]").forEach((chip) => {
  chip.addEventListener("click", () => {
    $$(".chip[data-tab]").forEach((c) => {
      c.classList.toggle("active", c === chip);
      c.setAttribute("aria-selected", c === chip);
    });
    $$(".tab-panel").forEach((p) => (p.hidden = p.dataset.panel !== chip.dataset.tab));
  });
});

/* ---------- 공지사항 ---------- */
// 6개씩 한 페이지, 유형을 바꿔도 정렬 상태는 유지
const PER_PAGE = 6;
const notice = { type: "all", order: "desc", page: 1, rows: [] };

const escapeHtml = (s) =>
  String(s).replace(/[&<>"']/g, (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" })[c]);

async function loadNotice() {
  const res = await fetch(`./getNotice.php?type=${encodeURIComponent(notice.type)}&order=${notice.order}`);
  notice.rows = await res.json();
  notice.page = 1;
  renderNotice();
}

function renderNotice() {
  const pages = Math.max(1, Math.ceil(notice.rows.length / PER_PAGE));
  notice.page = Math.min(Math.max(1, notice.page), pages);
  const rows = notice.rows.slice((notice.page - 1) * PER_PAGE, notice.page * PER_PAGE);

  $("#noticeBody").innerHTML = rows.length
    ? rows
        .map(
          (r) => `
      <div class="notice-row" role="row">
        <span role="cell"><em class="tag ${r.type === "이벤트" ? "tag-event" : ""}">${escapeHtml(r.type)}</em></span>
        <a href="#" role="cell" class="notice-title">${escapeHtml(r.title)}</a>
        <span role="cell" class="notice-date">${escapeHtml(r.date.replaceAll("-", "."))}</span>
      </div>`
        )
        .join("")
    : `<p class="empty">등록된 공지사항이 없습니다.</p>`;

  $("#noticePage").textContent = notice.page;
  $("#noticePages").textContent = pages;
  $("#noticePrev").disabled = notice.page <= 1;
  $("#noticeNext").disabled = notice.page >= pages;
}

$("#noticePrev").addEventListener("click", () => {
  notice.page--;
  renderNotice();
});
$("#noticeNext").addEventListener("click", () => {
  notice.page++;
  renderNotice();
});

$$("[data-type]").forEach((b) =>
  b.addEventListener("click", () => {
    $$("[data-type]").forEach((x) => x.classList.toggle("active", x === b));
    notice.type = b.dataset.type;
    loadNotice();
  })
);
$$("[data-order]").forEach((b) =>
  b.addEventListener("click", () => {
    $$("[data-order]").forEach((x) => x.classList.toggle("active", x === b));
    notice.order = b.dataset.order;
    loadNotice();
  })
);

loadNotice();
