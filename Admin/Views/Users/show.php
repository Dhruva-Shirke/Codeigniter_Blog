<?= $this->extend('layouts/common') ?>

<?= $this->section('title') ?>User<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1>User</h1>

<?php if (session()->has('message')) : ?>
    <p><?= session('message') ?></p>
<?php endif; ?>

<dl>
    <dt>Name</dt>
    <dd><?= esc($user->first_name) ?></dd>
    <dt>Email</dt>
    <dd><?= esc($user->email) ?></dd>
    <dt>Created</dt>
    <dd><?= esc($user->created_at->humanize()) ?></dd>
    <dt>Groups</dt>
    <dd><?= implode(", ", $user->getGroups()) ?>
        <a href="<?= url_to("\Admin\Controllers\Users::groups", $user->id) ?>">Edit</a>
    </dd>
    <dt>Permissions</dt>
    <dd><?= implode(", ", $user->getPermissions()) ?>
        <a href="<?= url_to("\Admin\Controllers\Users::permissions", $user->id) ?>">Edit</a>
    </dd>
</dl>
<?= form_open("admin/users/" . $user->id . "/toggle-ban") ?>
<Button><?= $user->isBanned() ? "Unban" : "Ban" ?></Button>
</form>
<?= $this->endSection() ?>