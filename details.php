<?php 

include('config/connect_db.php');

//delete function
if(isset($_POST['submit'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    //delete query
    $sql = "DELETE FROM books WHERE id = $id_to_delete";

    //if success
    if(mysqli_query($conn, $sql)){
        header('Location: index.php');
    } else {
        echo 'query error: '. mysqli_error($conn);
    }

}


//check get request id parameter
if(isset($_GET['id'])){

    // escape sql chars
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql
    $sql = "SELECT * FROM books WHERE id = $id";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $book = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);


}
?>
<html>

<?php require('components/header.php')  ?>
    <div class="card">
    <div class="card-header">
        <?php echo $book['title'] ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"> <?php echo $book['author'] ?></h5>
        <p class="card-text"> ISBN: <?php echo $book['isbn'] ?></p>
        <p class="card-text"> <?php echo $book['type'] ?></p>
        <form action="details.php" method="POST">
                <input type="hidden" value="<?php echo $book['id'] ?>" name="id_to_delete">
                <input type="submit" value="Delete" name="submit" class="btn btn-secondary">
        </form>

    </div>
    </div>
<?php require('components/footer.php')  ?>
</html>