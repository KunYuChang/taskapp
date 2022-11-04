<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Tasks<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>新增任務</h1>

<!--error message-->
<?php if(session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach;?>
    </ul>
<?php endif; ?>

<?= form_open("/tasks/create") ?>

    <?= $this->include('Tasks/form') ?>>

    <button>Save</button>
    <a href="<?= site_url("/tasks")?>">Cancel</a>

<?= form_close() ?>

<?= $this->endSection() ?>
