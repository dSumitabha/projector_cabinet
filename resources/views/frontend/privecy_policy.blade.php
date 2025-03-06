@extends('frontend.layouts.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')

<!-- Privacy Policy Page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Privacy Policy</h2>
                    <h2 class="ec-title">Our Privacy Policy</h2>
                    <p class="sub-title mb-3">Learn how we handle your personal information</p>
                </div>
            </div>
            <div class="ec-common-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ec-cms-block-inner">
                            <div class="policy-wrapper p-4">
                                <div class="policy-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-user-secret"></i> 1. Introduction</h3>
                                    <p>We are committed to protecting your privacy. This Privacy Policy explains how we collect, use, and safeguard your information when you visit our website.</p>
                                </div>

                                <div class="policy-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-database"></i> 2. Information We Collect</h3>
                                    <p>We may collect personal information such as your name, email address, phone number, and payment details when you register, place an order, or subscribe to our newsletter.</p>
                                </div>

                                <div class="policy-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-user-lock"></i> 3. How We Use Your Information</h3>
                                    <p>We use your information to process transactions, provide customer support, send promotional emails, and improve our services.</p>
                                </div>

                                <div class="policy-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-shield-alt"></i> 4. How We Protect Your Data</h3>
                                    <p>We implement security measures to protect your personal data from unauthorized access, alteration, disclosure, or destruction.</p>
                                </div>

                                <div class="policy-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-cookie-bite"></i> 5. Cookies & Tracking Technologies</h3>
                                    <p>We use cookies to enhance your browsing experience, analyze site traffic, and personalize content. You can manage your cookie preferences through your browser settings.</p>
                                </div>

                                <div class="policy-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-external-link-alt"></i> 6. Third-Party Services</h3>
                                    <p>We may use third-party services for payment processing, analytics, and marketing. These services have their own privacy policies governing how they handle your data.</p>
                                </div>

                                <div class="policy-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-archive"></i> 7. Data Retention</h3>
                                    <p>We retain your personal data only as long as necessary to fulfill our legal obligations, resolve disputes, and enforce our policies.</p>
                                </div>

                                <div class="policy-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-user-check"></i> 8. Your Rights</h3>
                                    <p>You have the right to access, update, or delete your personal information. Contact us if you wish to exercise these rights.</p>
                                </div>

                                <div class="policy-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-sync"></i> 9. Changes to This Policy</h3>
                                    <p>We reserve the right to update this Privacy Policy. Any changes will be posted on this page with an updated revision date.</p>
                                </div>

                                <div class="policy-box contact-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-envelope"></i> 10. Contact Us</h3>
                                    <p>If you have any questions about this Privacy Policy, please contact us at <a href="mailto:support@ustprojectorcabinets.com" class="contact-link">support@ustprojectorcabinets.com</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Light and Elegant Styling */
    .policy-wrapper {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 30px;
        color: #333;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
    }

    .policy-box {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 5px solid #007bff;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
    }

    .ec-cms-block-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        color: #007bff;
    }

    .ec-cms-block-title i {
        margin-right: 10px;
        color: #ff9800;
    }

    .contact-box {
        text-align: center;
        background: #e3f2fd;
        border-left: 5px solid #0288d1;
    }

    .contact-link {
        color: #007bff;
        font-weight: bold;
        text-decoration: none;
    }

    .contact-link:hover {
        text-decoration: underline;
    }
</style>

@endsection
