<?php
if (array_key_exists('login', $_POST)) {
    session_start();
    $textfile = 'C:/private/encrypted.txt';
    $username = trim($_POST['username']);
    $pwd = sha1($username.trim($_POST['pwd']));
    if (file_exists($textfile) && is_readable($textfile)) {
        $users = file($textfile);

        for ($i = 0; $i < count($users); $i++) {
            $tmp = explode(', ', $users[$i]);
            $users[$i] = array('name' => $tmp[0], 'password' => rtrim($tmp[1]));
            if ($users[$i]['name'] == $username && $users[$i]['password'] == $pwd) {

                $_SESSION['authenticated'] = '7432909365';
                break;
            }
        }

        if (isset($_SESSION['authenticated'])) {
            header("Location: private.php");
            exit;
        }
        else {
            $error = 'Invalid username or password.';
        }
    }
    else {
        $error = 'Login facility unavailable. Please try later.';
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Login</title>
    </head>

    <body>
        <?php
        if (isset($error)) {
            echo "<p>$error</p>";
        }
        ?>
        <form id="form1" name="form1" method="post" action="">
            <p>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" />
            </p>
            <p>
                <label for="textfield">Password</label>
                <input type="password" name="pwd" id="pwd" />
            </p>
            <p>
                <input name="login" type="submit" id="login" value="Log in" />
            </p>
        </form>
    </body>
</html>
