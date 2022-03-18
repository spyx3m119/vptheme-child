<?php
   require('/wp-blog-header.php');  // Wordpress need to recongnise your modal file actually loads most the WordPress functionality that you're used to using.
   $post_id = $_GET['ID'];
   $queried_post = get_post($post_id);
   $queried_object = get_queried_object();
?>

<div class="modal-dialog">
           <div class="modal-content">
                <div class="modal-header">
                   <h4 class="modal-title" id="myModalLabel"><?php echo $queried_post->post_title; ?></h4>
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">X</span><span class="sr-only">Close</span></button>
                 </div>
                 <div class="modal-body">
                       <?php
                       echo $queried_post->post_content;
                       ?>
                 </div>
              </div>
</div>