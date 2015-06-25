<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($this->title) ?></title>
    <link rel="stylesheet" href="/content/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/content/css/Site.css"/>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Issue tracker</a>
        </div>
        <form class="navbar-form navbar-right" role="search"
              action="/issues/all" method="GET">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" name="query">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a class="navbar-brand" href="/">Home</a>
                </li>
            </ul>
            <?php include('login-partial.php') ?>
        </div>
    </div>
</div>
<div class="container body-content">

    <?php include('messages.php'); ?>
