<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>Edit profile<?= $this->endSection() ?>
<?= $this->section("content") ?>

<h1>編輯個人資料</h1>

<!--error message-->
<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<!--form START-->
<?= form_open("/profile/update/") ?>
<div>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?= old('name', esc($user->name)) ?>">
</div>
<div>
    <label for="email">email</label>
    <input type="text" name="email" id="email" value="<?= old('email', esc($user->email)) ?>">
</div>
<button>Save</button>
<a href="<?= site_url("/tasks/show/".$task->id) ?>">Cancel</a>
<?= form_close() ?>
<!--form END-->

<?= $this->endSection() ?>
