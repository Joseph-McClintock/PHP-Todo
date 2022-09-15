<?php include 'inc/navbar/navbar.php'?>

<?php 
    include 'config/database.php'; 
    if(isset($_POST['submit-account'])) {
        if(empty($_POST['username'])) {
            die("Username is required");
        }

        if(strlen($_POST['password']) < 8) {
            die("Password must be at least 8 characters");
        }

        if($_POST['password'] !== $_POST['retype-password']) {
            die("Passwords must match");
        }

        //Prepare the statement to be used
        $stmt = $conn->prepare("INSERT INTO user (username,password) VALUES (?,?)");

        //Values for statement
        $username = $_POST['username'];
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //Binding the values ssi = (string, string, int)
        $stmt->bind_param('ss', $username, $password_hash);

        //Execute the statement
        if($stmt->execute()) {
            header('Location: site.php');
            exit;
        } else {
            die($conn->error . " " . $conn->errno);
        }
  
    }
?>

<link rel="stylesheet" href="signup.css">
<div class="create-account-container">
    <div class="create-account-container-main">
        <div class="create-account-header">
            <h1>Create Your Account</h1>
        </div>

        
        <div class="create-account-form">
            <form  action='signup.php' method='POST'>
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
                <div class="create-account-item">
                    <label for="retype-password">Re-type Password</label>
                    <input
                        id="retype-password"
                        type="password"
                        name="retype-password"
                        placeholder="Re-type Your password"
                    />
                </div>
                <div class='submit-container'>
                    <input type="submit" name="submit-account" value="Submit">
                </div>
            </form>
            <div class='already-have'>
                <p>Already have an account?</p>
                <div class="signup-login-button">
                    <a href="login.php">
                        <h1>Login</h1>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>