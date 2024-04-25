<?= $this->extend('layouts/common') ?>
<?= $this->section('title') ?>Delete Article <?= $this->endSection() ?>
<?= $this->section('content') ?>

<h1>Delete Article</h1>
<p>Are You Sure?</p>
<?= form_open('articles/' . $article->id) ?>
<input type="hidden" name="_method" value="DELETE">
<input type="submit" value="Submit">
</form>
<?= $this->endSection() ?>