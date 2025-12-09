<?php
// session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$con = mysqli_connect("localhost","root","","formdata");
if(!$con){
     die("Connection Failed: ".mysqli_connect_error());
    }

//delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($con,"delete from userdatabase  where id='$id'");
    header("Location: index.php");
    exit;
}

// form validation
$errors = [];

function clean($val){

       $val=trim($val);
       $val=stripslashes($val);
       $val=htmlspecialchars($val);                                           
    return ($val); 
}

if(isset($_POST['save']) ){

    $id = $_POST['edit_id'];  

    $name     = clean($_POST['name']);
    $surname  = clean($_POST['surname']);
    $dob      = clean($_POST['dob']);
    $email    = clean($_POST['email']);
    $password = clean($_POST['password']);
    $address  = clean($_POST['address']);
    $website  = clean($_POST['website']);
    $comment  = clean($_POST['comment']);
    $phone    = clean($_POST['phone']);
    $gender   = clean($_POST['gender']);

    // required check
    if($name==""){
        $errors['name']="Name is required";
        // if(!preg_match("/^[a-zA-Z ]+$/",$name)){
        //  $errors['name']="invalid  name";
        // }
    }

    if($surname==""){
        $errors['surname']="Surname is required";
        // if(!preg_match("/^[a-zA-Z ]+$/",$surname)){
        //  $errors['surname']="invalid  surname";
        // }
    }
    if($email==""){
        $errors['email']="Email is required";
    //    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    //      $errors['email']="Invalid email";
    //     }

    }
    if($phone=="")     {
        $errors['phone']="Phone is required";
        //  if(!preg_match("/^[0-9]{10}$/",$phone)){
        //  $errors['phone']="Phone invalid num ber";
        // }

    }
    if($gender=="")    {
        $errors['gender']="Gender is required";
    }
    if($password=="")  {
        $errors['password']="Password is required";
    }

     
    if(!preg_match("/^[a-zA-Z ]+$/",$name)){
         $errors['name']="invalid  name";
        }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
         $errors['email']="Invalid email";
        }
    if(!preg_match("/^[0-9]{10}$/",$phone)){
         $errors['phone']="Phone invalid num ber";
        }

    /* if errors → stop and go back to form */
    if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST; //first time dala huva galat  data which is wrong ye store hoga dobara dikane ke liye 
        header("Location: form.php");
        exit;
    }

    //image upload
    $old_img = $_POST['old_image'];//v user ki purani files aayegi 
    $file_name = $_FILES['image']['name']; // new file upload hone ke liye

    if($file_name != ""){
        $folder = "uploadimage/".$file_name;
        $temp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($temp_name,$folder);
         
    } else {
        $folder = $old_img; // old image
    }

     
    if($id==""){ 
        // insert ho tahi jab add se form.php se ata hai tab kyuki vaha id nahi hai action me php.form ka path diya huva hai or first time form bharte time bhi yahi query chalegi kyoki vaha id nahi hoti
        $q = "insert into userdatabase (name,picstore,surname,dob,email,
        password,address,website,comment,phone,gender
        )values('$name','$folder','$surname','$dob','$email',
        '$password','$address','$website','$comment','$phone','$gender')";
    }
    else {
        // update 
        $q = "update userdatabase set 
        name='$name', picstore='$folder', surname='$surname', dob='$dob',
        email='$email', password='$password', address='$address', website='$website',
        comment='$comment', phone='$phone', gender='$gender'
        where id='$id'";
    }

    mysqli_query($con,$q);

    header("Location: index.php");
    exit;

}
?>
