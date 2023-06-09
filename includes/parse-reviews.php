<?php 
$feedback = '';
$feedback_class = '';
#if the form was submitted then
if( isset($_POST['did_review'])  ){
    #sanitize the fields
    $body = trim(strip_tags($_POST['body']));
    #today we will act as if logged in to user one
    $valid = true;
    #set the body limits. must be between 1-300
    if($body == '' OR strlen($body) > 300){
        $valid = false;
    }#end if $body cont
    
    #vaildate
    if( $valid ){
        $result = $DB->prepare('INSERT INTO posts
                        (user_id, date, body, is_approved, location_id )
                        VALUES 
                        ( :user, NOW(), :body, 1, :loc)');
                        #the :user works the same as ?. a named placeholder variable
                        $result->execute( array(
                            'user'=> $loggedin_user['user_id'],
                            'body'=> $body,
                            'loc' => $location_id
                        ) );
        #if valid
        
        if ($result->rowCount()){
            $feedback = 'Thanks for your comment';
            $feedback_class ="success";
        }else{
            
            $feedback = 'Error leaving a comment, Please try later.';
            $feedback_class ="error";
        }
    }#end if$valid
    else{

        $feedback = 'Not a valid comment, must be between 1-300 characters'; 
        $feedback_class ="error";   }




}#end if parser