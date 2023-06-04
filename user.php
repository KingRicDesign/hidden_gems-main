<?php 
require('includes/config.php'); 
require_once('includes/functions.php');
require('includes/header.php');

//whose profile is this?
if(isset($_GET['user_id'])){
	$user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
}elseif($loggedin_user){
	$user_id = $loggedin_user['user_id'];
}else{
	exit('Invalid User Account');
}

?>
<main class="content">
	<div class="flex three four-600 five-900">
		<?php 
		//get the user info
		$result = $DB->prepare('SELECT * FROM  users
			WHERE user_id = ?
			LIMIT 1'); 
		$result->execute(array($user_id));

		if( $result->rowCount() >= 1 ){			
			$row = $result->fetch();
			extract($row);		
			?>
			<section class="full author-profile">
				<?php show_profile_pic($profile_pic, 100, $name ); ?>
				<h2><?php echo $name ?></h2>
				<p><?php echo $bio; ?></p>
				<div class="flex" id="follow-info">
					
				</div>
				<hr>
			</section>
			<?php
			
	//get this user's posts (left join so uncategorized posts are included)
	$query = 'SELECT *,  categories.name
				FROM locations
					LEFT JOIN  categories
					ON  categories.category_id = locations.category_id
				WHERE locations.user_id = ? ';
	//if viewing someone else's profile, hide the drafts
	if(  !$loggedin_user  OR $user_id != $loggedin_user['user_id']){
		$query .= ' AND locations.is_published = 1';
	}

	$query .= ' ORDER BY is_published ASC, location_id	DESC		
				';	
			$result = $DB->prepare($query); 

			$result->execute(array($user_id));

			if( $result->rowCount() >= 1 ){			
				?>

				<?php
				while( $row = $result->fetch() ){
					extract($row);
					//handle the draft content
				if($is_published == 0){
					$class='draft';
					$title = 'Draft Post';
					$name = 'Uncategorized';
					$url = "edit-post.php?location_id=$location_id";
				}else{
					$class = 'public';
					$url = "single.php?location_id=$location_id";
				}	 
					
					?>
					<article class="post <?php echo $class ?>">
						<div class="card">
						<div class="card-header-title">          <h5><?php echo $row['title']; ?></h5>
          <ul class="user-review">
        <li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star-half-stroke"></i></li><li><i class="fa-regular fa-star"></i></li></ul>
        </div>
							<a href="<?php echo $url; ?>">
								<?php show_post_image( $image, 'medium' ) ?>

							</a>


							<footer class="category"><?php echo $name; ?></footer>
							

						</div>		
					</article>
				<?php } //end while loop?>
				
			<?php }else{ ?>

				<div class="full feedback info">
					<p>This user hasn't posted any public images</p>
				</div>

				<?php 
		}//end if posts found 
	}else{
		echo 'Sorry, that user account doesn\'t exist';
	}?>
</div>
</main>

<?php
require('includes/footer.php');
?>	