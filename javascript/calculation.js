const caluculateTaxRate = () => {
    const classification = document.querySelector('classification');
    const reciptAmount = document.querySelector('recipt-amount');
    let comsumpitionTax = 0;

    switch (classification) {
        case 0:
            comsumpitionTax = reciptAmount * 0.1;
            break;
        case 1:
            comsumpitionTax = reciptAmount * 0.08;
        case 2:
            comsumpitionTax = reciptAmount * 0.05;
        default:
        break;
    }

    return comsumpitionTax;
}

export default caluculateTaxRate;