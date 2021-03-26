<?php wp_enqueue_media(); ?>
<?php $book_id=isset($_GET['edit'])? intval($_GET['edit']):0;
global $wpdb;
$book_detail=$wpdb->get_row(
  $wpdb->prepare(
    "SELECT * FROM wp_my_books where id=%d",$book_id
  ),ARRAY_A
)
?>
<div class="container">
<div class="row">
<div class="alert alert-info">
<h5>My Book Edit</h5></div>
<div class="panel panel-primary">
  <div class="panel-heading">Edit New Book</div>
  <div class="panel-body">
  <form action="javascript:void(0)" id="frmEditBook">
  <input type="hidden" name="book_id" value="<?php echo isset($_GET['edit'])?intval($_GET['edit']) :0?>">
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" value="<?php echo $book_detail['name'] ?>" class="form-control" id="name" name="name" required placeholder="enter book name">
  </div>
  <div class="form-group">
    <label for="author">Author:</label>
    <input type="text" value="<?php echo $book_detail['author'] ?>" class="form-control" id="author" name="author" required placeholder="enter author name">
  </div>
  <div class="form-group">
    <label for="about">About:</label>
    <textarea name="about" value="" id="about" placeholder="enter description" class="form-control"><?php echo $book_detail['about'] ?></textarea>
  </div>
  <div class="form-group">
    <label for="email">Upload Image:</label>
    <input type="button" class="btn btn-info" id="btnUpload"  value="Upload Image">
    <span id="show-image">
    <img src="<?php echo $book_detail['book_image'] ?>" style='height:30px;width:50px;'></span>
    <input type="hidden" value="<?php echo $book_detail['book_image'] ?>" name="image-name" id="image-name">
    
  </div>
  <button type="submit"  name="submit"class="btn btn-default">Update</button>
</form>
  </div>
</div>

</div>
</div>