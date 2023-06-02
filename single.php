<?php  require 'includes/config.php'; 
  require 'includes/functions.php'; 
 $page_title = 'Review'; 




#step 1 - pre determine $post_id variable
$location_id = 0;


#step 2 - validate the _GET data (sanitize and validate)
if(isset($_GET['location_id'])){
    $location_id = filter_var($_GET['location_id'], FILTER_SANITIZE_NUMBER_INT);
    #step 2B - after retrieving the post_id and checking if it is a safe and valid number, check the numbers value. IF less than zero, set it to zero. 
    if($location_id < 0){
        $location_id = 0;
    }
}

include 'includes/header.php'; 
require('includes/parse-reviews.php');
?>

<style>

    .success{background: cyan;}
    .error{background: orange;}
</style>
<main class="single">

    <?php #get all the info about THIS post
    #write it, run it, check it, loop it
	$result = $DB->prepare('SELECT posts.*, users.name, users.profile_pic, locations.title
							FROM posts, users, locations
							WHERE posts.user_id = users.user_id
							AND posts.is_approved = 1
              AND locations.location_id = ?
              AND posts.location_id = locations.location_id
							ORDER BY posts.date DESC
							LIMIT 1');
$result->execute( array($location_id));


if( $result->rowCount() ){
        //loop it
        while( $row = $result->fetch()){
    ?>

<section class="card single">
<div class="card-header"><h3><?php echo $row['title'] ?></h3> <ul class="review-box"><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star-half-stroke"></i></li><li><i class="fa-regular fa-star"></i></li></ul></div>
<article class="card-content grid">

<img src="https://placekitten.com/250/250" alt="">

<section class="right-side" >

    <div><h4><?php user_info( $row['user_id'], $row['name'], $row['profile_pic']); ?></h4>
    <ul class="review-box">
     
    <li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star-half-stroke"></i></li><li><i class="fa-regular fa-star"></i></li></ul></div>
    <small><?php echo $row['date'] ?></small>  
    <section><?php echo $row['body'] ?></section>
    <div class="new-review">
  
  <?php 
      //load the comments on this post
  
  #sometimes when queries interact with each other you need to create a new variable bfore the if statement and then call to that variable.
  $is_approved = $row['is_approved'];
  
  }//close while
  require('includes/reviews.php');
  
  if( $is_approved == 1 AND $loggedin_user){
      require('includes/reviewform.php');
  }
  }//close if
  else{
      echo '<h2>Post not found</h2>';
  }//close else
  ?>
  </div>
</article>



</section>


</section>


</main>














  <?php  include 'includes/footer.php'; ?>
