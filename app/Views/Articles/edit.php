<?= $this->extend('layouts/common') ?>
<?= $this->section('title') ?>Edit Articles<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1>Edit Article</h1>

<?php if(session()->has('message')):?>
<p><?= session('message') ?></p>
<?php endif;?>

<?php if (session()->has('errors')) : ?>
    <ul>
        <?php foreach (session('errors') as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?= form_open("articles/" . $article->id) ?>
<input type="hidden" name="_method" value="PATCH">
<?= $this->include('Articles/form') ?>
</form>
<?= $this->endSection() ?>