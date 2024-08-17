<?php 
    
    include("config/db_connect.php");

    $errors = array('email' => '', 'title' => '', 'ingredients' => '');

    if(isset($_POST['submit'])){

        
        //check email
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required <br/>';
        }   else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email must be a valid email address'. '<br/>';
            }
        //     else{
        //         echo htmlspecialchars($_POST['email']) . '<br/>';
        // }
    }
        if(empty($_POST['title'])){
            $errors['title'] = 'A title is required <br/>';
        } else{
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors['title'] = 'Title must be letter and spaces only' . '<br />';
            } 
        //     else{
        //     echo htmlspecialchars($_POST['title']). '<br/>';
        // }
    }
        if(empty($_POST['ingredients'])){
            $errors['ingredients'] = 'At least one ingredient is required';
        } else{
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients'] = 'Ingredients must be a comma separated list';
    }
//      else{
// }
    
} 

if(array_filter($errors)){
    // echo 'errors in the form';
}else{

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
    // create sql
    $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title' , '$email', '$ingredients')" ;

    //save to dbv and check

    if(mysqli_query($conn, $sql)){
       //success
       header('location: pizzas.php'); 
    } else{
        //error
        echo 'query error: ' . mysqli_error($conn);
    } 

    // echo'form is valid';}
    
}

}// end of post check



?>

<!DOCTYPE html>
<html>
    <?php include ('templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form class="white" action="add.php" method="POST">
            <label for="">Your Email:</label>
            <input type="text" name="email">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label for="">Pizza Title:</label>
            <input type="text" name="title">
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label for="">Ingredients (comma separated):</label>
            <input type="text" name="ingredients">
            <!-- <input type="file" name="pizza_image" accept="image/*"> -->
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include ('templates/footer.php'); ?>
    
</html>