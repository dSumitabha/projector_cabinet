<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Submission</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            padding: 20px;
            background: #f1f1f1;
        }

        .container {
            background-color: #000000;
            width: 80%;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .inner_container {
            background-color: #ffffff;
            padding: 50px;
        }

        header,
        footer {
            text-align: center;
        }

        .email_inner_section {
            padding: 20px 0 50px 0;
        }

        hr {
            height: 5px;
            background-color: brown;
            border-color: brown;
        }

        h1 {
            color: brown;
        }

        .enquiry_submission table {
            text-align: left;
            margin-top: 50px;
        }

        .enquiry_submission table tbody tr th {
            width: 30%;
            vertical-align: top;
        }

        .enquiry_submission th,
        .enquiry_submission td {
            padding: 10px;
            margin: 0;
        }

        .enquiry_submission th {
            color: brown;
            font-weight: 900;
        }

        .enquiry_submission td {
            font-weight: 100;
        }

        .email_footer {
            font-size: 10px;
            color: #ffffff;
            padding: 20px 0;
        }

        .email_footer a {
            color: #ffffff;
            text-decoration: none;
        }

        @media only screen and (max-width: 500px) {

            .enquiry_submission th,
            .enquiry_submission td {
                display: block;
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="inner_container">
            <header>

                <h2>Enquiry Submission</h2>
            </header>
            <hr>
            <div class="email_content">
                <div class="email_inner_section">
                    <section>
                        <h3>Hi Admin, you have a new enquiry submission from {{ $quoteData['first_name'] }} {{ $quoteData['last_name'] }}.</h3>
                    </section>
                    <section class="enquiry_submission">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Client Name</th>
                                    <td>{{ $quoteData['first_name'] }} {{ $quoteData['last_name'] }}</td>
                                </tr>
                                <tr>
                                    <th>Client's Email Address</th>
                                    <td><a href="mailto:{{ $quoteData['email'] }}">{{ $quoteData['email'] }}</a></td>
                                </tr>
                                <tr>
                                    <th>Projector Make</th>
                                    <td>{{ $quoteData['projector_make'] }}</td>
                                </tr>
                                <tr>
                                    <th>Projector Model</th>
                                    <td>{{ $quoteData['projector_model'] }}</td>
                                </tr>
                                <tr>
                                    <th>Channel Brand</th>
                                    <td>{{ $quoteData['channel_brand'] }}</td>
                                </tr>
                                <tr>
                                    <th>Channel Model</th>
                                    <td>{{ $quoteData['channel_model'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ceiling Height</th>
                                    <td>{{ $quoteData['ceiling_height'] }}</td>
                                </tr>
                                <tr>
                                    <th>Screen Size</th>
                                    <td>{{ $quoteData['screen_size'] }}</td>
                                </tr>
                                <tr>
                                    <th>Screen Type</th>
                                    <td>{{ $quoteData['screen_type'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <section class="email_footer">
           
                <p>
                    <a href="https://starpactprojects.com/ProjectorCabinet/">Home</a>
                </p>
                <p>KAVITHA LLC 652 Foster Lane Mount Juliet TN 37122</p>
                <p>Copyright &copy; <script>
                        document.write(new Date().getFullYear())
                    </script> ustprojectorcabinets All Rights Reserved</p>
            </section>
        </footer>
    </div>
</body>

</html>
