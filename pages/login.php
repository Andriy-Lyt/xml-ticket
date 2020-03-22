<?php
session_start();

// this is our error message. we going to tell user what is wrong if we are not able to log him in
$message = '';
$xml=simplexml_load_file("../xml/tickets.xml");

/*passw test ================
$_POST['password'] = 1;
$psw_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
if (password_verify(1, $psw_hashed)){
    echo 'true';
}else{echo 'false';}*/
//==============================

// if user hit 'submit' button
if(isset($_POST['username']) && isset($_POST['password'])){
    if(empty($message)) {
        if (!$xml = @simplexml_load_file("../xml/tickets.xml")) {
            $message = "Unable to read 'tickets.xml' file and fetch users";
        }
    }
    if(empty($message)) {

        // LOGIN MAGIC HERE!!!!!!
        // we are trying to find user with with provided username and pass.
        // if such user exists - we put his id into superglobal array $_SESSION.
        //
        // Because we started session (called session_start() in index.php) server will save
        // this id and we will be able to get it during NEXT request.
        // We can save not only id but any information we want in session:
        // $_SESSION['someKey'] = ['some', 'values'];
        //hash
        $psw_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
        foreach ($xml->users->user as $user) {
            if ($user->username == $_POST['username'] && password_verify ($user->password, $psw_hashed)) {
                $_SESSION['user-id'] = (int)$user->userid;

            /*  echo '$_SESSION[\'user-id\'] = '. $_SESSION['user-id'].'<br />';
            echo '$_POST[\'username\'] = '.$_POST['username'].'<br />';
            echo '$_POST[\'password\'] = '.$_POST['password'].'<br />';
            exit();*/
            }
        }
    }
    if(empty($message) && empty($_SESSION['user-id'])){
        $message = "Wrong username or password";
    }
}
if(!empty($_SESSION['user-id'])) {
    // it means that user has logged in successfully and there is no need to show this page

    $privilege = $xml->xpath("//user[@userid={$_SESSION['user-id']}]/privilege")[0];
//    echo "privilege = ". $privilege.'<br />';
//      echo '$_SESSION[user-id] = '. $_SESSION['user-id'].'<br />';

    if ($privilege == "admin"){
        header("Location: tickets-adm.php");
    }else{
        header("Location: tickets-us.php");
    }
}

include_once '../layout/top_noside.php';
?>
<form action="" id="login-form" method="post">
    <h3>Login</h3>

    <?php if ($message){?>
        <div class="alert alert-warning alert-dismissible fade show"><?php echo $message ?></div>
    <?php } ?>

    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="text" class="form-control" name="username" aria-describedby="emailHelp"
               value="<?php  ?>" placeholder="Username">
<!--        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<h2>Login Details</h2>
<table cellpadding="7px"  class="table-cel-cntr">
    <tr><th>Username</th> <th>Password</th>
    <tr><td>admin</td> <td>1</td></tr>
    <tr><td>user2</td> <td>2</td></tr>
    <tr><td>user3</td> <td>3</td></tr>
</table>

<?php include_once '../layout/bottom.php';
?>
