<div class="tab-pane active" id="tab1">
    <h3 class="block">Provide your account details</h3>
    <div class="form-group">
        <label class="control-label col-md-3">Username
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="username"
                   value="<?= $this->data->getUsername() ?>"/>
            <span class="help-block"> Provide your username </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Password
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="password" class="form-control" name="password"
                   id="submit_form_password"/>
            <span class="help-block"> Provide your password. </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Confirm Password
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="password" class="form-control" name="rpassword"/>
            <span class="help-block"> Confirm your password </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Email
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="email" value="<?= $this->data->profileData()->getEmail() ?>"/>
            <span class="help-block"> Provide your email address </span>
        </div>
    </div>
</div>
