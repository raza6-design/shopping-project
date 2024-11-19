<?php
// include header file
include 'header.php'; ?>
<div class="admin-content-container">
    <h2 class="admin-heading">Options</h2>
    <?php
    error_reporting(E_ERROR | E_PARSE);
     $db_host = "localhost"; 
     $db_user = "root";       
     $db_pass = "";   
     $db_name = "shopping_db"; 
  $conn = mysqli_connect( $db_host, $db_user,$db_pass, $db_name);
  if(!$conn){
    die("Connection Failed:" . mysqli_connect_error());
  }
// echo "Connected Successfully";

  $sql = "SELECT * FROM options";

  $result = mysqli_query($conn, $sql) or die("Query Failed.");
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) { ?>
            <form  action="update_options.php"  method="post" enctype="multipart/form-data" >
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Name</label>
                        <input type="text" class="form-control site_name" name="site_name"
                               value="<?php echo $row['site_name']; ?>" placeholder="Site Name"/>
                        <input type="hidden" name="s_no" value="<?php echo $row['s_no']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="">Site Title</label>
                        <input type="text" class="form-control site_title" name="site_title"
                               value="<?php echo $row['site_title']; ?>" placeholder="Site Title"/>
                    </div>
                    <div class="form-group">
                        <label>Site Description</label>
                        <textarea name="site_desc" class="form-control site_desc" cols="30" rows="3"><?php echo $row['site_desc']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Contact Email</label>
                        <input type="email" class="form-control email" name="contact_email" value="<?php echo $row['contact_email']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Contact Phone Number</label>
                        <input type="text" class="form-control phone" name="contact_phone" value="<?php echo $row['contact_phone']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Logo</label>
                        <input type="file" class="new_logo" name="new_logo" />
                        <input type="hidden" class="old_logo" name="old_logo" value="<?php echo $row['site_logo']; ?>">
                        <img id="image" src="images/<?php echo $row['site_logo']; ?>" alt="" width="100px"/>
                    </div>
                    <div class="form-group">
                        <label for="">Footer Text</label>
                        <input type="text" class="form-control footer_text" name="footer_text" value="<?php echo $row['footer_text']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Currency Format</label>
                        <input type="text" class="form-control currency" name="currency_format" value="<?php echo $row['currency_format']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Contact Address</label>
                        <textarea name="contact_address" class="form-control address" cols="30" rows="3"><?php echo $row['contact_address']; ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" class="btn add-new" name="submit" value="Update">
                    </div>
                </div>
            </form>
        <?php
        }
    }
mysqli_close($conn);
    ?>
</div>
<?php
//    include footer file
    include "footer.php";
?>