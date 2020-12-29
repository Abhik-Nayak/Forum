<?php 
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];

    //Check wheather email exists
    $existsSql="select * from `user` where user_email='$user_email'";
    $result=mysqli_num_rows($result);
    if($numRows>0){
        $showError="Email already in use";
    }
    else{
        if($pass=$cpass)
        {
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` ( `user_email`, `user_pass`, `timestamp`) 
            VALUES ('$user_email', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$existsql);

            if($result){
                $showAlert=true;
                header("Location:/FORUM_WEBSITEPROJ/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError="Password do not match";
        }
    }
    header("Location: /FORUM_WEBSITEPROJ/index.php?signupsuccess=false&error=$showError");


}
?>