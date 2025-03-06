<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .header { background: #007bff; color: #ffffff; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; text-align: center; }
        .button { background: #77bda8; color: #ffffff; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-size: 16px; display: inline-block; margin-top: 20px; }
        .footer { margin-top: 20px; text-align: center; font-size: 14px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Welcome to UST PROJECTOR CABINETS!</h2>
        </div>
        <div class="content">
            <p>Dear {{ $user->name }},</p>
            <p>We are excited to have you onboard! Thank you for registering with us.</p>
            <p>You can now explore our services and enjoy all the benefits we offer.</p>
            <a href="https://www.ustcabinets.com" class="button">Visit Our Website</a>
        </div>
        <div class="footer">
            <p>If you have any questions, feel free to reach out to our support team.</p>
            <p>&copy; {{ date('Y') }} Our Company UST PROJECTOR CABINETS. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

