<?php $this->title = 'Login' ?>
<h2><?= htmlspecialchars($this->title) ?></h2>
<div class="row">
    <div class="col-md-8">
        <section id="loginForm">
            <form action="/account/login" method="POST" class="form-horizontal" role="form">

<!--                @Html.AntiForgeryToken()-->
                <h4>Use a local account to log in.</h4>
                <hr/>
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
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="Log in" class="btn btn-default"/>
                    </div>
                </div>
                <p>
                    <a href="/account/register">Register a new user</a>
                </p>
            </form>
        </section>
    </div>
</div>