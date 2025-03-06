<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Notification</title>
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

        header, footer {
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

        .registration_details table {
            text-align: left;
            margin-top: 50px;
        }

        .registration_details th,
        .registration_details td {
            padding: 10px;
            margin: 0;
        }

        .registration_details th {
            color: brown;
            font-weight: 900;
            width: 30%;
            vertical-align: top;
        }

        .registration_details td {
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
            .registration_details th,
            .registration_details td {
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
                <h1>LOGO</h1>
                <h2>Account Notification</h2>
            </header>
            <hr>
            <div class="email_content">
                <div class="email_inner_section">
                    
                    <!-- OTP Section -->
                    <section>
                        <h2>Password Reset OTP</h2>
                        <p>We have received a request to reset your password. Use the following One Time Password (OTP) to reset your password:</p>
                        <h3 style="text-align:center; background-color: brown; color: white; padding: 10px;">{{ $otp }}</h3>
                        <p>This OTP is valid for 10 minutes only.</p>
                        <p>If you did not request a password reset, please ignore this email.</p>
                    </section>

                    <hr>

                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <section class="email_footer">
                <h1>LOGO</h1>
                <p>
                    <a href="https://starpactprojects.com/ProjectorCabinet/">Home</a>
                </p>
                <p>Address 1, 123 Road, MY</p>
                <p>Copyright &copy; <script> document.write(new Date().getFullYear()) </script> Your Name. All Rights Reserved</p>
            </section>
        </footer>
    </div>
</body>

</html>
