
<?php
     include_once("config.php");

    if (isset($_POST['users']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $passwd = $_POST['passwd'];
        // $conpasswd = $_POST['conpasswd'];
        $email = $_POST['email'];
        // $type = $_POST['user_type'];
        
    
    $check = mysqli_query($conn, "select * from users where uname = '$uname'");
    $row = mysqli_fetch_array($check);

    if ($row['uname'] == $uname)
    {
        header("location:register.html?reg=alreadyreg");
    }
    else
    {
        if (strlen($uname) == 0)
        {
            header("location:register.html?err=users");
            return ;
        }

        if (strlen($passwd) < 8)
        {
            // echo $passwd;
            header("location:register.html?err=passlen");
            return ;
        }
        else if ($passwd != $conpasswd)
        {
            // echo $conpasswd;
            header("location:register.html?err=passconpass");
            return ;
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            header("location:register.html?err=email");
        }
    }

    $md5passwd = md5($passwd);

    // if ($type == 'admin')
    // {
    //     $uname = $uname.'_admin';
    // }
    // else
    // {
    //     $uname = $uname.'_user';
    // }
    $insert = mysqli_query($conn, "insert into users (fname, lname, uname, password, email) values ('$fname','$lname','$uname', '$md5passwd', '$email')");
    
    // echo($insert);

    if ($insert)
    {
        header("location:series.html");
        
        // echo("success");
    }
    else
    {
        echo "Insertion failed";
        echo mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>
