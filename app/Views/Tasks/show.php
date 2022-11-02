<?= $this->extend("layouts/default") ?>

<?= $this->section("title")?>Task<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>任務</h1>
<a href="<?= site_url("/tasks")?>">&laquo; 回到首頁</a>

<dl>
    <dt>ID</dt>
    <dd><?= $task['id'] ?></dd>

    <dt>Description</dt>
    <dd><?= esc($task['description']) ?></dd>

    <dt>Created at</dt>
    <dd><?= $task['created_at'] ?></dd>

    <dt>Updated at</dt>
    <dd><?= $task['updated_at'] ?></dd>
</dl>


<?= $this->endSection() ?>
