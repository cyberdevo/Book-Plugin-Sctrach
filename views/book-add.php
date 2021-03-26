<?php wp_enqueue_media(); ?>
<div class="container">
<div class="row">
<div class="alert alert-info">
<h5>My Book Add</h5></div>
<div class="panel panel-primary">
  <div class="panel-heading">Add New Book</div>
  <div class="panel-body">
  <form action="javascript:void(0)" id="frmAddBook">
  <div class="form-group">
    <label for="email">Name:</label>
    <input type="text" class="form-control" id="name" name="name" required placeholder="enter book name">
  </div>
  <div class="form-group">
    <label for="email">Author:</label>
    <input type="text" class="form-control" id="author" name="author" required placeholder="enter author name">
  </div>
  <div class="form-group">
    <label for="email">About:</label>
    <textarea name="about" id="about" placeholder="enter description" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label for="email">Upload Image:</label>
    <input type="button" class="btn btn-info" id="btnUpload"  value="Upload Image">
    <span id="show-image"></span>
    <input type="hidden" name="image-name" id="image-name">
    
  </div>
  <button type="submit"  id="subm" name="submit"class="btn btn-default">Submit</button>
</form>
  </div>
</div>

</div>
</div>