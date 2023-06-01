<?php  require 'includes/config.php'; 
  require 'includes/functions.php'; 
 $page_title = 'Homepage'; 
 include 'includes/header.php'; ?>
  <div class="hero">
    <div class=heroText>
    <h2>Popular <br> Spots</h2>
      <a href="#" class="button">Check  out more...  </a>
    </div>
    <div class="slider">
      
    </div>
  </div>


  <section class="recentReviews">
    <h3>Recent Reviews</h3>
    <div class="grid">
<?php 
    $result = $DB->prepare('SELECT posts.*, locations.*, users.name, users.profile_pic
                            FROM posts, locations, users 
                            WHERE posts.user_id = users.user_id
                            AND posts.location_id = locations.location_id
                            ORDER BY posts.date DESC
                            LIMIT 4');

    $result->execute();

    // debug_statement($result);
    if($result->rowCount()){

        while($row = $result->fetch()){
?>


    
      <div class="card">
        <div class="card-header-title">          <h5><?php echo $row['title']; ?></h5>
          <ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li></ul>
        </div>
        <div class="card-content">              <div class="card-image"><img src="<?php echo $row['photo']; ?>" alt=""></div> <article><h6><?php user_info( $row['user_id'], $row['name'], $row['profile_pic']); ?></h6><p><?php echo $row['body']; ?></p>
          <ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li></ul>
        </article> </div>
        <div class="card-content"><a href="single.php" class="button">New Review</a>
          <a href="single.php" class="button">More Reviews</a>
        </div>
      </div>
      
      <?php 
        }  
    }else{
        echo '<h2> No post to show </h2>';
      } ?>
    </div>
  </section>
    <section class="about">
    <h3>About Us</h3>
      <article style="display: flex; width: 80%; margin: 0 auto;">
        <img src="https://placekitten.com/500/500" alt="">
        <p>Welcome to our review website, where we unveil the hidden gems that lie off the beaten path. Our team of passionate explorers scours the world to discover extraordinary trails, restaurants, abandoned buildings, and other captivating finds. From breathtaking trails and unique dining experiences to the allure of abandoned places, our website is your ultimate guide to the cool and hidden wonders awaiting you.
        </p>
      </article>

    </section>



  <?php  include 'includes/footer.php'; ?>
