<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content'
    });
</script>
<form action="create.php" method="post">
    <input type="text" name="title" placeholder="Titel" required>
    <textarea id="content" name="content"></textarea>
    <select name="status">
        <option value="draft">Draft</option>
        <option value="published">Published</option>
        <option value="archived">Archived</option>
    </select>
    <button type="submit">Opslaan</button>
</form>
