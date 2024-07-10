document.addEventListener("DOMContentLoaded", function () {
    const calculateButton = document.getElementById("calculate-button");
    calculateButton.addEventListener("click", calculateMonthlyPayment);
    const sliders = document.querySelectorAll("input[type='range']");
    sliders.forEach(function (slider) {
        const output = document.getElementById(slider.id + "-value");
        output.textContent = formatSliderValue(slider.value);
        slider.addEventListener("input", function () {
            output.textContent = formatSliderValue(slider.value);
        });
    });
});

function formatSliderValue(value) {
    if (value.includes('.')) {
        return `${parseFloat(value).toFixed(1)}% €`;
    } else {
        return `${parseInt(value).toLocaleString()} €`;
    }
}

function calculateMonthlyPayment() {
    const carPrice = parseFloat(document.getElementById("car-price").value);
    const downPayment = parseFloat(document.getElementById("down-payment").value);
    const leaseTerm = parseInt(document.getElementById("lease-term").value);
    const interestRate = parseFloat(document.getElementById("interest-rate").value) / 100;

    if (isNaN(carPrice) || isNaN(downPayment) || isNaN(leaseTerm) || isNaN(interestRate)) {
        alert("Ievadiet datus pareizi.");
        return;
    }

    const monthlyInterestRate = interestRate / 12;
    const loanAmount = carPrice - downPayment;
    const monthlyPayment = (loanAmount * monthlyInterestRate) / (1 - Math.pow(1 + monthlyInterestRate, -leaseTerm));

    const monthlyPaymentElement = document.getElementById("monthly-payment");
    monthlyPaymentElement.textContent = `Mēneša maksājums ${monthlyPayment.toFixed(2)} €`;
}
