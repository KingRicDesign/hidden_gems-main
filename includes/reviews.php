<?php 
#get all the approved comments on THIS specific post.
#1)prepare
$result = $DB->prepare('SELECT posts.*, users.name, users.profile_pic
                        FROM posts, users
                        WHERE posts.user_id = users.user_id
                        AND is_approved = 1
                        AND location_id = ?
                        ORDER BY date DESC
                        LIMIT 5
                        ');
#2) execute
$result->execute( array( $location_id ));
#3) check
$totalreviews = $result->rowCount();
if($totalreviews){


?>
<section class="reviews">
    <h2><?php echo $totalreviews; ?> reviews on this post</h2>

    <?php #4) loop
    while( $row = $result->fetch() ){ ?>
    <div class="card">
    <div class="user">
    <div>
            <h4><?php user_info( $row['user_id'], $row['name'], $row['profile_pic']); ?></h4>
            <ul class="review-box">
     
                <li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star-half-stroke"></i></li><li><i class="fa-regular fa-star"></i></li>
            </ul>
        </div>
					
					</div>


        <p><?php echo $row['body']; ?></p>
        <span class="date"><?php echo time_ago($row['date']); ?></span>
    </div>
    <?php }//ends step 4)loop ?>
</section>
<?php }//ends step 3)check ?>