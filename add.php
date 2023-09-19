<?php

    
    include('config/connect_db.php');

    //initialize errors array
    $errors = ['title'=>'', 'author'=>'','isbn'=>'','type'=>''];

    if(isset($_POST['add'])){

        //check if each variable has a value
        if(empty($_POST['title'])){
            $errors['title'] = 'enter a title';
        }else{
            $title = $_POST['title'];
        }
        if(empty($_POST['author'])){
            $errors['author'] = 'enter author name';
        }else{
            $author = $_POST['author'];
        }
        if(empty($_POST['isbn'])){
            $errors['isbn'] = 'enter book isbn';
        }else{
            $isbn = $_POST['isbn'];
        }
        if(empty($_POST['type'])){
            $errors['type'] = 'select a type';
        }else{
            $type = $_POST['type'];
        }


        if(array_filter($errors)){
            // echo 'errors in form';
        }else{
           
            // escape sql chars
           
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $author = mysqli_real_escape_string($conn, $_POST['author']);
            $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $created_at = date("Y-m-d H:i:s");
            // create sql
            $sql = "INSERT INTO books(title,author,isbn,type,created_at) VALUES('$title','$author','$isbn','$type','$created_at')";

           // save to db and check
                if(mysqli_query($conn, $sql)){
                    // success
                    header('Location: index.php');
                } else {
                    echo 'query error: '. mysqli_error($conn);
                }

        }
    
    }
    
?>

<html>
    <?php require('components/header.php')  ?>

    <div class="container">
        <p>Add a Book!</p>
        <form action="add.php" method="POST">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Book Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="title">
                <p class="alert">
                   <?php echo $errors['title']; ?>
                </p>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Author</label>
                <input type="text" name="author" class="form-control" id="exampleFormControlInput1" placeholder="author">
                <p class="alert">
                   <?php echo $errors['author']; ?>
                </p>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">ISBN</label>
                <input type="number" name="isbn" class="form-control" id="exampleFormControlInput1" placeholder="isbn">
                <p class="alert">
                   <?php echo $errors['isbn']; ?>
                </p>
            </div>
            <select class="form-select" name="type" aria-label="Default select example">
                <option value="" selected>Select Type</option>
                <option value="fiction">Fiction</option>
                <option value="non-fiction">Non-fiction</option>
                <option value="business">Business</option>
            </select>
                <p class="alert">
                   <?php echo $errors['type']; ?>
                </p>        
            <div>
                <input type="submit" name="add" class="btn btn-primary" value="Add Book">
            </div>
            
        </form>

    </div>
   


    <?php require('components/footer.php')  ?>
</html>