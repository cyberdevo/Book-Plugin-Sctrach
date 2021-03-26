<?php
global $wpdb;
$all_books=$wpdb->get_results(
    
        "SELECT * from  wp_my_books ORDER by id DESC"
);
?>
<div class="container">
<div class="row">
<div class="alert alert-info">
<h5>My Book List</h5></div>
<div class="panel panel-primary">
  <div class="panel-heading">Book List</div>
    <div class="panel-body">
    
    <table id="mybook" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Author</th>
                <th>About</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
      
            $i=1;
            foreach($all_books as $key=>$value){
?>
   <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->author; ?></td>
                <td><?php echo $value->about; ?></td>
                <td><img src="<?php echo $value->book_image; ?>" style="width:50px;height:30px;"></td>
                <td><?php echo $value->created_at; ?></td>
                <td>
                <a href="admin.php?page=book-edit&edit=<?php echo $value->id; ?>" class="btn btn-info" >Edit</a>
                <a href="javascript:void(0)" class="btn btn-danger btndelete" data-id="<?php echo $value->id; ?>">Delete</a></td>
            </tr>
     <?php       
        }
        ?>
         
           
        </tbody>
       
    </table>
    </div>
  </div>

</div>
</div>