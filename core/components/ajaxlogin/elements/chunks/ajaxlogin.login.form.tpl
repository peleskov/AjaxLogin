<form>
    <input type="hidden" name="service" value="login" />
    <h4 class="text-center">LogIn</h4>
    <div class="form-group">
        <label for="SignInUsername">User name</label>
        <input type="text" id="SignInUsername" name="username" class="form-control"
            placeholder="Username" value="info@s1temaker.ru">
    </div>
    <div class="form-group">
        <label for="SignInPassword">Password</label>
        <div class="position-relative">
            <input type="password" id="SignInPassword" name="password" class="form-control"
                placeholder="Password" value="123456789">
            <button type="button" class="btn btn-pwdshow" tabindex="-1"></button>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">SignIn</button>
    </div>
    <div class="alert alert-error" role="alert" style="display: none;"></div>
</form>
