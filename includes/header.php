<?php 
$loggedin_user = check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/50ba038bad.js" crossorigin="anonymous"></script>
    <title>Hidden Gems - <?php echo $page_title; ?></title>
</head>

<body>
<header>
  
  <a href="index.php" class="button logo"><h1> Hidden Gems </h1></a>
  <form action="search.php" method="get" class="searchform">
        <input type="search" name="phrase" placeholder="Search">
        <button type="submit" value="search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
  <div>
  <?php if( $loggedin_user ){
 ?>
             <a href="login.php?action=logout"   class="button">
		Log Out
	</a>
	<a href="new-post.php" class="button">
		&plus; New Post
	</a>
		<a href="user.php"class="button">
		<?php echo $loggedin_user['name']; ?>
	</a>
  <?php }else{
 ?>	<a href="signup.php" class="button">
 Sign Up
</a>
<a href="login.php"  class="button">
 Login
</a>


<?php }
?>
  </div>
  </header>