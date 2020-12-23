document.addEventListener("DOMContentLoaded", function () {
  const reciptBtn = document.getElementById("recipt-btn");
  const reciptAddBtn = document.getElementById("recipt-add-btn");

  const classification = document.getElementById("classification");
  const totalStampDuty = document.getElementById("total-stamp-duty");
  const stampDuties = document.querySelectorAll(".stamp-duty");

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
    reciptAmounts.forEach((reciptAmount) => {
      totalAmount += Number(reciptAmount.value);
    });
    return parseInt(totalAmount, 10);
  };

  // ボタン押下時に入力した領収金額を表に追加する
  const displayRecipt = () => {
    // 税区分に応じた消費税額を取得
    let comTax = caluculateTaxRate();

    for (const i of reciptAmounts.keys()) {
      if (comsumpitionTaxs[i].value === "") {
        reciptAmounts[i].value = recipt.value;
        comsumpitionTaxs[i].value = comTax;
        stampDuties[i].value = caluculateStampDuty(reciptAmounts[i].value);
        break;
      }
    }
  };

  // 領収金額に応じて印紙税額計算
  const caluculateStampDuty = (reciptAmount) => {
    let stampDuty = 0;
    if (reciptAmount < 50000) {
      stampDuty = 0;
    } else if (reciptAmount <= 1000000) {
      stampDuty = 200;
    } else if (reciptAmount <= 2000000) {
      stampDuty = 400;
    } else if (reciptAmount <= 3000000) {
      stampDuty = 600;
    } else if (reciptAmount <= 5000000) {
      stampDuty = 1000;
    } else if (reciptAmount <= 10000000) {
      stampDuty = 2000;
    } else if (reciptAmount <= 20000000) {
      stampDuty = 40000;
    } else if (reciptAmount <= 30000000) {
      stampDuty = 6000;
    } else if (reciptAmount <= 50000000) {
      stampDuty = 10000;
    } else if (reciptAmount <= 100000000) {
      stampDuty = 20000;
    } else if (reciptAmount <= 200000000) {
      stampDuty = 40000;
    } else if (reciptAmount <= 300000000) {
      stampDuty = 60000;
    } else if (reciptAmount <= 500000000) {
      stampDuty = 100000;
    } else if (reciptAmount <= 1000000000) {
      stampDuty = 150000;
    } else if (reciptAmount > 1000000000) {
      stampDuty = 200000;
    }
    return stampDuty;
  };

  const classificationBranch = (classification, reciptAmount) => {
    switch (classification.value) {
      case "0" :
        break;
      case "1" :
        break;
      case "2" :
        for (const i of stampDuties.keys()) {
          stampDuties[i].value = caluculateStampDuty(reciptAmount);
        }
        break;
    }
  }
  reciptBtn.addEventListener("click", function (e) {
    e.preventDefault();
    displayRecipt();
  });

  taxRate.addEventListener("change", function () {
    changeTaxRate();
  });

  reciptAddBtn.addEventListener("click", function () {
    totalReciptAmount.value = caluculateTotalReciptAmount();
  });
});
