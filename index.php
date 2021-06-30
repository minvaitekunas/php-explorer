<?php
if ($_SESSION['logged_in']){
    header('Location:'.'login.php');
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
                // delete
               // unlink(('./' . $_GET['path'] . $_GET['fileToDelete']);
               // org path $path= './' . $_GET['path'];
             // $path= (substr('./' . $_GET['path'], 0,2))== ".//" ? . $_GET['path'] :'./' . $_GET['path'])  ;
               $path= './' . $_GET['path'];
              // var_dump($path);
                $dirContent = scandir($path);
                
                foreach($dirContent as $pieceOfContent){
                  

                    print('<tr>');
                    print('<td>' . (is_dir($pieceOfContent) ? "Directory" : "File") . '</td>');
                    print('<td>' . (is_dir($path . '/' . $pieceOfContent) ? '<a href="?path=' . $path . '/' .$pieceOfContent .'">' . $pieceOfContent . '</a></td>' :  $pieceOfContent));
                    print('<td>'. (!is_dir($pieceOfContent) ? '<a href="?delete' . $pieceOfContent . '">Delete</a>' : '') .'</td>');
                    print('</tr>'); 
                    //var_dump('<span>'. $path . '</span>');
                  //  var_dump($path);

                }
                ?>
               
            </tbody>
        </table>
    </div>
    
    
</body>
</html>
