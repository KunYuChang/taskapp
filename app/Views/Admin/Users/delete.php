<?= $this->extend("layouts/default") ?>
<?= $this->section("title")?>刪除使用者<?= $this->endSection() ?>
<?= $this->section("content") ?>

<h1>刪除使用者</h1>
<p>你確定嗎?</p>
<?= form_open("/admin/users/delete/$user->id") ?>
<button>Yes, I do.</button>
<a href="<?= site_url('/admin/users/show/'.$user->id) ?>">Cancel</a>
<?= form_close() ?>

<?= $this->endSection() ?>
