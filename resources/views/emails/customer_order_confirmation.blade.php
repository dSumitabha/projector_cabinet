<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            font-size: 18px;
            color: #333333;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Order Confirmation</div>
        <div class="content" style="max-width: 600px; margin: auto; font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9;">
            <h2 style="color: #28a745; text-align: center;">Your Order Has Been Placed Successfully!</h2>
            <p style="text-align: center; font-size: 18px; color: #555;">
                <strong>Transaction ID:</strong> {{ $transaction_id }} <br>
                <strong>Amount Paid:</strong> ${{ number_format($amount, 2) }}
            </p>

            @if ($products)
            <h3 style="color: #333; border-bottom: 2px solid #28a745; padding-bottom: 5px;">Order Product Details</h3>
            <ul style="list-style-type: none; padding: 0;">
                @foreach ($products as $product)
                    <li style="padding: 15px; border-radius: 8px; background: #fff; margin-bottom: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        <p style="margin: 0; font-size: 16px; color: #444;">
                            <strong>Product ID:</strong> {{ $product['id'] }}
                        </p>
                        <p style="margin: 5px 0; font-size: 18px; font-weight: bold; color: #007bff;">
                            {{ $product['name'] }}
                        </p>
                        <p style="margin: 0; font-size: 14px; color: #666;">
                            <strong>Estimated Delivery:</strong> {{ $product['delivery_time_in_week'] }} {{ Str::plural('week', $product['delivery_time_in_week']) }}
                        </p>
                    </li>
                @endforeach
            </ul>
            @endif

            <p style="text-align: center; font-size: 16px; color: #555;">Thank you for shopping with us. We appreciate your trust in our service.</p>

            {{-- <div style="text-align: center;">
                <a href="{{ url('/') }}" style="display: inline-block; padding: 10px 20px; background: #007bff; color: #fff; text-decoration: none; font-size: 16px; border-radius: 5px; margin-top: 10px;">
                    Continue Shopping
                </a>
            </div> --}}
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>
</body>
</html>


