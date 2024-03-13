<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>form</title>
</head>
<body>

<div id="form-main">
  <div id="form-div">
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <p class="name">
            <input class="form-control" name="title" type="text" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Name" id="title" />
        </p>
        
        <p class="text">
            <textarea class="form-control" name="comment" class="validate[required,length[6,300]] feedback-input" id="comment" placeholder="Comment"></textarea>
        </p>
        เลือกรูปภาพ: <input class="form-control" type="file" name="image" id="image" >
        <img id="previreImg" class="img fluid rounded">
        <input type="submit" id="send" value="ส่งรูปภาพ" class="btn btn-success">
    </form>
  </div>
  <script>
    let imgInput = document.querySelector("#image");
    let previreImg = document.querySelector("#previreImg");
    
    imgInput.onchange = evt => {
        const [file] = imgInput.files;
        if(file){
            previreImg.src = URL.createObjectURL(file);
        }
    }
  </script>
  <script src="sweetalert.min.js"></script>
<?php 
if(isset($_SESSION['response']) && $_SESSION['response'] !='')
{
    ?>
    <script>
        swal({
            title: "สำเร็จ",
            text: "ส่งข้อความเรียบร้อย",
            icon: "success",
        });
    </script>
    <?php
    unset($_SESSION['response']);

}
?>
</body>
</html>