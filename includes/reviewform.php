<section class="comment-form">
    <h2>New Review</h2>



    <?php show_feedback($feedback, $feedback_class); ?>
    <!-- post is a good default method -->

    <form action="single.php?location_id=<?php echo $location_id ?> " method="post">
    <label for="thebody">Your Review</label>
    <textarea name="body" id="thebody" ></textarea>
    <input type="submit" value="comment">
    <input type="hidden" name="did_review" value="1"> 
    </form>
</section>