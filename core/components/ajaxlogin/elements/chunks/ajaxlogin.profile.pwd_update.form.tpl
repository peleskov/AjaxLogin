<form>
    <div class="form-group">
        <label for="profileOldPwd">Старый пароль:</label>
        <div class="position-relative">
            <input id="profileOldPwd" name="password_old" type="password" class="form-control" value="">
            <button type="button" class="btn btn-pwdshow" tabindex="-1"></button>
        </div>
    </div>
    <div class="form-group">
        <label for="profileNewPwd">Новый пароль:</label>
        <div class="position-relative">
            <input id="profileNewPwd" name="password_new" type="password" class="form-control" value="">
            <button type="button" class="btn btn-pwdshow" tabindex="-1"></button>
        </div>
    </div>
    <div class="form-group">
        <label for="profileRpNewPwd">Еще раз новый пароль:</label>
        <div class="position-relative">
            <input id="profileRpNewPwd" name="password_new_confirm" type="password" class="form-control"
                value="">
                <button type="button" class="btn btn-pwdshow" tabindex="-1"></button>
        </div>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="changepwd-btn" value="Изменить">
    </div>
    <div class="alert alert-error" role="alert" style="display: none;"></div>
</form>