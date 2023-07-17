<?php 
    session_start();
    require_once("db.php");

    date_default_timezone_set('Asia/Seoul');
    $write_date=date('Y-m-d H:i:s');

    if(!empty($_GET['pw'])){
        $pw=$_GET['pw'];
        $cnt=$_GET['num'];
        $r_title=$_GET['r_title'];
        $sql="SELECT * FROM post WHERE num='$cnt' ";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
        $wr_pw=$row['wr_pw'];
        if($wr_pw==$pw){
            if(!empty($r_title)){
                $t_sql="UPDATE post SET title='$r_title' WHERE num='$cnt' ";
                $t_result=mysqli_query($conn, $t_sql);

                $r_date=$write_date;
                $date_sql="UPDATE post SET write_date='$r_date' WHERE num='$cnt' ";
                $date_result=mysqli_query($conn,$date_sql);

                echo '<script type="text/javascript">'; 
                echo 'alert("수정이 완료되었습니다.");';
                echo 'window.location.href = "postList.php";';
                echo '</script>'; 
            }
            if(!empty($_GET['r_contents'])){
                $r_cont=$_GET['r_contents'];
                $c_sql="UPDATE post SET contents='$r_cont' WHERE num='$cnt' ";
                $c_result=mysqli_query($conn, $c_sql);

                $r_date=$write_date;
                $date_sql="UPDATE post SET write_date='$r_date' WHERE num='$cnt' ";
                $date_result=mysqli_query($conn,$date_sql);

                echo '<script type="text/javascript">'; 
                echo 'alert("수정이 완료되었습니다.");';
                echo 'window.location.href = "postList.php";';
                echo '</script>'; 
            }
        }
        else{
            echo '<script type="text/javascript">'; 
            echo 'alert("비밀번호가 틀렸습니다.");';
            echo 'window.location.href = "postList.php";';
            echo '</script>';
        }
    }    
    else{
    $title=$_GET['title'];
    $contents=$_GET['contents'];

    if(!empty($title)){
        mysqli_real_escape_string($conn,$contents);
    }
    else{
        echo '<script type="text/javascript">'; 
        echo 'alert("제목을 입력하세요.");';
        echo 'window.location.href = "writeForm.php";';
        echo '</script>';
    }

    if(!empty($contents)){
        mysqli_real_escape_string($conn,$contents);
    }
    else{
        echo '<script type="text/javascript">'; 
        echo 'alert("내용을 입력하세요.");';
        echo 'window.location.href = "writeForm.php";';
        echo '</script>';
    }

    $writer_id=$_SESSION['ID'];
    $writer_pw=$_SESSION['PW'];
    $writer_name=$_SESSION['Name'];

    $sql="INSERT INTO post(num, title, contents, writer, wr_pw, write_date, view_cnt) VALUES(0, '$title', '$contents', '$writer_id', '$writer_pw', '$write_date', 0) "; 
    $result=mysqli_query($conn, $sql);

    if($result){
        echo '<script type="text/javascript">'; 
        echo 'alert("업로드 성공");';
        echo 'window.location.href = "postList.php";';
        echo '</script>';
    }
    else{
        echo '<script type="text/javascript">'; 
        echo 'alert("업로드 실패");';
        echo 'window.location.href = "home.php";';
        echo '</script>';
    }
}
?>