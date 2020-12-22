document.addEventListener("DOMContentLoaded", function () {
  const reciptBtn = document.getElementById("recipt-btn");
  const reciptAddBtn = document.getElementById("recipt-add-btn");

  const taxRate = document.getElementById("tax-rate");
  const recipt = document.getElementById("recipt-amount");

  const reciptAmounts = document.querySelectorAll(".recipt-amount");
  const comsumpitionTaxs = document.querySelectorAll(".comsumpition-tax");
  const totalReciptAmount = document.getElementById("total-recipt-amount");
 

  // 税区分を取得する
  let taxRateBefore = taxRate.value;

  // 消費税計算
  const caluculateTaxRate = () => {
    let comTax = 0;

    // 領収金額 / (領収金額 + 税率) * 税率
    switch (taxRate.value) {
      case "0":
        comTax = (recipt.value / (100 + 10)) * 10;
        break;
      case "1":
        comTax = (recipt.value / (100 + 8)) * 8;
        break;
      case "2":
        comTax = (recipt.value / (100 + 5)) * 5;
        break;
    }

    // 四捨五入して返す
    return Math.round(comTax);
  };

  // 税区分変更時に記入済みの領収金額を再計算
  const changeTaxRate = () => {
    if (taxRateBefore !== taxRate.value) {
      for (const i of reciptAmounts.keys()) {
        if (reciptAmounts[i].value !== "") {
          switch (taxRate.value) {
            case "0":
              comTax = (reciptAmounts[i].value / (100 + 10)) * 10;
              taxRateBefore = "0";
              break;
            case "1":
              comTax = (reciptAmounts[i].value / (100 + 8)) * 8;
              taxRateBefore = "1";
              break;
          }
          comsumpitionTaxs[i].value = Math.round(comTax);
        }
      }
    }
  };

  //総領収金額を計算する
  const caluculateTotalReciptAmount = () => {
    let totalAmount = 0;
    reciptAmounts.forEach(reciptAmount => {
      totalAmount += Number(reciptAmount.value);
    });
    return parseInt(totalAmount, 10);
  }

  // ボタン押下時に入力した領収金額を表に追加する
  const displayRecipt = () => {
    // 税区分に応じた消費税額を取得
    let comTax = caluculateTaxRate();

    for (const i of reciptAmounts.keys()) {
      if (comsumpitionTaxs[i].value === "") {
        reciptAmounts[i].value = recipt.value.toLocaleString();
        comsumpitionTaxs[i].value = comTax.toLocaleString();
        break;
      }
    }
  };

  reciptBtn.addEventListener("click", function (e) {
    e.preventDefault();
    displayRecipt();
  });

  taxRate.addEventListener("change", function () {
    changeTaxRate();
  });

  reciptAddBtn.addEventListener("click", function() {
    totalReciptAmount.value = caluculateTotalReciptAmount();
  });
});
