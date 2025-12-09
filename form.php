<?php
session_start();
include "helper.php";

//old value for update
$name = $surname = $dob = $email = $password = "";
$address = $website = $comment = $phone = $gender = "";
$old_image = "";
$id = "";

// if update button cliked 
if(isset($_POST['update_id'])){

    $id = $_POST['update_id'];

    $_SESSION['edit_id'] = $id;  // store in session

    $q = mysqli_query($con,"SELECT * FROM userdatabase WHERE id='$id'");
    $data = mysqli_fetch_assoc($q);

    $name     = $data['name'];
    $surname  = $data['surname'];
    $dob      = $data['dob'];
    $email    = $data['email'];
    $password = $data['password'];
    $address  = $data['address'];
    $website  = $data['website'];
    $comment  = $data['comment'];
    $phone    = $data['phone'];
    $gender   = $data['gender'];
    $old_image = $data['picstore'];
}

/* For validation errors */
$errors = $_SESSION['errors'] ?? [];    

// if (isset($_SESSION['errors'])) {
//     $errors = $_SESSION['errors'];
// } else {
//     $errors = [];
// }


$old = $_SESSION['old'] ?? [];


// if (isset($_SESSION['old'])) {
//     $old = $_SESSION['old'];
// } else {
//     $old = [];
// }


unset($_SESSION['errors']);
unset($_SESSION['old']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Form</title>
<style>.error{color:red;}</style>
</head>
<body>

<form action="helper.php" method="post" enctype="multipart/form-data">

    <input type="hidden" name="edit_id" value="<?= $_SESSION['edit_id'] ?? "" ?>">
    
    <input type="hidden" name="old_image" value="<?= $old_image ?>">

    Name:  
    <input type="text" name="name" value="<?= $old['name'] ?? $name ?>">
    <span class="error"><?= $errors['name'] ?? '' ?></span>
    <br><br>

    Surname:  
    <input type="text" name="surname" value="<?= $old['surname'] ?? $surname ?>">
    <span class="error"><?= $errors['surname'] ?? '' ?></span>
    <br><br>

DOB:  
<input type="date" name="dob" value="<?= $old['dob'] ?? $dob ?>">
<br><br>

Email:  
<input type="text" name="email" value="<?= $old['email'] ?? $email ?>">
<span class="error"><?= $errors['email'] ?? '' ?></span>
<br><br>

Password:  
<input type="text" name="password" value="<?= $old['password'] ?? $password ?>">
<span class="error"><?= $errors['password'] ?? '' ?></span>
<br><br>

Address:  
<textarea name="address"><?= $old['address'] ?? $address ?></textarea>
<br><br>

Website:  
<input type="text" name="website" value="<?= $old['website'] ?? $website ?>">
<br><br>

Comment:  
<textarea name="comment"><?= $old['comment'] ?? $comment ?></textarea>
<br><br>

Phone:  
<input type="text" name="phone" value="<?= $old['phone'] ?? $phone ?>">
<span class="error"><?= $errors['phone'] ?? '' ?></span>
<br><br>

Gender:
<input type="radio" name="gender" value="male"   <?= ($gender=="male")?"checked":"" ?>> Male
<input type="radio" name="gender" value="female" <?= ($gender=="female")?"checked":"" ?>> Female
<input type="radio" name="gender" value="other"  <?= ($gender=="other")?"checked":"" ?>> Other
<span class="error"><?= $errors['gender'] ?? '' ?></span>
<br><br>

Image:
<input type="file" name="image">
<?= $old_image ?>
<br><br>

<input type="submit" name="save" value="Save">

</form>

</body>
</html>










