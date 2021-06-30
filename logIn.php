<?php
session_start();

// logout logic
if (isset($_GET['action']) and $_GET['action'] == 'logout') {
    // session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['logged_in']);
    print('Logged out!');
}

// login logic
$msg = '';
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    if ($_POST['username'] == 'Mindaugas' && $_POST['password'] == '123456789') {
        $_SESSION['logged_in'] = "true";
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $_POST['username'];
        $msg = 'You have entered valid use name and password';
        header('Location:' . 'index.php');
    } else {
        $msg = 'Wrong username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link>
    <style>
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>To Log In Enter Username and password</h2>
        <p>Please fill this form to log in.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="username=Mindaugas" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="pass=123456789" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
            <h4><?php echo $msg; ?></h4>
            </div>
           
        </form>
    </div>    
</body>
</html>