<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Tasks<?= $this->endSection() ?>

<?= $this->section("content") ?>

    <h1>這裡是任務</h1>

    <a href="<?= site_url("/tasks/new")?>">新增任務</a>

    <ul>
        <?php /** @var array $tasks */
        foreach ($tasks as $task): ?>
            <li>
                <a href="<?= site_url("/tasks/show/" . $task['id']) ?> ">
                    <?= esc($task['description']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

<?= $this->endSection() ?>
