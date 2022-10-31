<?= $this->extend("layouts/default") ?>

<?= $this->section("title")?>Tasks<?= $this->endSection() ?>

<?= $this->section("content") ?>

    <h1>這裡是任務</h1>

    <ul>
        <?php /** @var array $tasks */
        foreach ($tasks as $task): ?>
            <li>
                <?= $task['id'] ?>
                <?= $task['description'] ?>
            </li>
        <?php endforeach;?>
    </ul>

<?= $this->endSection() ?>
