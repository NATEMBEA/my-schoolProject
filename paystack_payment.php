<?php
session_start();

if (!isset($_SESSION['registration_data'])) {
    header('Location: home.php');
    exit();
}

$email = 'manfredoku@gmail.com'; // Replace with the user's email
$amount = 5000; // Amount in kobo (e.g., 5000 = ₦50.00)
$public_key = 'pk_test_d261f05f584c1db2e2d2643ddaeabbbffff7d090'; // Replace with your Paystack public key
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay with Paystack</title>
    <script src="https://js.paystack.co/v1/inline.js"></script>

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1.5rem;
        }

        #payButton {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #payButton:hover {
            background-color: #0056b3;
        }

        #payButton:active {
            background-color: #004080;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                padding: 1rem;
            }

            h1 {
                font-size: 1.25rem;
            }

            #payButton {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pay Registration Fee</h1>
        <button id="payButton">Pay Now</button>
    </div>

    <script>
        const payButton = document.getElementById('payButton');
        payButton.addEventListener('click', payWithPaystack);

        function payWithPaystack() {
            const handler = PaystackPop.setup({
                key: 'pk_test_d261f05f584c1db2e2d2643ddaeabbbffff7d090', // Replace with your public key
                email: '<?= $email ?>',
                amount: <?= $amount ?>,
                currency: 'KES', // Use USD for dollars
                ref: 'REG_' + Math.floor((Math.random() * 1000000000) + 1), // Generate a unique reference
                callback: function(response) {
                    // Redirect to verify payment after successful payment
                    window.location.href = `verify_payment.php?reference=${response.reference}`;
                },
                onClose: function() {
                    alert('Payment canceled.');
                }
            });
            handler.openIframe();
        }
    </script>
</body>
</html>