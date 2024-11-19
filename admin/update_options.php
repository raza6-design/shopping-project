<?php 
    // error_reporting(E_ERROR | E_PARSE);
    $db_host = "localhost"; 
    $db_user = "root";       
    $db_pass = "";   
    $db_name = "shopping_db"; 
 $conn = mysqli_connect( $db_host, $db_user,$db_pass, $db_name);
 if(!$conn){
   die("Connection Failed:" . mysqli_connect_error());
 }

    
if(empty($_FILES['new_logo']['name'])){
    $file_name = $_POST['old_logo'];
  }else{
    $errors = array();
  
    $file_name = $_FILES['new_logo']['name'];
    $file_size = $_FILES['new_logo']['size'];
    $file_tmp = $_FILES['new_logo']['tmp_name'];
    $file_type = $_FILES['new_logo']['type'];
    $exp = explode('.',$file_name);
    $file_ext = end($exp);
  
    $extensions = array("jpeg","jpg","png");
  
    if(in_array($file_ext,$extensions) === false)
    {
      $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
    }
  
    if($file_size > 2097152){
      $errors[] = "File size must be 2mb or lower.";
    }

    if(empty($errors) == true){
      move_uploaded_file($file_tmp,"images/".$file_name);
    }else{
      print_r($errors);
      die();
    }
  }
  
  $sql = "UPDATE options SET site_name='{$_POST["site_name"]}',site_title='{$_POST["site_title"]}',site_desc='{$_POST["site_desc"]}',contact_email='{$_POST["contact_email"]}',contact_phone='{$_POST["contact_phone"]}',site_logo='{$file_name}',footer_text='{$_POST["footer_text"]}',currency_format='{$_POST["currency_format"]}',contact_address='{$_POST["contact_address"]}'
     WHERE s_no ={$_POST["s_no"]};";
     
$result = mysqli_multi_query($conn,$sql);
  if($result){
    header("location: options.php");
  }else{
    echo "Query Failed";
  }
mysqli_close($conn);

?> 