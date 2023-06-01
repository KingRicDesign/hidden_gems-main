<?php  require 'includes/config.php'; 
  require 'includes/functions.php'; 
 $page_title = 'Review'; 
 include 'includes/header.php'; 
 require('includes/parse-reviews.php');?>
<main class="single">
<section class="card single">
<div class="card-header"><h3>Title</h3> <ul class="review-box"><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star-half-stroke"></i></li><li><i class="fa-regular fa-star"></i></li></ul></div>
<article class="card-content grid">

<img src="https://placekitten.com/250/250" alt="">

<section class="right-side" >

    <div><img src="https://placekitten.com/100/100" alt=""> <h4>USERNAME</h4>
    <ul class="review-box">
        <p>DATE</p>    
    <li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star-half-stroke"></i></li><li><i class="fa-regular fa-star"></i></li></ul></div>

    <section>BODY</section>
    <?php require('includes/reviewform.php') ?>
</article>

</section>


</section>
</section>



</main>






  <?php  include 'includes/footer.php'; ?>
