<?php 
include('config/db_connect.php');

// write query for all pizzas

$sql = 'SELECT title,ingredients, id FROM pizzas ORDER BY created_at';

// make query & get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);

//explode(',', $pizzas[0]['ingredients']);

?>

<!DOCTYPE html>
<html>
    <?php include ('templates/header.php'); ?>

    <h4 class="center grey-text">Pizzas!</h4>

    <div class="container">
        <div class="row">
            <?php foreach($pizzas as $pizza): ?>
                <a href="details.php?id=<?php echo $pizza['id'] ?>">
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                    <img src="pizzas/<?php echo $pizza['id']?>.jpg" onerror="this.src='pizzas/default.jpg'" class="pizza";>
                    <!-- <img src="<?php echo $pizza['image_path']; ?>" alt="<?php echo $pizza['name']; ?>" class="pizza"> -->
                        <div class="card-content center staff-text">
                            <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                            <ul>
                                <?php foreach (explode(',', $pizza['ingredients']) as $ing) : ?>
                                    <li><?php echo htmlspecialchars($ing); ?></li>
                                    
                              <?php  endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">More info</a>
                        </div>
                    </div>
                </div>
                </a>
           <?php endforeach; ?>

        </div>
    </div>

    <?php include ('templates/footer.php'); ?>
    
</html>