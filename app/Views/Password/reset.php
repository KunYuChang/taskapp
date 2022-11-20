<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>Tasks<?= $this->endSection() ?>
<?= $this->section("content") ?>

    <h1>Password reset</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php form_open("/password/processreset/$token") ?>

    <div>
        <label for="password">輸入密碼</label>
        <input type="password" name="password">
    </div>

    <div>
        <label for="password_confirmation">再次輸入密碼</label>
        <input type="password" name="password_confirmation">
    </div>

    </form>

    <button>重設密碼</button>

<?= $this->endSection() ?>