<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>Tasks<?= $this->endSection() ?>
<?= $this->section("content") ?>

<h1>Tasks</h1>

<a href="<?= site_url("/tasks/new") ?>">新增任務</a>

<?php if ($tasks): ?>

    <ul>
        <?php foreach ($tasks as $task): ?>

            <li>
                <a href="<?= site_url("/tasks/show/" . $task->id) ?>">
                    <?= esc($task->description) ?>
                </a>
            </li>

        <?php endforeach; ?>
    </ul>

    <?= $pager->links() ?>

<?php else: ?>

    <p>No tasks found.</p>

<?php endif; ?>

<?= $this->endSection() ?>

