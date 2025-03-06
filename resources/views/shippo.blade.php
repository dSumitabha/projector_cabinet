<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<div class="container my-5">
    <h1 class="text-center">Shipping Price Calculator</h1>

    <form id="shippingForm" class="mt-4">
        <div class="row">
            <!-- From Address -->
            <div class="col-md-6">
                <h3>From Address</h3>
                <input type="text" id="from_name" class="form-control mb-2" placeholder="Name" value="John Sender" required />
                <input type="text" id="from_company" class="form-control mb-2" placeholder="Company" value="Sender Inc." />
                <input type="text" id="from_street1" class="form-control mb-2" placeholder="Street 1" value="123 Sender St" required />
                <input type="text" id="from_city" class="form-control mb-2" placeholder="City" value="San Francisco" required />
                <input type="text" id="from_state" class="form-control mb-2" placeholder="State" value="CA" required />
                <input type="text" id="from_zip" class="form-control mb-2" placeholder="ZIP" value="94107" required />
                <input type="text" id="from_country" class="form-control mb-2" placeholder="Country" value="US" required />
                <input type="text" id="from_phone" class="form-control mb-2" placeholder="Phone" value="555-555-5555" />
                <input type="email" id="from_email" class="form-control mb-2" placeholder="Email" value="sender@example.com" />
            </div>

            <!-- To Address -->
            <div class="col-md-6">
                <h3>To Address</h3>
                <input type="text" id="to_name" class="form-control mb-2" placeholder="Name" value="Jane Receiver" required />
                <input type="text" id="to_company" class="form-control mb-2" placeholder="Company" value="Receiver LLC" />
                <input type="text" id="to_street1" class="form-control mb-2" placeholder="Street 1" value="456 Receiver Ave" required />
                <input type="text" id="to_city" class="form-control mb-2" placeholder="City" value="New York" required />
                <input type="text" id="to_state" class="form-control mb-2" placeholder="State" value="NY" required />
                <input type="text" id="to_zip" class="form-control mb-2" placeholder="ZIP" value="10001" required />
                <input type="text" id="to_country" class="form-control mb-2" placeholder="Country" value="US" required />
                <input type="text" id="to_phone" class="form-control mb-2" placeholder="Phone" value="555-555-5555" />
                <input type="email" id="to_email" class="form-control mb-2" placeholder="Email" value="receiver@example.com" />
            </div>
        </div>

        <div class="mt-4">
            <h3>Parcel Details</h3>

            <div class="mb-2">
                <label for="parcel_length" class="form-label">Length (in)</label>
                <input type="number" id="parcel_length" class="form-control" placeholder="Length (in)" value="5" required />
            </div>

            <div class="mb-2">
                <label for="parcel_width" class="form-label">Width (in)</label>
                <input type="number" id="parcel_width" class="form-control" placeholder="Width (in)" value="5" required />
            </div>

            <div class="mb-2">
                <label for="parcel_height" class="form-label">Height (in)</label>
                <input type="number" id="parcel_height" class="form-control" placeholder="Height (in)" value="5" required />
            </div>

            <div class="mb-2">
                <label for="parcel_weight" class="form-label">Weight (lbs)</label>
                <input type="number" id="parcel_weight" class="form-control" placeholder="Weight (lbs)" value="2" required />
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Get Shipping Rates</button>
    </form>

    <div id="priceDetails" class="mt-5" style="display: none;">
        <h3>Price Details</h3>
        <div id="rateDetails"></div>
    </div>
</div>
<!-- Loader Element -->
<div id="loader" class="text-center" style="display: none;">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <p>Loading...</p>
</div>
<script>
    const shippingRatesUrl = "{{ route('shipping.rates') }}";
</script>
<script>
    document.getElementById('shippingForm').addEventListener('submit', function (event) {
        event.preventDefault();
  // Show the loader
  document.getElementById('loader').style.display = 'block';
    document.getElementById('priceDetails').style.display = 'none';  // Hide price details initially
        // Gather form data
        const fromAddress = {
            name: document.getElementById('from_name').value,
            company: document.getElementById('from_company').value,
            street1: document.getElementById('from_street1').value,
            city: document.getElementById('from_city').value,
            state: document.getElementById('from_state').value,
            zip: document.getElementById('from_zip').value,
            country: document.getElementById('from_country').value,
            phone: document.getElementById('from_phone').value,
            email: document.getElementById('from_email').value
        };

        const toAddress = {
            name: document.getElementById('to_name').value,
            company: document.getElementById('to_company').value,
            street1: document.getElementById('to_street1').value,
            city: document.getElementById('to_city').value,
            state: document.getElementById('to_state').value,
            zip: document.getElementById('to_zip').value,
            country: document.getElementById('to_country').value,
            phone: document.getElementById('to_phone').value,
            email: document.getElementById('to_email').value
        };

        const parcelDetails = {
            length: document.getElementById('parcel_length').value,
            width: document.getElementById('parcel_width').value,
            height: document.getElementById('parcel_height').value,
            weight: document.getElementById('parcel_weight').value
        };

        // Send request to the backend to fetch shipping rates
     axios.post(shippingRatesUrl, {
            from_address: fromAddress,
            to_address: toAddress,
            parcel_details: parcelDetails
        })
        .then(response => {
            // Display the rates from the backend
            const rateDetails = response.data;
            setTimeout(function() {
            let detailsHTML = '';
            rateDetails.forEach(rate => {
                detailsHTML += `
                    <div class="rate">
                        <strong>Service:</strong> ${rate.Service} <br>
                        <strong>Provider:</strong> ${rate.Provider} <br>
                        <strong>Amount:</strong> ${rate.Amount} <br>
                        <strong>Estimated Delivery Time:</strong> ${rate['Estimated Delivery Time']} <br>
                        <strong>Duration Terms:</strong> ${rate['Duration Terms']} <br>
                        <hr>
                    </div>
                `;
            });
            document.getElementById('loader').style.display = 'none';

            document.getElementById('rateDetails').innerHTML = detailsHTML;
            document.getElementById('priceDetails').style.display = 'block';
        }, 2000);
        })
        .catch(error => {
            console.error('Error fetching rates:', error);
        });
    });
</script>

</body>
</html>
