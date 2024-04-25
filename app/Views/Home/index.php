<?= $this->extend('layouts/common') ?>

<?= $this->section('title') ?> Home <?= $this->endSection() ?>

<?= $this->section('content') ?>


<?php if (session()->has('error')) : ?>
    <p><?= session('error') ?></p>
<?php endif; ?>

<?php if (session()->has('message')) : ?>
    <p><?= session('message') ?></p>
<?php endif; ?>

<h1>Welcome to the Blog</h1>
<h3>Here you can write your own articles</h3>
<h3>You can also edit them</h3>
<h3>You can also upload images to the article</h3>
<h3>You can register if you don't have an account</h3>

<?= $this->endSection() ?>