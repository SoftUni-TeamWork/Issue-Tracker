<?php if ($this->isLoggedIn): ?>
    <form action="/account/logout" method="POST" id="logoutForm">
        <?php include(__DIR__ . '\csft-partial.php') ?>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Hello <?= htmlspecialchars($_SESSION['username']) ?>!</a></li>
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
