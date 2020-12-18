document.addEventListener("DOMContentLoaded", function () {
  const reciptBtn = document.getElementById("recipt-btn");

  const taxRate = document.getElementById("tax-rate");
  const recipt = document.getElementById("recipt-amount");

  const reciptAmountCells = document.querySelectorAll(".recipt-amount-cell");
  const implementTaxCells = document.querySelectorAll(".implement-tax-cell");

  let taxRateBefore = taxRate.value;

  const caluculateTaxRate = () => {
    let imTax = 0;

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

    return Math.round(imTax);
  };

  const changeTaxRate = () => {
    if (taxRateBefore !== taxRate.value) {
      for (const i of reciptAmountCells.keys()) {
        if (reciptAmountCells[i].textContent !== "") {
          switch (taxRate.value) {
            case "0":
              imTax =
              (reciptAmountCells[i].textContent / (100 + 10)) * 10;
              taxRateBefore = "0";
              break;
              case "1":
                imTax =
                (reciptAmountCells[i].textContent / (100 + 8)) * 8;
                taxRateBefore = "1";
                break;
              }
              implementTaxCells[i].textContent = Math.round(imTax);
            }
          }
        }
  };

  const displayRecipt = () => {
    let imTax = caluculateTaxRate();

    for (const i of reciptAmountCells.keys()) {
      for (const q of implementTaxCells.keys()) {
        if (implementTaxCells[q].textContent === "") {
          reciptAmountCells[q].textContent = recipt.value.toLocaleString();
          implementTaxCells[q].textContent = imTax.toLocaleString();
          break;
        }
      }
      break;
    }
  };

  reciptBtn.addEventListener("click", function (e) {
    e.preventDefault();
    displayRecipt();
  });

  taxRate.addEventListener("change", function() {
    changeTaxRate();
  });
});
