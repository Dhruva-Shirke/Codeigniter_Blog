<?= $this->extend('layouts/common') ?>

<?= $this->section('title') ?>Article<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->has('message')) : ?>

    <p><?= session('message') ?></p>

<?php endif; ?>

<h1><?= esc($article->title) ?></h1>

<?php if ($article->image) : ?>

    <img src="<?= url_to("Article\Image::get", $article->id) ?>" alt="article-image">

    <?= form_open("articles/" . $article->id . "/image/delete") ?>
    <button>Delete Image</button>
    </form>

<?php else : ?>

    <a href="<?= url_to('Article\Image::new', $article->id) ?>">Edit/Upload Image</a>

<?php endif; ?>

<br>

<?php if (($article->isOwner()) || auth()->user()->can('articles.edit')) : ?>

    <a href="<?= url_to('Articles::edit', $article->id) ?>">Edit Article</a>

<?php endif; ?>

<br>

<?php if (($article->isOwner()) || auth()->user()->can('articles.delete')) : ?>

    <a href="<?= url_to('Articles::confirmDelete', $article->id) ?>">Delete Article</a>

<?php endif; ?>

<p><?= esc($article->content) ?></p>

<?= $this->endSection() ?>


<!-- <?php //foreach ($article as $a => $b) : 
        ?> -->
<!-- <h1><?php //if($a=='title')echo $b;
            ?></h1> -->
<!-- <p><?php //if($a=='content')echo $b;
        ?></p> -->
<!-- <?php //endforeach; 
        ?> -->