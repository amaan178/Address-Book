<?php
include_once 'includes/functions.inc.php';
/**
 * The below if..else is used to load the page by fetching the id and finding the resource
 * If the resources is found we continue the page load and fill all the required textfields with their values
 * If the resource is not found we are dumping the errors
 */
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $query = "SELECT * FROM contacts where id = $id";
    $rows = db_select($query);
    if(count($rows) === 0)
    {
        dd("Cannot find resource having id : {$id}");
        //Instead of dd() you should redirect to 404 page
    }
    $row = db_select($query);
}
else if(isset($_POST['submit']))
{
    $id = sanitizeData($_POST['id']);

    //Verify the id you got exists
    $query = "SELECT * FROM contacts WHERE id = $id";
    $rows = db_select($query);
    if(count($rows) === 0)
    {
        dd("Cannot find resource having id : {$id}");
        //Instead of dd() you could redirect at 404
    }

    $row = db_select($query)[0];

    $first_name = sanitizeData($_POST['first_name']);
    $last_name = sanitizeData($_POST['last_name']);
    $email = sanitizeData($_POST['email']);
    $birthdate = sanitizeData($_POST['birthdate']);
    //convert the incoming string to date
    $birthdate = date('Y-m-d',strtotime($birthdate));
    $telephone = sanitizeData($_POST['telephone']);
    $address = sanitizeData($_POST['address']);

    $image_name = strtolower($first_name . "-" . $last_name);

    $image_path = "images/users/";
    $is_image_updated = false;

    //Uploading Image
    if($_FILES['pic']['name'])
    {
        $is_image_updated = true;
        $file_name = $_FILES['pic']['name'];
        $tmp_file_location = $_FILES['pic']['tmp_name'];

        // $type = $_FILES['pic']['type'];
        // $file_size = $_FILES['pic']['size'];
        
        //Extracting the extension
        $temp = explode('.' , $file_name);
        $extension = strtolower(end($temp));
        
        $image_name .= "." . $extension;

        // move_uploaded_file(source_path,destination_path)
        $full_image_name_width_path = $image_path.$image_name;
        move_uploaded_file($tmp_file_location,$full_image_name_width_path);
        
    }
    /*
            * There is twist
            * Either the image is updated OR name is update OR nothing is updated
            * Now if only image is updated then we can directly create or link the new image, which we already did
            * If only name is updated then we need to rename the file as well as update the image_name attribute in database
            * If both image and name has been updated then we need to link the new file with new name, update image_name in the database and delete the old image file from the physical device
    */

    $old_first_name = strtolower($row['first_name']);
    $old_last_name = strtolower($row['last_name']);

    $old_full_name = $old_first_name . " " . $old_last_name;
    $current_full_name = strtolower($first_name) . " " . strtolower($last_name);

    $old_image_name = $row['image_name'];
    $old_extension = end(explode(".", $old_image_name));
    if($old_full_name == $current_full_name)
    {
        //no issue as new image if given is already overwritten
    }
    else
    {
        if($is_image_updated)
        {
            unlink($image_path . $old_image_name);
        }
        else
        {
            $old_file = $image_path . $old_image_name;
            $image_name = $image_name . "." .$old_extension;
            $new_file = $image_path . $image_name;
            rename($old_file, $new_file);
        }
    }

    //Update all the information in the database
    $query = "UPDATE contacts SET first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}', birthdate = '{$birthdate}', telephone = '{$telephone}', address = '{$address}' , image_name = '{$image_name}' WHERE id = {$id}";

    $result = db_query($query);

    if(!$result)
    {
        dd(db_error());
    }
    else
    {
        header("Location: index.php?q=success&op=edit");
    }
}


else
{
    dd('You cannot access this page!');
}

?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <!--Import Csutom CSS-->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Add Contact</title>
</head>

<body>
    <!--NAVIGATION BAR-->
    <nav>
        <div class="nav-wrapper">
            <!-- Dropdown Structure -->
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="#!">Profile</a></li>
                <li><a href="#!">Signout</a></li>
            </ul>
            <nav>
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo center">Contact Info</a>
                    <ul class="right hide-on-med-and-down">

                        <!-- Dropdown Trigger -->
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i
                                    class="material-icons right">more_vert</i></a></li>
                    </ul>
                </div>
            </nav>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <!--/NAVIGATION BAR-->
    <div class="container">
        <div class="row mt50">
            <h2>Add New Contact</h2>
        </div>
        <div class="row">
            <form class="col s12 formValidate" action="<?=$_SERVER['PHP_SELF'];?>" id="edit-contact-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="contact_id" value="<?= $row[0]['id'];?>" readonly>
                <div class="row mb10">
                    <div class="input-field col s6">
                        <input id="first_name" name="first_name" type="text" class="validate" data-error=".first_name_error" value=<?=$row[0]['first_name'];?>>
                        <label for="first_name">First Name</label>
                        <div class="first_name_error "></div>
                    </div>
                    <div class="input-field col s6">
                        <input id="last_name" name="last_name" type="text" class="validate" data-error=".last_name_error" value=<?=$row[0]['last_name'];?>>
                        <label for="last_name">Last Name</label>
                        <div class="last_name_error "></div>
                    </div>
                </div>
                <div class="row mb10">
                    <div class="input-field col s6">
                        <input id="email" name="email" type="email" class="validate" data-error=".email_error" value=<?=$row[0]['email'];?>>
                        <label for="email">Email</label>
                        <div class="email_error "></div>
                    </div>
                    <div class="input-field col s6">
                        <input id="birthdate" name="birthdate" type="text" class="datepicker" data-error=".birthday_error" value=<?=$row[0]['birthdate'];?>>
                        <label for="birthdate">Birthdate</label>
                        <div class="birthday_error "></div>
                    </div>
                </div>
                <div class="row mb10">
                    <div class="input-field col s12">
                        <input id="telephone" name="telephone" type="tel" class="validate" data-error=".telephone_error" value=<?=$row[0]['telephone'];?>>
                        <label for="telephone">Telephone</label>
                        <div class="telephone_error "></div>
                    </div>
                </div>
                <div class="row mb10">
                    <div class="input-field col s12">
                        <textarea id="address" name="address" class="materialize-textarea" data-error=".address_error"><?=$row[0]['address'];?></textarea>
                        <label for="address">Addess</label>
                        <div class="address_error "></div>
                    </div>
                </div>
                <div class="row mb10">
                    <div class="col s2">
                        <img id="temp_pic" src="images/users/<?= $row[0]['image_name'];?>" alt="User Image" width="100%">
                    </div>
                    <div class="file-field input-field col s10">
                        <div class="btn">
                            <span>Image</span>
                            <input type="file" name="pic" id="pic" data-error=".pic_error">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload Your Image">
                        </div>
                        <div class="pic_error "></div>
                    </div>
                </div>
                <button class="btn waves-effect waves-light right" type="submit" name="submit">Submit
                        <i class="material-icons right">send</i>
                    </button>
            </form>
        </div>
    </div>
    <footer class="page-footer p0">
        <div class="footer-copyright ">
            <div class="container">
                <p class="center-align">©️ 2020 Study Link Classes</p>
            </div>
        </div>
    </footer>
    <!--JQuery Library-->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--JQuery Validation Plugin-->
    <script src="vendors/jquery-validation/validation.min.js" type="text/javascript"></script>
    <script src="vendors/jquery-validation/additional-methods.min.js" type="text/javascript"></script>
    <!--Include Page Level Scripts-->
    <script src="js/pages/edit-contact.js"></script>
    <!--Custom JS-->
    <script src="js/custom.js" type="text/javascript"></script>

    <script>
        $("#birthdate").datepicker({
            defaultDate : new Date('<?= $row[0]['birthdate'];?>'),
            setDefaultDate: true
        });
    </script>
</body>

</html>