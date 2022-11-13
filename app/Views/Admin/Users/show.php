<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>User<?= $this->endSection() ?>
<?= $this->section("content") ?>

<h1>顯示任務</h1>
<a href="<?= site_url("/admin/users") ?>">&laquo; 回到首頁</a>

<dl>
    <dt>姓名</dt>
    <dd><?= esc($user->name) ?></dd>

    <dt>信箱</dt>
    <dd><?= esc($user->email) ?></dd>

    <dt>Created at</dt>
    <dd><?= $user->created_at ?></dd>

    <dt>Updated at</dt>
    <dd><?= $user->updated_at ?></dd>
</dl>

<a href="<?= site_url('/admin/users/edit/' . $user->id) ?>">Edit</a>
<a href="<?= site_url('/admin/users/delete/' . $user->id) ?>">Delete</a>

<?= $this->endSection() ?>
