document.addEventListener("DOMContentLoaded", function() {
    const othersRadio = document.getElementById('payment_amount_others');
    const customAmountInput = document.getElementById('custom_amount');

    // Add event listener to the "Others" radio button
    othersRadio.addEventListener('change', function() {
        // If "Others" radio is selected, enable the custom amount input
        if (this.checked) {
            customAmountInput.disabled = false;
            customAmountInput.focus(); // Optional: Automatically focus on the custom amount input
        } else {
            // If another option is selected, disable the custom amount input
            customAmountInput.disabled = true;
            customAmountInput.value = ''; // Clear the input value
        }
    });
});
