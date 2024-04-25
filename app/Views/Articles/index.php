<?= $this->extend('layouts/common') ?>
<?= $this->section('title') ?>Articles<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php if (session()->has('message')) : ?>
    <?= session('message') ?>
<?php endif; ?>
<h1>Articles</h1>
<a href="<?= url_to("Articles::new") //reverse routing
            ?>">New Article</a>

<?php foreach ($articles as $article) : ?>
    <article>
        <h1><a href="<?= site_url('/articles/') . $article->id ?>"><?= esc($article->title) ?></a></h1>
        <em><?= esc($article->first_name) ?></em>
        <p><?= esc($article->content) ?></p>
    </article>
<?php endforeach; ?>
<!-- <h2>How to install Codeigniter</h2>
<p>To install Codeigniter goto Codeigniter official website and install with composer for easier updates.</p> -->
<?= $pager->simpleLinks() ?>
<?= $this->endSection() ?>