<?php 
include('config/db_connect.php');

if(isset($_POST['delete'])){

    $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if(mysqli_query($conn,$sql)){
        //success
        header('Location: pizzas.php');
} {
    echo 'Query Error: ' . mysqli_error($conn);
}
}

// check GET req id param
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT * FROM pizzas WHERE id = $id";

// make query & get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$pizza = mysqli_fetch_assoc($result);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);
// print_r($pizza);
}


?>

<!DOCTYPE html>
<html>
    <?php include ('templates/header.php'); ?>

    <div class="container center">

        <?php if($pizza): ?>
            
            <img src="pizzas/<?php echo $pizza['id']?>.jpg" onerror="this.src='pizzas/default.jpg'" class="pizza";>
            <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
            <p>Created By: <?php echo htmlspecialchars($pizza['email']) ?></p>
            <p><?php echo date($pizza['created_at']) ?></p>
            <h5>Ingredients:</h5>
            <p><?php echo htmlspecialchars($pizza['ingredients']) ?></p>

            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
                <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
            </form>
            
        <?php else: ?>
            <h5>No such pizza exists!</h5>
        <?php endif; ?>


       

    </div>

    <?php include ('templates/footer.php'); ?>
    
</html>