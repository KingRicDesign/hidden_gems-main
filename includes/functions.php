<?php
function user_info( $id, $username, $profile_pic = 'avatars/default.png' ){
    #check if profile pic exsist
    
		//fix missing (null) profile_pic
        if( $profile_pic == '' ){
            $profile_pic = 'avatars/default.png';
        };
        ?>
        <div class="user">
            <a href="user.php">
            <img src="<?php echo $profile_pic;?>" alt="<?php echo $username;?>" width="50" height="50" class="profile-pic">
            <span><?php echo $username?></span>
            </a>
        </div>

<?php
}


function time_ago($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function show_feedback( $heading, $class = 'error', $list = array()  ){
    if( isset( $heading ) AND $heading != '' ){
        echo "<div class='feedback $class'>";
        echo "<h2>$heading</h2>";
        //if the list is not empty, show it is a <ul>
        if( ! empty( $list ) ){
            echo '<ul>';
            foreach( $list as $item ){
                echo "<li>$item</li>";
            }
            echo '</ul>';
        }
        echo '</div>';
    }
}
/**
* displays sql query information including the computed parameters.
* Silent unless DEBUG MODE is set to 1 in CONFIG.php
* @param [statement handler] $sth -  any PDO statement handler that needs troubleshooting
*/
function debug_statement($sth){
    if( DEBUG_MODE ){
        echo '<pre class="full">';
        $info = debug_backtrace();
        echo '<b>Debugger ran from ' . $info[0]['file'] . ' on line ' . $info[0]['line'] . '</b><br><br>';
        $sth->debugDumpParams();
        echo '</pre>';
    }
}
function check_login(){
    global $DB;
    //if the cookie is valid, turn it into session data
    if(isset($_COOKIE['access_token']) AND isset($_COOKIE['user_id'])){
        $_SESSION['access_token'] = $_COOKIE['access_token'];
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    }

   //if the session is valid, check their credentials
    if( isset($_SESSION['access_token']) AND isset($_SESSION['user_id']) ){
        //check to see if these keys match the DB     

        $data = array( 'access_token' =>$_SESSION['access_token']  );

        $result = $DB->prepare(
            "SELECT * FROM users
            WHERE  access_token = :access_token
            LIMIT 1");
        $result->execute( $data );

        if($result->rowCount() > 0){
            //token found. confirm the user_id
            $row = $result->fetch();
            if( password_verify( $row['user_id'], $_SESSION['user_id'] ) ){
                //success! return all the info about the logged in user
                return $row;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }else{
        //not logged in
        return false;
    }
}
function show_post_image( $unique, $size = 'medium', $alt = 'post image'  ){
    $url = "uploads/$unique" . '_' . "$size.jpg";
       //if the "unique" is not an absolute path, format it. 
       //this makes our old placeholder images still work. Not really necessary but nice for this class. 
    if( strpos( $unique, 'http' ) === 0 ){
       $url = $unique;
   }
   echo "<img src='$url' alt='$alt' class='post-image is-$size'>";
   }

#edit post button
function edit_post_button( $post_id = 0, $post_author = 0){
    global $loggedin_user;
    #if the user is logged in and this is their post show the button
    if($loggedin_user AND $loggedin_user['user_id'] == $post_author){
        echo "<a class='edit-post-button' style='background: #fff; border-radius: 5px; padding: .2rem;'href='edit-post.php?post_id=$post_id'> EDIT</a>";
    }

}
function show_profile_pic($src, $size = 50, $alt = 'Profile Picture' ){
    //check if src is blank
    if( '' ==  $src ){
        $src =  'avatars/default.png';
    }
    ?>
    <img class="profile-pic" src="<?php echo $src ?>" alt="<?php echo $alt ?>" width="<?php echo $size ?>" height="<?php echo $size ?>">
    <?php 
}

function count_followers( $user_id ){
    global $DB;
    $result = $DB->prepare('SELECT COUNT(*) as total
        FROM follows
        WHERE to_user_id = ?');
    $result->execute(array($user_id));
    $row = $result->fetch();
    extract($row);
    echo $total == 1 ? '1 Follower' : "$total Followers";
}

/**
 * Count the number of times this user appears in the "from" field
 */
function count_following( $user_id ){
    global $DB;
    $result = $DB->prepare('SELECT COUNT(*) as total
        FROM follows
        WHERE from_user_id = ?');
    $result->execute(array($user_id));
    $row = $result->fetch();
    extract($row);
    echo "$total Following";
}

function follows_interface( $profile_id ){
    global $logged_in_user;
    global $DB;
    if($logged_in_user){
        //does the logged in user already follow this profile?
        $result = $DB->prepare('SELECT * FROM follows
            WHERE to_user_id = :to
            AND from_user_id = :from
            LIMIT 1');
        $result->execute( array(
            'to' => $profile_id,
            'from' => $logged_in_user['user_id'],
        ) );
        if($result->rowCount()){
            //already following
            $label = 'Unfollow';
            $class = 'button-outline';
        }else{
            //not yet following
            $label = 'Follow';
            $class = 'button';
        }    
    } ?>
    <div class="item"><?php count_followers( $profile_id ); ?></div>
    <div class="item"><?php count_following( $profile_id ); ?></div>
    <?php if( $logged_in_user AND $logged_in_user['user_id'] != $profile_id ){ ?>
        <div class="item">
            <button class="follow-button <?php echo $class; ?>" data-to="<?php echo $profile_id; ?>">
                <?php echo $label; ?>
            </button>
        </div>
        <?php
    }//end if logged in and not your profile
}

/**
 * Rating Example
 */