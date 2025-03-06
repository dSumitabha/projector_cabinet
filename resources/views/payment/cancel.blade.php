<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            padding: 50px;
            margin: 0;
        }
        .container {
            max-width: 450px;
            margin: auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #ff9800;
        }
        h2 {
            color: #ff9800;
            font-size: 26px;
            margin-bottom: 15px;
        }
        p {
            color: #555;
            font-size: 18px;
            line-height: 1.5;
        }
        .icon {
            font-size: 50px;
            color: #ff9800;
            margin-bottom: 15px;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
            background: #ff9800;
            border-radius: 5px;
            transition: background 0.3s;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .btn:hover {
            background: #e68900;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">⏳</div>
        <h2>Payment Cancelled</h2>
        <p>Your payment has been cancelled. No charges were made to your account.</p>
        <a href="{{ route('all_products') }}" class="btn">Return to Home</a>
    </div>
</body>
</html>
