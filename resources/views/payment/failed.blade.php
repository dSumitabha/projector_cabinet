<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 450px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .icon {
            font-size: 50px;
            color: #dc3545;
            margin-bottom: 15px;
        }
        h2 {
            color: #dc3545;
            margin-bottom: 10px;
            font-size: 24px;
        }
        p {
            color: #555;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            text-decoration: none;
            color: #fff;
            background-color: #dc3545;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background-color: #b02a37;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">❌</div>
        <h2>Payment Failed</h2>
        <p>We encountered an issue while processing your payment. Please try again or contact support for assistance.</p>
        <a href="/" class="btn">Return to Home</a>
    </div>
</body>
</html>
