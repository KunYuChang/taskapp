<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>編輯使用者個人資訊<?= $this->endSection() ?>
<?= $this->section("content") ?>

<h1>編輯使用者個人資訊</h1>

<!--error message-->
<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open("/admin/users/update/". $user->id) ?>
<?= $this->include('Admin/Users/form') ?>>
<button>Save</button>
<a href="<?= site_url("/admin/users/show/".$user->id) ?>">Cancel</a>
<?= form_close() ?>

<?= $this->endSection() ?>
