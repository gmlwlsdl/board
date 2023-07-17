<?php 
session_start();
require_once("db.php");

$id=$_GET['id'];
$pw=$_GET['pw'];
$contents=$_GET['contents'];
$post_num=$_GET['post_num'];
$count=1;
$_SESSION['reply_count']=$count;
$title=$_GET['title'];

$sql="SELECT * FROM account_table WHERE id='$id' AND pw='$pw' ";
$result=mysqli_query($conn, $sql);

if(mysqli_num_rows($result)==1){
    $row=mysqli_fetch_assoc($result);

    if($row['id']==$id&&$row['pw']==$pw){
        $name=$row['name'];
        
        date_default_timezone_set('Asia/Seoul');
        $date=date('Y-m-d H:i:s');

        $sql4="INSERT INTO reply(idx, post_num, name, pw, content, date) 
            VALUES('$count', '$post_num', '$name', '$pw', '$contents', '$date') ";
        $result=mysqli_query($conn, $sql4);

        $_SESSION['reply_ID']=$row['id'];
        $_SESSION['reply_PW']=$row['pw'];
        $_SESSION['reply_Name']=$row['name'];
        $count++;
        echo '<script type="text/javascript">'; 
        echo 'alert("댓글 등록 성공");';
        echo 'window.location.href = "read.php?title='.$title.'";';
        echo '</script>';
    }
    else{
        echo '<script type="text/javascript">'; 
        echo 'alert("댓글 등록 실패");';
        echo 'window.location.href = "read.php?title='.$title.' ";';
        echo '</script>';
    }
}
else{
    echo '<script type="text/javascript">'; 
        echo 'alert("존재하지 않는 계정입니다.");';
        echo 'window.location.href = "read.php?title='.$title.' ";';
        echo '</script>';
}
?>