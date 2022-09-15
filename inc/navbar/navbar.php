<?php 
    if(isset($_SESSION['user_id'])) {
        $sql = "SELECT username FROM user 
                WHERE id = {$_SESSION['user_id']}";
        $result = $conn->query($sql);

        $user = $result->fetch_assoc();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
</head>
<body>
    <div class='nav-container'>
        <div class='nav-home'>
            <a href="site.php">
                <h1>Home</h1>
            </a>
        </div>
        
        <div class='nav-login'>
            
            <!-- Use if statement to conditionally change the href-->
            <?php if(isset($user)): ?>
                <a href="logout.php">
                    <h1>Log Out</h1>
                </a>
            <?php else: ?>
                <a href="login.php">
                    <h1>Log In</h1>
                </a>
            <?php endif; ?>
        </div>
    </div>
</body>