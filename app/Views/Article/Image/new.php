<?= $this->extend('layouts/common') ?>
<?= $this->section('title') ?>Edit Article Image<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1>Edit Article Image</h1>

<?php if (session()->has('message')) : ?>
    <p><?= session('message') ?></p>
<?php endif; ?>

<?php if (session()->has('errors')) : ?>
    <ul>
        <?php foreach (session('errors') as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open_multipart("articles/" . $article->id . "/image/create") ?>

<label for="image">Select Image to upload:</label>
<input type="file" name="image" id="image">

<button>Upload</button>

</form>

<?= $this->endSection() ?>