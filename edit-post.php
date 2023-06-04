<?php 
require('includes/config.php'); 
require_once('includes/functions.php');
require('includes/header.php');
if(! $loggedin_user){
	exit('You must be logged in to edit.');
}
require('includes/parse-edit.php'); 
?>
<main class="content">
	<div class="flex one two-700 reverse">
		<section class="preview-image">		
			<?php show_post_image( $image ); ?>
		</section>
		<section class="edit-form">
			<h2>Edit Post</h2>
			<?php show_feedback( $feedback, $feedback_class, $errors ); ?>
			<form method="post" action="edit-post.php?location_id=<?php echo $location_id; ?>">
				<label>Title</label>
				<input type="text" name="title" value="<?php echo $title; ?>">

				
				<label>Category</label>
				<?php category_dropdown(); ?>


				<label>
					<input type="checkbox" name="is_published" value="1" 
						<?php checked( $is_published, 1 ); ?>>
					<span class="checkable">Make this post public</span>
				</label>

				<input type="submit" value="Save Post">
				<input type="hidden" name="did_edit" value="1">
			</form>
		</section>
	</div>
</main>
<?php 

require('includes/footer.php'); 