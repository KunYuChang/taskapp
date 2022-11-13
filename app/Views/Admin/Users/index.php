<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>Users<?= $this->endSection() ?>
<?= $this->section("content") ?>

<h1>Users</h1>

<a href="<?= site_url("/admin/users/new") ?>">新增使用者</a>

<?php if ($users): ?>

    <table>
        <thead>
        <tr>
            <td>姓名</td>
            <td>信箱</td>
            <td>創建時間</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>

            <tr>
                <td>
                    <a href="<?= site_url("/admin/users/show/" . $user->id) ?>">
                        <?= esc($task->name) ?>
                    </a>
                </td>
                <td><?= esc($user->email) ?></td>
                <td><?= $user->created_at ?></td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>

    <?= $pager->links() ?>

<?php else: ?>

    <p>No users found.</p>

<?php endif; ?>

<?= $this->endSection() ?>

