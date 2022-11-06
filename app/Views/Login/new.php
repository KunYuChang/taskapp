<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>Signup<?= $this->endSection() ?>
<?= $this->section("content") ?>

<h1>Login</h1>

<?= form_open("/signup/create") ?>

<div>
    <label for="email">email</label>
    <input type="text" name="email" id="email" value="<?= old('email') ?>">
</div>

<div>
    <label for="password">email</label>
    <input type="password" name="password">
</div>

<button>Login</button>

<?= form_close() ?>

<?= $this->endSection() ?>
