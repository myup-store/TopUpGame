const labelNominal = document.querySelectorAll(".nominal");
const priceSection = document.querySelectorAll(".form-input__price-section");
const priceDiv = document.querySelectorAll(".form-input__price");

labelNominal.forEach((el) => {
  el.addEventListener("click", function () {
    let price = this.getAttribute("data-price");

    priceSection.forEach((ps) => {
      ps.style.display = "block";
    });

    priceDiv.forEach((pd) => {
      pd.innerHTML = price;
    });
  });
});

const form = document.querySelector("form");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  const userId = form.elements.user_id.value;
  const userName = form.elements.user_name.value;
  const inputNominal = form.elements.item_qty.value;
  const paymentMethod = form.elements.payment_method.value;

  console.log("first");

  let url = `https://api.whatsapp.com/send?phone=6281959986108&text=*Halo%20Admin,%20Saya%20Mau%20TopUp%20Games*.%0A%0ADetail%20Pesanan%20%3A%0A%0AUser%20ID%20%3A%20${userId}%0ANickname%20%3A%20${userName}%0AJumlah%20Pembelian%20%3A%20${inputNominal}%0APembayaran%20%3A%20${paymentMethod}%0A*Silahkan Transfer Sesuai Harga Pada Nomor Atau Rekening Diatas.*%0A%0AOrder Via Website`;
  window.open(url);
});
