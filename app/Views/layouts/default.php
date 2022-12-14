<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection("title") ?>></title>
</head>
<body>

<a href="<?= site_url("/") ?>">ð Home</a>

<?php // Log in the authenticated user using the session
if (current_user()): ?>

    <p>Hello <?= esc(current_user()->name) ?></p>

    <a href="<?= site_url("/profile/show") ?>">Profile</a>

    <!--  ç®¡çèé£çµ  -->
    <?php if (current_user()->is_admin): ?>
        <a href="<?= site_url("/admin/users") ?>">ä½¿ç¨èæ¸å®</a>
    <?php endif; ?>

    <a href="<?= site_url("/tasks") ?>">ð©åºä»»åå</a>
    <a href="<?= site_url("/logout") ?>">ðç»åº</a>

<?php else: ?>

    <a href="<?= site_url("/signup") ?>">Sign up</a>
    <a href="<?= site_url("/login") ?>">ðç»å¥</a>

<?php endif; ?>

<!--  flash  -->
<?php if (session()->has('warning')): ?>
    <div class="warning">
        <?= session('warning') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('info')): ?>
    <div class="warning">
        <?= session('info') ?>
    </div>
<?php endif; ?>

<!--csrf message-->
<?php if (session()->has('error')): ?>
    <div class="error">
        <?= session('error') ?>
    </div>
<?php endif; ?>


<?= $this->renderSection("content") ?>

</body>
</html>