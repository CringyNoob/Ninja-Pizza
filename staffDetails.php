<?php 
include('config/db_connect.php');

if(isset($_POST['delete'])){

    $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

    $sql = "DELETE FROM staffs WHERE id = $id_to_delete";

    if(mysqli_query($conn,$sql)){
        //success
        header('Location: staffs.php');
} {
    echo 'Query Error: ' . mysqli_error($conn);
}
}

// check GET req id param
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT * FROM staffs WHERE id = $id";

// make query & get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$staff = mysqli_fetch_assoc($result);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);
// print_r($staff);
}


?>

<!DOCTYPE html>
<html>
    <?php include ('templates/header.php'); ?>

    <div class="container center staff-text">

        <?php if($staff): ?>

            <img src="staffs/<?php echo $staff['id']?>.jpg" onerror="this.src='staffs/default.jpg'" class="pizza";>
            <h4><?php echo htmlspecialchars($staff['name']); ?></h4>
            <h5><?php echo htmlspecialchars($staff['designation']) ?></h5>
            <p>Email: <?php echo htmlspecialchars($staff['email']) ?></p>
            <p>Phone:<?php echo htmlspecialchars($staff['phone']) ?></p>
            <p>Joined at: <?php echo date($staff['joined_at']) ?></p>

            <?php if($staff['id']!=1){?>
            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $staff['id']; ?>">
                <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
            </form>
                <?php } ?>
        <?php else: ?>
            <h5>No such staff exists!</h5>
        <?php endif; ?>

    </div>

    <?php include ('templates/footer.php'); ?>
    
</html>