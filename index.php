<?php
    
require('config/connect_db.php');

 //write query for all pizzas
 $sql = 'SELECT title,id,author,isbn,type FROM books ORDER BY created_at';

 //make query and get result
 $result = mysqli_query($conn, $sql);

 //get pizzas array
 $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

 // free the $result from memory (good practise)
 mysqli_free_result($result);

 // close connection
 mysqli_close($conn);


?>

<html>

<?php require('components/header.php')  ?>
    <h1>My Books</h1>
<div class="main">
    
        <?php foreach($books as $book):  ?>
            <div class="card" style="width: 30rem;">
            <div class="card-body">
        <h5 class="card-title"><?php echo $book['title']  ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo $book['author']  ?></h6>
        <p class="card-text"><?php echo $book['isbn']  ?></p>
        <p class="card-text"><?php echo $book['type']  ?></p>
        <a href="details.php?id=<?php echo $book['id']; ?>" class="card-link">More info</a>
        </div>
    </div>
        <?php endforeach  ?>
 
</div>


<?php require('components/footer.php')  ?>
</html>