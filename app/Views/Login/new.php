<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>Signup<?= $this->endSection() ?>
<?= $this->section("content") ?>

<h1>Login</h1>

<?= form_open("/login/create") ?>

<div>
    <label for="email">email</label>
    <input type="text" name="email" id="email" value="<?= old('email') ?>">
</div>

<div>
    <label for="password">password</label>
    <input type="password" name="password">
</div>

<div>
    <input type="checkbox" name="remember_me" id="remember_me"
        <?php if(old('remember_me')):?>checked<?php endif; ?> >
    <label for="remember_me">remember_me</label>
</div>

<button>Login</button>

<a href="<?= site_url("/password/forgot") ?>">Forgot password?</a>

<?= form_close() ?>

<?= $this->endSection() ?>
