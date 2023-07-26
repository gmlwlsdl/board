<?php 
session_start();
require_once("db.php");

if(!empty($_GET['id'])&&!empty($_GET['pw'])
    &&!empty($_GET['contents'])&&!empty($_GET['post_num'])){
    $id=$_GET['id'];
    $pw=$_GET['pw'];
    $contents=$_GET['contents'];
    $post_num=$_GET['post_num'];
    if($_SESSION['reply_count']==1 || $_SESSION['reply_count']>1){
        $_SESSION['reply_count']++;
        $count=$_SESSION['reply_count'];
    }
    else{
        $count=1;
        $_SESSION['reply_count']=$count;
    }

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
            $rc=$_SESSION['reply_count'];
            echo '<script type="text/javascript">'; 
            echo 'alert("'.$_SESSION['reply_count'].'번째 댓글 등록 성공");';
            echo 'window.location.href = "read.php?num='.$post_num.'";';
            echo '</script>';
        }
        else{
            echo '<script type="text/javascript">'; 
            echo 'alert("댓글 등록 실패");';
            echo 'window.location.href = "read.php?num='.$post_num.' ";';
            echo '</script>';
        }
    }
    else{
        echo '<script type="text/javascript">'; 
            echo 'alert("존재하지 않는 계정입니다.");';
            echo 'window.location.href = "read.php?num='.$post_num.' ";';
            echo '</script>';
    }
} // 정상 댓글 등록
else if(!empty($_GET['re_pw'])&&!empty($_GET['re_id'])
    &&!empty($_GET['re_contents'])&&!empty($_GET['re_post_num'])&&!empty($_GET['re_idx'])){
    $id=$_GET['re_id'];
    $pw=$_GET['re_pw'];
    $re_contents=$_GET['re_contents'];
    $re_post_num=$_GET['re_post_num'];
    $re_idx=$_GET['re_idx'];

    $sql="SELECT * FROM account_table WHERE id='$id' AND pw='$pw' ";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_assoc($result);

        if($row['id']==$id && $row['pw']==$pw){
            $name=$row['name'];
            date_default_timezone_set('Asia/Seoul');
            $re_date=date('Y-m-d H:i:s');
            $sql4="UPDATE reply SET date='$re_date', content='$re_contents' WHERE idx='$re_idx' ";
            $result2=mysqli_query($conn, $sql4);
            $_SESSION['reply_ID']=$row['id'];
            $_SESSION['reply_PW']=$row['pw'];
            $_SESSION['reply_Name']=$row['name'];
            echo '<script type="text/javascript">'; 
            echo 'alert("'.$re_idx.'번째 댓글 수정 완료");';
            echo 'window.location.href = "read.php?num='.$re_post_num.'";';
            echo '</script>';
        }
        else{
            echo '<script type="text/javascript">'; 
            echo 'alert("댓글 수정 실패");';
            echo 'window.location.href = "read.php?num='.$re_post_num.' ";';
            echo '</script>';
        }
    }
    else{
        echo '<script type="text/javascript">'; 
            echo 'alert("존재하지 않는 계정입니다.");';
            echo 'window.location.href = "read.php?num='.$re_post_num.' ";';
            echo '</script>';
    }
}

?>