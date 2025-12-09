<?php
session_start();
include "helper.php";

//old value for update
$name = $surname = $dob = $email = $password = "";
$address = $website = $comment = $phone = $gender = "";
$old_image = "";
$id = "";



if(isset($_SESSION['edit_id'])){
    $edit_id = $_SESSION['edit_id'];
} else {
    $edit_id = "";
}


if(isset($_SESSION['old'])){
    $name = $_SESSION['old']['name'];
}else{
    $name = "";
}
if(isset($_SESSION['old'])){
    $surname = $_SESSION['old']['surname'];
}else{
    $name = "";
}
if(isset($_SESSION['old'])){
    $dob = $_SESSION['old']['dob'];
}else{
    $dob = "";
}
if(isset($_SESSION['old'])){
    $email = $_SESSION['old']['email'];
}else{
    $email = "";
}
if(isset($_SESSION['old'])){
    $password = $_SESSION['old']['password'];
}else{
    $password = "";
}
if(isset($_SESSION['old'])){
    $address = $_SESSION['old']['address'];
}else{
    $address = "";
}

if(isset($_SESSION['old'])){
    $website = $_SESSION['old']['website'];
}else{
    $website = "";
}

if(isset($_SESSION['old'])){
    $comment = $_SESSION['old']['comment'];
}else{
    $comment = "";
}
if(isset($_SESSION['old'])){
    $phone = $_SESSION['old']['phone'];
}else{
    $phone = "";
}
if(isset($_SESSION['old'])){
    $gender = $_SESSION['old']['gender'];
}else{
    $gender = "";
}       


// for validation errors
 
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
} else {
    $errors = [];
}
if (isset($_SESSION['old'])) {
    $old = $_SESSION['old'];
} else {
    $old = [];
}

if(isset($_POST['update_id'])){

    $id = $_POST['update_id'];

    $_SESSION['edit_id'] = $id; 



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

    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
    
    <input type="hidden" name="old_image" value="<?= $old_image ?>">

    Name:  
    <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error"><?= $errors['name'] ?? '' ?></span>
    <br><br>

    Surname:  
    <input type="text" name="surname" value="<?php echo $surname;?>">
    <span class="error"><?= $errors['surname'] ?? '' ?></span>
    <br><br>

DOB:  
<input type="date" name="dob" value="<?php echo $dob; ?>">
<br><br>

Email:  
<input type="text" name="email" value="<?php echo $email; ?>">
<span class="error"><?= $errors['email'] ?? '' ?></span>
<br><br>

Password:  
<input type="text" name="password" value="<?php echo $password; ?>">
<span class="error"><?= $errors['password'] ?? '' ?></span>
<br><br>

Address:  
<textarea name="address"><?php echo $address; ?></textarea>
<br><br>

Website:  
<input type="text" name="website" value="<?php echo $website; ?>">
<br><br>

Comment:  
<textarea name="comment"><?php echo $comment; ?></textarea>
<br><br>

Phone:  
<input type="text" name="phone" value="<?php echo $phone; ?>">
<span class="error"><?= $errors['phone'] ?? '' ?></span>
<br><br>

Gender:
<input type="radio" name="gender" value="male"   <?php echo ($gender=="male")?"checked":"" ?>> Male
<input type="radio" name="gender" value="female" <?php echo ($gender=="female")?"checked":"" ?>> Female
<input type="radio" name="gender" value="other"  <?php echo ($gender=="other")?"checked":"" ?>> Other
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










