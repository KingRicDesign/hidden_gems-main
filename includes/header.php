<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Hidden Gems - <?php echo $page_title; ?></title>
</head>

<body>
<header>
  <a href="index.php" class="button"><h1>Hidden Gems</h1></a>
  <form action="search.php" method="get" class="searchform">
        <input type="search" name="phrase" placeholder="Search">
        <input type="submit" value="search">
    </form>
  <div>
              <a href="#" class="button">Log In</a>
              <a href="#" class="button">Sign Up</a>
  </div>
  </header>