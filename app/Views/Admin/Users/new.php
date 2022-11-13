<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>新增使用者<?= $this->endSection() ?>
<?= $this->section("content") ?>

<h1>新增使用者</h1>

<!--error message-->
<?php if(session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach;?>
    </ul>
<?php endif; ?>

<?= form_open("/admin/users/create") ?>
    <?= $this->include('Admin/Users/form') ?>>
    <button>Save</button>
    <a href="<?= site_url("/admin/users")?>">Cancel</a>
<?= form_close() ?>

<?= $this->endSection() ?>
