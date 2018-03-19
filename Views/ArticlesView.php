<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles</title>
    <link rel="stylesheet" href='/css/normalize.css'>
    <link rel="stylesheet" href='/css/bootstrap.min.css'>
    <link rel="stylesheet" href='/css/common-styles.css'>
</head>
<body>
<h1 class="text-center">Articles</h1>
<div class="container">

    <?php if (isset($_SESSION['auth'])): ?>
        <div class="row text-center">
            <h2>Welcome, <?=$_SESSION['auth']; ?>!</h2>
        </div>
        <div class="row text-center">
            <form class="logout-form" method="POST" action='/Controllers/RegistrationController.php'>
                <input type="hidden" name="action" value="logout">
                <button class="btn btn-default" type="submit"><a>[Log Out]</a></button>
            </form>
        </div>
    <?php endif ?>

        <div class="row text-center common-form">

            <?php if (isset($_SESSION['auth'])): ?>
                <form class="article-form common-column" name="articleForm" method='POST' action='/Controllers/ArticleChangesUpdaterController.php'>
                    <h3 class="text-center">New Article</h3>
                    <input name="id" type="hidden" value="">
                    <input class="form-control login-element" name="title" type="text" value="" placeholder="Article Title" required>
                    <textarea class="form-control login-element" name="text" type="text" rows="3" placeholder="Description" required></textarea>
                    <button class="form-control login-button btn btn-default" type="submit"><a>Publish Article</a></button>
                </form>
            <?php else: ?>
                <form class="register-form common-column" name="registrationForm" method="POST" action='/Controllers/RegistrationController.php'>
                    <h3 class="text-center">Sign-Up</h3>
                    <input type="hidden" name="action" value="register">
                    <input class="form-control login-element" name="username" type="text" placeholder="Your New Username" required>
                    <input class="form-control login-element" name="password" type="password" placeholder="Your New Password" required>
                    <input class="form-control login-element" name="passwordConfirm" type="password" placeholder="Confirm Your Password" required>
                    <button class="form-control login-button btn btn-default" type="submit"><a>Register</a></button>
                </form>
                <form class="login-form common-column" name="loginForm" method="POST" action='/Controllers/RegistrationController.php'>
                    <h3 class="text-center">Sign-In</h3>
                    <input type="hidden" name="action" value="login">
                    <input class="form-control login-element" name="username" type="text" placeholder="Your Username" required>
                    <input class="form-control login-element" name="password" type="password" placeholder="Your Password" required>
                    <button class="form-control login-button btn btn-default" type="submit"><a>Login</a></button>
                </form>
            <?php endif ?>

        </div>

    <?php foreach($articles as $article): ?>
    <article class="col-md-4">
        <h2>
            <?php if (isset($_SESSION['auth']) && users_is_admin($_SESSION['auth']) == true): ?>
            <a class='col-md-12 text-center'
               href="/Models/ArticleEditorModel.php?action=edit&id=<?=$article->getId();?>">
                <?=$article->getTitle();?>
            </a>
            <?php else: echo $article->getTitle(); endif; ?>
        </h2>
        <p>
            <?=$article->getText();?>
        </p>

        <?php if (isset($_SESSION['auth']) && users_is_admin($_SESSION['auth']) == true): ?>
            <button class="btn btn-default" onclick="return confirm('Are you sure?')">
                <a href="/Models/ArticleEditorModel.php?action=delete&id=<?=$article->getId();?>">Delete Article
                </a>
            </button>
        <?php endif ?>

    </article>
    <?php endforeach ?>

</div>
</body>
</html>
