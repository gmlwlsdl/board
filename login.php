<?php 
    session_start();
    require_once("db.php");
    
    $id=$_GET["ID"];
    $pw=$_GET["PW"];

    $sql="SELECT * FROM account_table WHERE id='$id' AND pw='$pw' ";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_assoc($result);
        
        if($row['id']==$id&&$row['pw']==$pw){
            $_SESSION['ID']=$row['id'];
            $_SESSION['PW']=$row['pw'];
            $_SESSION['Name']=$row['name'];
            echo '<script type="text/javascript">'; 
            echo 'alert("로그인 완료!");';
            echo 'window.location.href = "home.php";';
            echo '</script>';
        }
        else{
            echo '<script type="text/javascript">'; 
            echo 'alert("로그인 실패");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
        }
    }
    else{
        echo '<script type="text/javascript">'; 
        echo 'alert("존재하지 않는 계정입니다.");';
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }
?>