<?php if ($this->isLoggedIn): ?>
    <form action="/account/logout" method="POST" id="logoutForm">
<!--        @Html.AntiForgeryToken()-->

        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="/issues/me" title="Manage">Hello <?= htmlspecialchars($_SESSION['username']) ?>!</a>
            </li>
            <li><a href="javascript:document.getElementById('logoutForm').submit()">Log off</a></li>
        </ul>
    </form>
<?php else: ?>
   <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="/account/register" id="registerLink">Register</a>
        </li>
        <li>
            <a href="/account/login" id="loginLink">Login</a>
        </li>
    </ul>
<?php endif; ?>
