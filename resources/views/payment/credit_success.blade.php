<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .success-container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .success-icon {
            font-size: 60px;
            color: #28a745;
        }
        .transaction-details {
            font-size: 18px;
            margin: 20px 0;
        }
        .email-info {
            background: #e9f6ec;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            color: #155724;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="success-container">
        <i class="fas fa-check-circle success-icon"></i>
        <h2 class="text-success mt-3">Payment Successful</h2>
        <p class="lead">Thank you for your purchase! Your payment has been processed successfully.</p>

        <div class="transaction-details">
            <p><strong>Transaction ID:</strong> <span id="transaction-id">{{ session('transaction_id') }}</span></p>
            <p><strong>Amount Paid:</strong> $<span id="amount-paid">{{ session('amount') }}</span></p>
        </div>

        <div class="email-info">
            <i class="fas fa-envelope"></i> Order details will be sent to <strong>{{ session('customer_email') }}</strong>
            {{-- <i class="fas fa-envelope"></i> Order details will be sent to <strong>nilanjana.starpactglobal@gmail.com</strong> --}}
        </div>

        <a href="{{ route('all_products') }}" class="btn btn-primary mt-3"><i class="fas fa-home"></i> Return to Home</a>
        {{-- <a href="/orders" class="btn btn-outline-success mt-3"><i class="fas fa-receipt"></i> View Orders</a> --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
