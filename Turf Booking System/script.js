document.getElementById('paymentForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var paymentMethod = document.getElementById('paymentMethod').value;

    if (paymentMethod === 'card') {
        // Simulate card payment
        setTimeout(function() {
            displayPaymentStatus(true); // Simulated successful payment
        }, 2000); // 2 seconds delay
    } else if (paymentMethod === 'upi') {
        // Simulate UPI payment
        var upiId = document.getElementById('upiId').value;
        if (upiId) {
            setTimeout(function() {
                displayPaymentStatus(true); // Simulated successful payment
            }, 2000); // 2 seconds delay
        } else {
            alert('Please enter UPI ID.');
        }
    }
});

function displayPaymentStatus(success) {
    var paymentStatus = document.getElementById('paymentStatus');
    paymentStatus.innerHTML = success ? '<p>Payment successful!</p>' : '<p>Payment failed. Please try again.</p>';
}
