<div>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?= old('name', esc($user->name)) ?>">
</div>

<div>
    <label for="email">email</label>
    <input type="text" name="email" id="email" value="<?= old('email', esc($user->email)) ?>">
</div>

<div>
    <label for="password">Password</label>
    <input type="password" name="password">
    <?php if ($user->id): ?>
        <p>Leave blank to keep existing password</p>
    <?php endif; ?>
</div>

<div>
    <label for="password_confirmation">Repeat password</label>
    <input type="password" name="password_confirmation">
</div>

<div>
    <label for="is_admin">
        <?php if ($user->id == current_user()->id): ?>
            <input type="checkbox" checked disabled> 管理者
        <?php else: ?>
            <!--  如果checkbox沒有被選擇, post 0, 否則會沒有東西被post過去  -->
            <input type="hidden" name="is_admin" value="0">
            <input type="checkbox" id="is_admin" name="is_admin" value="1"
                   <?php if (old('is_admin', $user->is_admin)): ?>checked<?php endif; ?>
            > 管理者
        <?php endif; ?>
    </label>
</div>