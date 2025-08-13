function priceChange() {
  cartItems = $$(".product-container .item");
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

    e.querySelector(".count span").textContent = cost.toLocaleString("en-us");

    total += cost;
  });

  $(".checkoutPrice span").textContent = total.toLocaleString("en-us");
}
