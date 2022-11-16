<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection("title") ?>></title>
</head>
<body>

<a href="<?= site_url("/") ?>">🏠Home</a>

<?php // Log in the authenticated user using the session
if (current_user()): ?>

    <p>Hello <?= esc(current_user()->name) ?></p>

    <!--  管理者連結  -->
    <?php if (current_user()->is_admin): ?>
        <a href="<?= site_url("/admin/users") ?>">使用者清單</a>
    <?php endif; ?>

    <a href="<?= site_url("/tasks") ?>">🚩出任務囉</a>
    <a href="<?= site_url("/logout") ?>">👋登出</a>

<?php else: ?>

    <a href="<?= site_url("/signup") ?>">Sign up</a>
    <a href="<?= site_url("/login") ?>">👉登入</a>

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