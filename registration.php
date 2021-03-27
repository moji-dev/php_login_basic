<html>
<head>
    <title>Registration</title>
</head>
<body>
    <h2>Registration</h2>
    <form name="adduser" method="POST" action="registration.php">
        First name: <input name="firstname" type="text" required><br>
        Last name: <input name="lastname" type="text" required><br>
        Username (Email Address): <input name="username" type="text" ><br>
        Password: <input name="password" type="password" required><br><br>
        <input type="submit" value="Sign Up"><br><br><br>
        <a href="login.php">Already a member? Click here to login!</a></br>
        <a href="stats.php">been here before? look at your stats!</a>
    </form>

    <?php



    include('dbconnect.php');
    include('stats_script.php');
    _stats("registration");

    function errors($errors_){
        $date=date("Y-m-d h:i:sa");
        $time=time("h:i:sa");
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $myfile= "error.txt";
        $file= fopen($myfile, "a");
        $stringdata = $date." ".$ip_address." ".$errors_."\n";
        fwrite($file,$stringdata);
      };

    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password'])){{

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
    }


    if(empty($firstname) || empty($lastname) || empty($username) || empty($password)) {
        echo "Please fill in all the boxes";
        errors("please fill in all the boxes");


    }else{
        include('dbconnect.php');
    }

	if(strlen($password) < 6){
		echo "Please enter a password that has six or more characters.";
    errors("password is too short");

	}else{


     $email_format = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

    if (!preg_match($email_format, $username)) {
         echo "Invalid email \n please refresh the page and try again \n your email is too short";
         errors("invalid email");

       }
         else {





    $sql = "insert into registration (firstname, lastname, username, password)
    values('$firstname', '$lastname', '$username', '$password')";

    $rs = mysqli_query($dbconnect, $sql);

    if(!$rs) {
        die("Database connection failed: " . mysqli_error($dbconnect));
        errors("database connection failed");
    }


    mysqli_close($dbconnect);


    if($rs) {
        echo "New user " . $username . " added to the database";
    }

}
	}}//this is closing the password lengh


    ?>

    </body>
</html>
