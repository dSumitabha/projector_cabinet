<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .header {
            background: #28a745;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .details {
            padding: 20px;
        }

        .footer {
            background: #f4f4f4;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            New Order Received - Payment Successful
        </div>

        <div class="details">
            <p>Dear Praveen Matsa,</p>
            <p>A new order has been successfully placed with the following details:</p>

            <p><strong>Transaction ID:</strong> {{ $transaction_id }}</p>
            <p><strong>Amount Paid:</strong> ${{ $amount }}</p>
            @if ($products)
                <h3>Order Product Details:</h3>
                <ul>

                    @foreach ($products as $product)
                        <li>
                            <strong>Product ID:</strong> {{ $product['id'] }} <br>
                            <strong>Product Frontend Name:</strong> {{ $product['name'] }} <br>
                            <strong>Estimated Delivery Time:</strong> Approximately {{ $product['delivery_time_in_week'] }} {{ Str::plural('week', $product['delivery_time_in_week']) }}
                        </li>
                        <hr>
                    @endforeach

                </ul>
            @endif
            <h3> Shipping Address:</h3>
            <ul>
                <li>
                    <strong>Name:</strong> {{ $to_address['name'] }} <br>
                    <strong>Street:</strong> {{ $to_address['street1'] }} <br>
                    @if (isset($to_address['street2']))
                        <strong>Street 2:</strong> {{ $to_address['street2'] }} <br>
                    @endif
                    <strong>City:</strong> {{ $to_address['city'] }} <br>
                    <strong>State:</strong> {{ $to_address['state'] }} <br>
                    <strong>ZIP Code:</strong> {{ $to_address['zip'] }} <br>
                    <strong>Country:</strong> {{ $to_address['country'] }}
                </li>
                <hr>
            </ul>
            <h3>Shipping Details:</h3>
            <ul>
                @foreach ($tracking_details as $track)
                    <li>
                        <strong>Carrier:</strong> {{ $track['carrier'] }} <br>
                        <strong>Service:</strong> {{ $track['service'] }} <br>
                        <strong>Tracking Number:</strong> {{ $track['tracking_number'] }} <br>
                        <strong>Tracking URL:</strong> <a href="{{ $track['tracking_url'] }}" target="_blank">Track
                            Shipment</a> <br>
                            @if(!empty($track['label_url']))
                            <strong>Shipping Label:</strong>
                            <a href="{{ $track['label_url'] }}" target="_blank">Download PDF</a>
                        @endif
                        <strong>Shipping Cost:</strong> ${{ $track['shipping_cost'] }} {{ $track['currency'] }} <br>
                        <strong>Estimated Delivery:</strong> {{ $track['estimated_delivery'] }}
                    </li>
                    <hr>
                @endforeach
            </ul>

            <p>Please log in to the admin panel for further details.</p>
        </div>

        <div class="footer">
            <p>Thank you,</p>
            <p><strong>Your Store Team</strong></p>
        </div>
    </div>

</body>

</html>
