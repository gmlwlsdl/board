<?php
    session_start();
    require("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $num=$_GET['num'];
    $writer=$_GET['writer'];
    $pw=$_GET['pw'];
    $idx=$_GET['idx'];
    $name=$_GET['name'];

    if(!empty($num && $writer && $pw)){
        $sql="SELECT * FROM post WHERE num='$num'&&writer='$writer' ";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
            if($row['wr_pw']==$pw){
                $sql2="DELETE FROM post WHERE num='$num' ";
                $result=mysqli_query($conn, $sql2);
                echo '<script type="text/javascript">'; 
                echo 'alert("글이 삭제되었습니다.");';
                echo 'window.location.href = "home.php";';
                echo '</script>';
            }
            else{
                echo '<script type="text/javascript">'; 
                echo 'alert("비밀번호가 틀렸습니다.");';
                echo 'window.location.href = "postList.php";';
                echo '</script>';}
    }
    else if(!empty($idx && $name && $pw)){
        $sql="SELECT * FROM reply WHERE idx='$idx'&&name='$name' ";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
            if($row['pw']==$pw){
                $sql2="DELETE FROM reply WHERE idx='$idx' ";
                $result=mysqli_query($conn, $sql2);
                echo '<script type="text/javascript">'; 
                echo 'alert("글이 삭제되었습니다.");';
                echo 'window.location.href = "home.php";';
                echo '</script>';
            }
            else{
                echo '<script type="text/javascript">'; 
                echo 'alert("비밀번호가 틀렸습니다.");';
                echo 'window.location.href = "postList.php";';
                echo '</script>';}
    }
    ?>
</body>
</html>