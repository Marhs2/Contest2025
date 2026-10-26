// 장바구니: 수량 조절 시 구매금액/전체 결제금액 갱신 후 DB에 저장
const list = $(".cart-list");

function post(data) {
  const body = new FormData();
  Object.entries(data).forEach(([k, v]) => body.append(k, v));
  return fetch("./cartAction.php", { method: "POST", body }).then((r) => r.json());
}

function recalc() {
  let total = 0;
  let qty = 0;
  $$(".cart-row[data-id]").forEach((row) => {
    const n = parseInt($("input", row).value, 10) || 1;
    const amount = +row.dataset.price * n;
    $(".cart-amount b", row).textContent = won(amount);
    total += amount;
    qty += n;
  });
  $("#cartTotal").textContent = won(total);
  $("#cartQty").textContent = qty + "개";
  setCartCount(qty);
}

// 같은 상품 수량을 빠르게 바꿔도 마지막 값만 저장
const saveTimers = {};
function saveCount(row) {
  const id = row.dataset.id;
  clearTimeout(saveTimers[id]);
  saveTimers[id] = setTimeout(() => post({ type: "count", idx: id, count: $("input", row).value }), 300);
}

function clampInput(input) {
  input.value = Math.min(99, Math.max(1, parseInt(input.value, 10) || 1));
}

if (list) {
  list.addEventListener("click", (e) => {
    const row = e.target.closest(".cart-row[data-id]");
    if (!row) return;

    const step = e.target.closest("[data-step]");
    if (step) {
      const input = $("input", row);
      input.value = (parseInt(input.value, 10) || 1) + +step.dataset.step;
      clampInput(input);
      recalc();
      saveCount(row);
    }

    if (e.target.closest("[data-remove]")) {
      post({ type: "remove", idx: row.dataset.id }).then(() => {
        row.remove();
        if (!$(".cart-row[data-id]")) location.reload();
        else recalc();
      });
    }
  });

  list.addEventListener("input", (e) => {
    if (!e.target.matches("input")) return;
    recalc();
  });
  list.addEventListener("change", (e) => {
    if (!e.target.matches("input")) return;
    clampInput(e.target);
    recalc();
    saveCount(e.target.closest(".cart-row"));
  });

  $("#checkout").addEventListener("click", () => {
    const total = $("#cartTotal").textContent;
    if (!confirm(`총 ${total}원을 결제할까요?`)) return;
    post({ type: "clear" }).then(() => {
      alert(`${total}원 결제가 완료되었습니다. 감사합니다!`);
      location.reload();
    });
  });
}
