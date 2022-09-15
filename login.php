<?php include 'inc/navbar/navbar.php'?>
<?php 
    include 'config/database.php'; 
     
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $sql = sprintf("SELECT * FROM user 
                        WHERE username = '%s'", 
                        $conn->real_escape_string($_POST["username"]));
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        if($user) {
            if(password_verify($_POST["password"], $user['password'])) {

                session_start();
                
                session_regenerate_id();

                $_SESSION["user_id"] = $user["id"];

                header('Location: site.php');
                exit;
            }
        }
    }
?>
<link rel="stylesheet" href="signup.css">
<div class="create-account-container">
    <div class="create-account-container-main">
        <div class="create-account-header">
            <h1>Login</h1>
        </div>
        <div class="create-account-form">
            <form  action="login.php" method="POST">
                <div class="create-account-item">
                    
                    <label for="username">Username</label>
                    <input
                        id="username"
                        type="text"
                        name="username"
                        placeholder="Your username"
                        
                    />
                </div>
                <div class="create-account-item">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Your password"
                    />
                </div>
                <div class='submit-container'>
                    <input type="submit" name="login-account" value="Login">
                </div>
            </form>
            <div class='already-have'>
                <p>Don't have an account?</p>
                <div class="signup-login-button">
                    <a href="signup.php">
                        <h1>Create Account</h1>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>