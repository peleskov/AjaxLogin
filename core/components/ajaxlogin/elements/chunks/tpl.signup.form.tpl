<form>
    <h4 class="text-center">SignUp</h4>
    <div class="form-group">
        <label for="SignUpFullname">Full Name</label>
        <input type="text" id="SignUpFullname" name="fullname" class="form-control" placeholder="Full Name">
    </div>
    <div class="form-group">
        <label for="SignUpEmail">E-mail</label>
        <input type="text" id="SignUpEmail" name="email" class="form-control" placeholder="e-mail">
    </div>
    <div class="form-group mb-4">
        <label>City</label>
        <select class="w-100 custom-select2" name="city" id="SignUpCity">
            <option disabled selected hidden value="">Enter your city</option>
            <option value="Москва">Moscow</option>
            <option value="Санкт-Петербург">St. Petersburg</option>
            <option value="Екатеринбург">Yekaterinburg</option>
            <option value="Самара">Samara</option>
            <option value="Омск">Omsk</option>
            <option value="Тюмень">Tyumen</option>
        </select>
    </div>
    <div class="form-group">
        <label for="SignUpPhone">Phone</label>
        <input type="tel" id="SignUpPhone" name="mobilephone" class="form-control" placeholder="+7 123 456-78-90">
    </div>
    <div class="form-group">
        <label for="SignUpPassword">Password</label>
        <div class="position-relative">
            <input type="password" id="SignInPassword" name="password" class="form-control" placeholder="Password">
            <button type="button" class="btn btn-pwdshow" tabindex="-1"></button>
        </div>
    </div>
    <div class="form-group">
        <label for="SignUpConfirmPassword">Confirm Password</label>
        <div class="position-relative">
            <input type="password" id="SignUpConfirmPassword" name="password_confirm" class="form-control"
                placeholder="Confirm Password">
            <button type="button" class="btn btn-pwdshow" tabindex="-1"></button>
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-radio">
            <input type="radio" id="RadioAgree" name="i_agree" class="custom-control-input" checked>
            <label class="custom-control-label" for="RadioAgree">I agree</label>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">SignUp</button>
    </div>
</form>