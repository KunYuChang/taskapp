<?= $this->extend("layouts/default") ?>
<?= $this->section("title")?>Task<?= $this->endSection() ?>
<?= $this->section("content") ?>

<h1>刪除任務</h1>
<p>你確定嗎?</p>
<?= form_open("/tasks/delete/$task->id") ?>
<button>Yes, I do.</button>
<a href="<?= site_url('/task/show/'.$task->id) ?>">Cancel</a>
<?= form_close() ?>

<?= $this->endSection() ?>
