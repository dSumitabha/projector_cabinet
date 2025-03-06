@extends('frontend.layouts.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')

<!-- Terms & Conditions Page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Terms & Conditions</h2>
                    <h2 class="ec-title">Our Terms & Conditions</h2>
                    <p class="sub-title mb-3">Understand the rules of using our services</p>
                </div>
            </div>

            <div class="ec-common-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ec-cms-block-inner">
                            <div class="terms-wrapper p-4">
                                <div class="terms-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-globe"></i> 1. Introduction</h3>
                                    <p>Welcome to USTProjectorCabinets.com ("we," "us," or "our"). By accessing and using our website, you agree to be bound by these Terms and Conditions ("Terms"). If you do not agree to these Terms, please do not use our website.</p>
                                </div>

                                <div class="terms-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-user-shield"></i> 2. Use of the Website</h3>
                                    <p><strong>2.1</strong> You agree to use this website only for lawful purposes and in a manner that does not infringe upon or restrict the rights of others.</p>
                                    <p><strong>2.2</strong> You are prohibited from:</p>
                                    <ul>
                                        <li>Violating any applicable laws or regulations</li>
                                        <li>Transmitting any harmful or malicious code</li>
                                        <li>Attempting to gain unauthorized access to our systems</li>
                                        <li>Impersonating any person or entity</li>
                                    </ul>
                                </div>

                                <div class="terms-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-lock"></i> 3. Intellectual Property</h3>
                                    <p><strong>3.1</strong> All content on this website, including text, graphics, logos, and software, is our property or that of our licensors and is protected by copyright laws.</p>
                                    <p><strong>3.2</strong> You may not reproduce, distribute, or create derivative works from this content without our express written permission.</p>
                                </div>

                                <div class="terms-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-comment"></i> 4. User-Generated Content</h3>
                                    <p><strong>4.1</strong> By submitting content to our website, you grant us a non-exclusive, royalty-free license to use, reproduce, and distribute that content.</p>
                                    <p><strong>4.2</strong> You are solely responsible for any content you submit and agree not to post any content that is unlawful, defamatory, or infringing on third-party rights.</p>
                                </div>

                                <div class="terms-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-user-secret"></i> 5. Privacy</h3>
                                    <p>Your use of this website is also governed by our <a href="#">Privacy Policy</a>.</p>
                                </div>

                                <div class="terms-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-exclamation-triangle"></i> 6. Disclaimer of Warranties</h3>
                                    <p>This website is provided "as is" without any warranties, express or implied.</p>
                                </div>

                                <div class="terms-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-balance-scale"></i> 7. Limitation of Liability</h3>
                                    <p>We shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of the website.</p>
                                </div>

                                <div class="terms-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-handshake"></i> 8. Changes to Terms</h3>
                                    <p>We reserve the right to modify these Terms at any time. Your continued use of the website after any changes constitutes acceptance of those changes.</p>
                                </div>

                                <div class="terms-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-gavel"></i> 9. Governing Law</h3>
                                    <p>These Terms shall be governed by and construed in accordance with the laws of Mount Juliet, Tennessee, USA.</p>
                                </div>

                                <div class="terms-box contact-box">
                                    <h3 class="ec-cms-block-title"><i class="fas fa-envelope"></i> 10. Contact Information</h3>
                                    <p>If you have any questions about these Terms, please contact us at <a href="mailto:support@ustprojectorcabinets.com" class="contact-link">support@ustprojectorcabinets.com</a>.</p>
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
    .terms-wrapper {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 30px;
        color: #333;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
    }

    .terms-box {
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
