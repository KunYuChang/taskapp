<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>Tasks<?= $this->endSection() ?>
<?= $this->section("content") ?>

    <h1>Password reset</h1>

    <p>Password reset successful</p>

    <a href="<?= site_url("/login") ?>">Login</a>

<?= $this->endSection() ?>