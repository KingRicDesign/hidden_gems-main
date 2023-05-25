<?php
function user_info( $id, $username, $profile_pic = 'avatars/default.png' ){
    #check if profile pic exsist
    
		//fix missing (null) profile_pic
        if( $profile_pic == '' ){
            $profile_pic = 'avatars/default.png';
        };
        ?>
        <div class="user">
            <a href="#">
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
