<?= $this->extend('layouts/common') ?>

<?= $this->section('title') ?>User Groups<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1>User Groups</h1>

<?php if (session()->has('message')) : ?>
    <p><?= session('message') ?></p>
<?php endif; ?>

<?= form_open("admin/users/" . $user->id . "/groups") ?>
<label>
    <input type="checkbox" name="groups[]" value="user" <?= $user->inGroup('user') ? "checked" : "" ?>>User
</label>
<label>
    <?php if ($user->id === auth()->user()->id) : ?>
        <input type="checkbox" checked disabled>admin
        <input type="hidden" name="groups[]" value="admin">
    <?php else : ?>
        <input type="checkbox" name="groups[]" value="admin" <?= $user->inGroup('admin') ? "checked" : "" ?>>Admin
    <?php endif; ?>
</label>
<Button>Save</Button>
</form>
<?= $this->endSection() ?>