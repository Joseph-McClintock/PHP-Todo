<?php 
    if(isset($_SESSION['user_id'])) {
        $sqluser = "SELECT username FROM user 
                WHERE id = {$_SESSION['user_id']}";
        $result = $conn->query($sqluser);

        $user = $result->fetch_assoc();
        
    }
?>
<?php include 'config/database.php'; 

    if(isset($_POST['mark-complete'])) {

        if(empty($_POST['id'])) {
            
        } else {
            //Prepare the statement to be used
            $stmt = $conn->prepare("UPDATE todo SET complete = 1 WHERE id = (?)");

            //Values for statement
            $todoId = $_POST['id'];

            //Binding the values  = (int)
            $stmt->bind_param('i', $todoId);

            //Execute the statement
            $stmt->execute();

            header('Location: site.php');
            exit;
        }
    }
?>

<?php include 'inc/navbar/navbar.php'?>
<body>
    <div class='center'>
        <?php if(isset($user)): ?>
        <div class='header-text'>
            <h1>Welcome <?= htmlspecialchars($user["username"]) ?> </h1>
            <h1>Todo App</h1>
            <h2>Enter todos below</h2>
        </div>
        
        <div class='form-and-todos'>
            <form action='site.php' method='POST'>
                <div class='form-input'>
                    <label for="title">Title: </label>
                    <div class="text-input">
                        <input type='text' 
                                name='title' 
                                placeholder="Enter a title">
                    </div>
                </div>
                    <br>
                <div class='form-input'>
                    <label for="description">Description: </label>
                    <div class="text-input">
                    <input type='text' 
                            name='description' 
                            placeholder="Enter a description">
                    </div>
                </div> 

                <div class='submit-container'>
                    <input type="submit" name="submit" value="Submit">
                </div>
            </form>
            
            <?php  
                $sql = "SELECT * FROM todo WHERE complete = 0 && owner = '{$user['username']}'";
                $result = mysqli_query($conn, $sql);
                $todos = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
            <?php 
                if(isset($_POST['submit'])) {

                    if(empty($_POST['title']) || empty($_POST['description'])) {
                        
                    } else {
                        //Prepare the statement to be used
                        $stmt = $conn->prepare("INSERT INTO todo (owner, title,description,complete) VALUES (?,?,?,?)");
            
                        //Values for statement
                        $owner = $user['username'];
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $complete = 0;
            
                        //Binding the values ssi = (string, string, int)
                        $stmt->bind_param('sssi', $owner, $title, $description, $complete);
            
                        //Execute the statement
                        $stmt->execute();
            
                        header('Location: site.php');
                        exit;
                    }
                }
            ?>
            <?php foreach($todos as $item): ?>
                <?php if($item['complete'] == 0){ ?>
                    <div class='todo'>
                        <div class='todo-item'>
                            <?php echo $item['title']; ?>
                        </div>

                        <div class='todo-item'>
                            <?php echo $item['description']; ?>
                        </div>
                            
                        <div class='todo-item-complete'>
                            <div class='complete'>
                            <?php 
                                if($item['complete'] == 0) {
                                echo 'Not Complete';
                                } 
                            ?>
                            </div>
                            <div class='complete-container'>
                                <form action='site.php'method="POST">
                                    <input type='hidden' name='id' value="<?php echo $item['id']?>">
                                    <input type="submit" name="mark-complete" value="Mark Complete">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <p><a href="login.php">Log in to use the app</a></p>
        <?php endif; ?>
    </div>
</body>
</html>