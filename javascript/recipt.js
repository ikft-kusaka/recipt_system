document.addEventListener("DOMContentLoaded", function () {
  const reciptBtn = document.getElementById("recipt-btn");

  const taxRate = document.getElementById("tax-rate");
  const recipt = document.getElementById("recipt-amount");

  const reciptAmountCells = document.querySelectorAll(".recipt-amount-cell");
  const implementTaxCells = document.querySelectorAll(".implement-tax-cell");

  // 税区分を取得する
  let taxRateBefore = taxRate.value;

  // 消費税計算
  const caluculateTaxRate = () => {
    let imTax = 0;

    // 領収金額 / (領収金額 + 税率) * 税率
    switch (taxRate.value) {
      case "0":
        imTax = (recipt.value / (100 + 10)) * 10;
        break;
      case "1":
        imTax = (recipt.value / (100 + 8)) * 8;
        break;
      case "2":
        imTax = (recipt.value / (100 + 5)) * 5;
        break;
    }

    // 四捨五入して返す
    return Math.round(imTax);
  };

  // 税区分変更時に記入済みの領収金額を再計算
  const changeTaxRate = () => {
    
    if (taxRateBefore !== taxRate.value) {
      for (const i of reciptAmountCells.keys()) {
        if (reciptAmountCells[i].textContent !== "") {
          switch (taxRate.value) {
            case "0":
              imTax = (reciptAmountCells[i].textContent / (100 + 10)) * 10;
              taxRateBefore = "0";
              break;
            case "1":
              imTax = (reciptAmountCells[i].textContent / (100 + 8)) * 8;
              taxRateBefore = "1";
              break;
          }
          implementTaxCells[i].textContent = Math.round(imTax);
        }
      }
    }
  };

  // ボタン押下時に入力した領収金額を表に追加する
  const displayRecipt = () => {
    let imTax = caluculateTaxRate();

    for (const i of reciptAmountCells.keys()) {
      if (implementTaxCells[i].textContent === "") {
        reciptAmountCells[i].textContent = recipt.value.toLocaleString();
        implementTaxCells[i].textContent = imTax.toLocaleString();
      }
      break;
    }
  };

  reciptBtn.addEventListener("click", function (e) {
    e.preventDefault();
    displayRecipt();
  });

  taxRate.addEventListener("change", function () {
    changeTaxRate();
  });
});
