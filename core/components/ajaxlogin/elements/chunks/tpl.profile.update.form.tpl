<form enctype="multipart/form-data">
    <div class="form-group avatar-box d-flex align-items-center justify-content-center">
        <img src="{$_modx->user.photo}" alt="">
            <input type="file" name="photo" accept="image/*">
    </div>

    <div class="form-group">
        <label class="mb-2">Имя пользователя:</label>
        <input type="text" class="form-control" value="{$_modx->user.username}" readonly="">
    </div>
    <div class="form-group">
        <label for="profileFullname">ФИО:</label>
        <input id="profileFullname" name="fullname" type="text" class="form-control" value="{$_modx->user.fullname}">
    </div>
    <div class="form-group">
        <label class="mb-2" for="profileEmail">E-mail:</label>
        <input id="profileEmail" name="email" type="text" class="form-control inputmask" value="{$_modx->user.email}">
    </div>
    <div class="form-group">
        <label class="mb-2" for="profileMobilephone">Тел:</label>
        <input id="profileMobilephone" name="mobilephone" type="tel" class="form-control inputmask"
            value="{$_modx->user.mobilephone}">
    </div>
    <div class="form-group">
        <label class="mb-2" for="profileAddress">Адрес:</label>
        <input id="profileAddress" name="address" type="text" class="form-control" value="{$_modx->user.address}">
    </div>
    <div class="form-group">
        <label class="mb-2" for="profileWebsite">Вебсайт:</label>
        <input id="profileWebsite" name="website" type="text" class="form-control" value="{$_modx->user.website}">
    </div>
    <div class="form-group">
        <label class="mb-2" for="profileСomment">Кратко о себе:</label>
        <textarea name="comment" id="profileСomment" class="form-control textarea"
            rows="8">{$_modx->user.comment}</textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="updateprofile-btn" value="Сохранить">
    </div>
    <div class="alert alert-error" role="alert" style="display: none;"></div>
</form>