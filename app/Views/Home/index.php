<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>Home<?= $this->endSection() ?>
<?= $this->section("content") ?>

    <h1>主頁面</h1>
    <a href="<?= site_url("/signup") ?>">Sign up</a>

<?php // Log in the authenticated user using the session
if (session()->has('user_id')): ?>
    <p>User is logged in</p>
    <a href="<?= site_url("/logout") ?>">👋登出</a>
<?php else: ?>
    <p>User is not logged in</p>
    <a href="<?= site_url("/login") ?>">👉登入</a>
<?php endif; ?>

<?= $this->endSection() ?>