<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Submission</title>
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

            <h2>New User Registration</h2>
            </header>
            <hr>
            <div class="email_content">
                <div class="email_inner_section">
                    <section>
                        <h3>Hi Admin, a new user has registered.</h3>
                    </section>
                    <section class="registration_details">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $userData['name'] }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><a href="mailto:{{ $userData['email'] }}">{{ $userData['email'] }}</a></td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $userData['phone_number'] }}</td>
                                </tr>
                                <tr>
                                    <th>User Type</th>
                                    <td>{{ $userData['user_type'] == '0' ? 'User' : 'Admin' }}</td>
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
                <p>KAVITHA LLC 652 Foster Lane Mount Juliet TN 37122.</p>
                <p>Copyright &copy; <script>
                        document.write(new Date().getFullYear())
                    </script> ustprojectorcabinets All Rights Reserved</p>
            </section>
        </footer>
    </div>
</body>

</html>
