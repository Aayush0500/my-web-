<?php

session_start();

include("server/connection.php");

if (isset($_POST['login_btn'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);

        // Fetch the result inside the conditional block
        if ($stmt->fetch()) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header('location: account.php?message=logged in successfully');


            
        } else {
            header('location: login.php?eerror=wrong email or password');
        }
    } else {
        // error
        header("location: login.php?eerror=something went wrong");
    }
}

?>






<?php include('layouts/header.php') ?>








    <div class="navbar">
        <h1 style="text-align: center; margin-top: 10vh;">Login Page</h1>
    </div>
    <div class="separator"></div>

    <div class="main-container">
        <form action="login.php" method="POST" id="login-form">
            <p style="text-align: center; color:red;"><?php if (isset($_GET['eerror'])) {
                                                            echo $_GET['eerror'];
                                                        } ?></p>
            <label for="email">Email:</label>
            <input style="
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;" type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button name="login_btn" class=".btn.btn-primary btn-login-page" type="submit">Login</button>
        </form>

        <div class="register-link">
            Don't have an account? <a href="register.php">Register</a>
        </div>
    </div>


    <?php include('layouts/footer.php') ?>
