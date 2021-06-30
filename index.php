<?php
$path= './' . $_GET['path'];
if (isset($_POST['delete'])){
    $filePath = $_POST['delete'];
unlink(($filePath));
}

if (isset($_GET['action']) and $_GET['action'] == 'logout') {
    // session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['logged_in']);
    print('Logged out!');
}
if ($_SESSION['logged_in']){
    header('Location:'.'login.php');
}
// upload
if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    // check extension (and only permit jpegs, jpgs and pngs)
    $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
    $extensions = array("jpeg","jpg","png");
    if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if($file_size > 2097152) {
        $errors[]='File size must be smaller than 2 MB';
    }
    if(empty($errors)==true) {
        move_uploaded_file($file_tmp,'./'.$file_name);
        echo "Success";
    }else{
        print_r($errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple file manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <td> Type</td>
                    <td> Name</td>
                    <td> Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php 
               $path= './' . $_GET['path'];
                $dirContent = scandir($path);
                foreach($dirContent as $pieceOfContent){
                    print('<tr>');
                    print('<td>' . (is_dir($pieceOfContent) ? "Directory" : "File") . '</td>');
                    print('<td>' . (is_dir($path . '/' . $pieceOfContent) ? '<a href="?path=' . $path .'/' .$pieceOfContent .'">' . $pieceOfContent . '</a></td>' :  $pieceOfContent));
                    print('<td>'. (!is_dir($pieceOfContent) ? '<a href="?fileToDelete' .  '">Delete</a>' : '') .'</td>');
                    print('</tr>'); 
                }
                ?>
            </tbody>
        </table>
    </div>
     <footer>
        <form action = "" method = "POST" enctype = "multipart/form-data">
            <input type = "file" name = "image" />
            <input type = "submit"/>
        </form>
        <ul>
            <li>Sent file: <?php echo $_FILES['image']['name'];  ?>
            <li>File size: <?php echo $_FILES['image']['size'];  ?>
            <li>File type: <?php echo $_FILES['image']['type'] ?>
        </ul> 
    <a href="logIn.php">
        <button>Log out </button>
    </a>
     </footer>
    
    
</body>
</html>
