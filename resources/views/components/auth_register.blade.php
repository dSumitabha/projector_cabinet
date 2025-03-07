<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="section-title">
                <h2 class="ec-bg-title">Register</h2>
                <h2 class="ec-title">Register</h2>
                <p class="sub-title mb-3">Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <div class="ec-register-wrapper">
            <div class="ec-register-container">
                <div class="ec-register-form">
                    <form action="#" method="post">
                        <span class="ec-register-wrap ec-register-half">
                            <label>First Name*</label>
                            <input type="text" name="firstname" placeholder="Enter your first name" required />
                        </span>
                        <span class="ec-register-wrap ec-register-half">
                            <label>Last Name*</label>
                            <input type="text" name="lastname" placeholder="Enter your last name" required />
                        </span>
                        <span class="ec-register-wrap ec-register-half">
                            <label>Email*</label>
                            <input type="email" name="email" placeholder="Enter your email add..." required />
                        </span>
                        <span class="ec-register-wrap ec-register-half">
                            <label>Phone Number*</label>
                            <input type="text" name="phonenumber" placeholder="Enter your phone number"
                                required />
                        </span>
                        <span class="ec-register-wrap ec-register-half">
                            <label>Password*</label>
                            <input type="password" name="password" placeholder="Enter your password"
                                required />
                        </span>
                        <span class="ec-register-wrap ec-register-half">
                            <label>Confirm Password*</label>
                            <input type="password" name="c_password" placeholder="Confirm your password"
                                required />
                        </span>

                        <span class="ec-register-wrap">
                            <label>Address</label>
                            <input type="text" name="address" placeholder="Address Line 1" />
                        </span>
                        <span class="ec-register-wrap ec-register-half">
                            <label>City *</label>
                            <span class="ec-rg-select-inner">
                                <select name="ec_select_city" id="ec-select-city" class="ec-register-select">
                                    <option selected disabled>City</option>
                                    <option value="1">City 1</option>
                                    <option value="2">City 2</option>
                                    <option value="3">City 3</option>
                                    <option value="4">City 4</option>
                                    <option value="5">City 5</option>
                                </select>
                            </span>
                        </span>
                        <span class="ec-register-wrap ec-register-half">
                            <label>Post Code</label>
                            <input type="text" name="postalcode" placeholder="Post Code" />
                        </span>
                        <span class="ec-register-wrap ec-register-half">
                            <label>Country *</label>
                            <span class="ec-rg-select-inner">
                                <select name="ec_select_country" id="ec-select-country"
                                    class="ec-register-select">
                                    <option selected disabled>Country</option>
                                    <option value="1">Country 1</option>
                                    <option value="2">Country 2</option>
                                    <option value="3">Country 3</option>
                                    <option value="4">Country 4</option>
                                    <option value="5">Country 5</option>
                                </select>
                            </span>
                        </span>
                        <span class="ec-register-wrap ec-register-half">
                            <label>Region State</label>
                            <span class="ec-rg-select-inner">
                                <select name="ec_select_state" id="ec-select-state" class="ec-register-select">
                                    <option selected disabled>Region/State</option>
                                    <option value="1">Region/State 1</option>
                                    <option value="2">Region/State 2</option>
                                    <option value="3">Region/State 3</option>
                                    <option value="4">Region/State 4</option>
                                    <option value="5">Region/State 5</option>
                                </select>
                            </span>
                        </span>
                        <span class="ec-register-wrap ec-recaptcha">
                            <span class="g-recaptcha" data-sitekey="6LfKURIUAAAAAO50vlwWZkyK_G2ywqE52NU7YO0S"
                                data-callback="verifyRecaptchaCallback"
                                data-expired-callback="expiredRecaptchaCallback"></span>
                            <input class="form-control d-none" data-recaptcha="true" required
                                data-error="Please complete the Captcha">
                            <span class="help-block with-errors"></span>
                        </span>
                        <span class="ec-register-wrap ec-register-btn">
                            <button class="btn btn-primary" type="submit">Register</button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>