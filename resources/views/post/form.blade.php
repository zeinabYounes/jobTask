<div class="form-group">
  <label for="title">Title:</label>
  <input type="text" name="title" value="{{old('title')??$post->title??""}}" class="form-control">
</div>
<div class="form-group">
  <label for="text">Text:</label>
  <textarea name="text" rows="8" cols="80" class="form-control">{{old('text')??$post->text??""}}</textarea>
</div>
