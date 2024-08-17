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
<?php include('templates/header.php'); ?>

<h4 class="center" style="color:tomato;">Welcome to the Ninja Pizza!</h4>

<!-- <div class="container">
        <div class="row">
            <?php foreach ($pizzas as $pizza) : ?>

                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                            <ul>
                                <?php foreach (explode(',', $pizza['ingredients']) as $ing) : ?>
                                    <li><?php echo htmlspecialchars($ing); ?></li>
                                    
                              <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">More info</a>
                        </div>
                    </div>
                </div>

           <?php endforeach; ?>

        </div>
    </div> -->
    <a href="pizzas.php">
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-content">
                <h5 class="brand-text">Pizzas</h5>
            </div>
            <div class="card-action center">
            <picture>
  <img src="pizza.jpg" alt="pizza_img" style="width:800px;">
</picture>
            </div>
            <div class="card-action right-align">
                <a href="pizzas.php" class="brand-text">More info</a>
            </div>
        </div>
    </div> 
</div></a>


    <a href="staffs.php">
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-content">
                <h5 class="brand-text">Our Family</h5>
            </div>
            <div class="card-action center">
            <picture>
  <img src="staffs_img.jpeg" alt="staff" style="width: 800px">
</picture>
            </div>
            <div class="card-action right-align">
                <a href="pizzas.php" class="brand-text">More info</a>
            </div>
        </div>
    </div> 
</div></a>

<?php include('templates/footer.php'); ?>

</>