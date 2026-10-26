// 상품 추가/수정 폼: 사진 미리보기, 인기상품 할인방법, 누락 항목 알림
const form = $(".item-form");
const famous = $("#famous");
const saleOptions = $("#saleOptions");
const populars = JSON.parse(form.dataset.populars);
const selfIdx = +form.dataset.self;

// 사진 선택 시 미리보기
$("#file").addEventListener("change", (e) => {
  const file = e.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = () => ($("#preview").src = reader.result);
  reader.readAsDataURL(file);
});

// 같은 카테고리에 이미 인기상품이 있으면 안내
function updateHint() {
  const cur = populars[$("#cate").value];
  const other = cur && cur.idx !== selfIdx;
  $("#famousHint").textContent =
    famous.checked && other ? `저장하면 기존 인기상품 ‘${cur.title}’의 지정이 해제됩니다.` : "";
}

famous.addEventListener("change", () => {
  saleOptions.hidden = !famous.checked;
  updateHint();
});
$("#cate").addEventListener("change", updateHint);
updateHint();

// 제출 전 누락 확인
form.addEventListener("submit", (e) => {
  const missing = [];
  if (form.dataset.edit !== "1" && !$("#file").files.length) missing.push("상품사진");
  if (!$("#title").value.trim()) missing.push("상품명");
  if (!$("#des").value.trim()) missing.push("상품설명");
  if (!(+$("#price").value > 0)) missing.push("가격");
  if (famous.checked && !$('input[name="sale"]:checked')) missing.push("할인방법");

  if (missing.length) {
    e.preventDefault();
    alert(missing.join(", ") + "을(를) 입력해주세요.");
  }
});
