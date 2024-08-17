<?php 
include('config/db_connect.php');

// write query for all staffs

$sql = 'SELECT name,phone,email,designation, id FROM staffs ORDER BY joined_at';

// make query & get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$staffs = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);

//explode(',', $staffs[0]['phone']);

?>

<!DOCTYPE html>
<html>
    <?php include ('templates/header.php'); ?>

    <h4 class="center grey-darken-6-text">Our Family</h4>

    <div class="container">
        <div class="row">
            <?php foreach($staffs as $staff): ?>
                <a href="staffDetails.php?id=<?php echo $staff['id'] ?>">
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                    <img src="staffs/<?php echo $staff['id']?>.jpg" onerror="this.src='staffs/default.jpg'" class="pizza";>
                        <div class="card-content center staff-text">
                            <h5><?php echo htmlspecialchars($staff['name']); ?></h5>
                            <ul>
                                <li><h6> <?php echo htmlspecialchars($staff['designation']);?></h6></li>
                                <!-- <li>Phone: <?php echo htmlspecialchars($staff['phone']);?></li>
                                <li>Email: <?php echo htmlspecialchars($staff['email']);?></li> -->
                                
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a href="staffDetails.php?id=<?php echo $staff['id'] ?>"  class="brand-text">More info</a>
                        </div>
                    </div>
                </div>
                </a>
           <?php endforeach; ?>

        </div>
    </div>

    <?php include ('templates/footer.php'); ?>
    
</html>