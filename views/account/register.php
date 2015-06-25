<?php
    $this->title = 'Register';
?>

<h2><?= $this->title ?></h2>

<form action="/account/register" method="POST" class="form-horizontal" role="form">

<!--    @Html.AntiForgeryToken()-->
    <h4>Create a new account.</h4>
    <hr />
    <div class="text-danger validation-summary-errors"></div>
    <div class="form-group">
        <label for="username" class="col-md-2 control-label">Username: </label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="username" name="username" />
            <span class="field-validation-valid text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-md-2 control-label">Password: </label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="password" name="password" />
            <span class="field-validation-valid text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="confirm-password" class="col-md-2 control-label">Confirm password: </label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="confirm-password" name="confirm-password" />
            <span class="field-validation-valid text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="submit" class="btn btn-default" value="Register" />
        </div>
    </div>
</form>