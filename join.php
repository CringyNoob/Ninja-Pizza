<?php 
    
    include("config/db_connect.php");

    $errors = array('email' => '', 'name' => '', 'phone' => '', 'designation' => '');

    if(isset($_POST['submit'])){

        
    //  check email
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required <br/>';
        }   else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email must be a valid email address'. '<br/>';
            }
    }
    // Check name
        if(empty($_POST['name'])){
            $errors['name'] = 'A name is required <br/>';
        } else{
            $name = $_POST['name'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
                $errors['name'] = 'name must be letter and spaces only' . '<br />';
            }
    }
    // Check phone
        if(empty($_POST['phone'])){
            $errors['phone'] = 'A phone number is required';
        } else{
            $phone = $_POST['phone'];
            if(!preg_match('/^[0-9\s]+$/', $phone)){
                $errors['phone'] = 'Phone must be only numbers';
    }

    //Check Designation
        if(empty($_POST['designation'])){
            $errors['designation'] = 'A designation is required <br/>';
        } else{
            $designation = $_POST['designation'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $designation)){
                $errors['designation'] = 'Designation must be letter and spaces only' . '<br />';
            }
    }
    
} 

if(array_filter($errors)){
    // echo 'errors in the form';
}else{

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);



    // create sql
    $sql = "INSERT INTO staffs(name,email,phone,designation) VALUES('$name' , '$email', '$phone' ,'$designation')" ;

    //save to dbv and check

    if(mysqli_query($conn, $sql)){
       //success
       header('location: staffs.php'); 
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
        <h4 class="center">Staff joining Form</h4>
        <form class="white" action="join.php" method="POST">

            <label for="">Full name:</label>
            <input type="text" name="name">
            <div class="red-text"><?php echo $errors['name']; ?></div>

            <label for="">Email:</label>
            <input type="text" name="email">
            <div class="red-text"><?php echo $errors['email']; ?></div>

            <label for="">Phone:</label>
            <input type="text" name="phone">
            <div class="red-text"><?php echo $errors['phone']; ?></div>

            <label for="">Designation:</label>
            <input type="text" name="designation">
            <div class="red-text"><?php echo $errors['designation']; ?></div>

            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include ('templates/footer.php'); ?>
    
</html>