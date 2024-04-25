<label for="title">Title</label>
<input type="text" name='title' id='title' value="<?= esc(old('title', esc($article->title))) ?>">
<label for="content">Content</label>
<textarea name="content" id="content" cols="30" rows="10"><?= esc(old('content', esc($article->content))) ?></textarea>
<button>Save</button>