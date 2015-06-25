<h1>Create new album</h1>
<form action="/albums/create" method="POST" enctype="multipart/form-data">
    <label for="album-title">Title:</label>
    <input id="album-title" name="album-title" type="text" placeholder="Title:" />
    <input type="file" name="photos[]" id="images" accept="image/*" multiple>
    <input type="submit" value="Create" />
</form>