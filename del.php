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
    if (!empty($_GET['num']) && !empty($_GET['writer']) && !empty($_GET['pw'])) {
        $num=$_GET['num'];
        $writer=$_GET['writer'];
        $pw=$_GET['pw'];
        $sql="SELECT * FROM post WHERE num='$num'&& writer='$writer' ";
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
    else if (!empty($_GET['idx']) && !empty($_GET['name']) &&!empty($_GET['pw'])) {
        $idx=$_GET['idx'];
        $name=$_GET['name'];
        $pw=$_GET['pw'];
        $sql = "SELECT * FROM reply WHERE idx='$idx'&& name='$name' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['pw'] == $pw) {
            $sql2 = "DELETE FROM reply WHERE idx='$idx' ";
            $result = mysqli_query($conn, $sql2);

            $sql3 = "SELECT * FROM reply";
            $result2 = mysqli_query($conn, $sql3);
            $rows = mysqli_num_rows($result2);
            $x=0;
            $y=1;

            if ($rows == 0) {
                $_SESSION['reply_count'] = 0;
            } else {
                while ($array = mysqli_fetch_array($result2) && $rows!=0 ) {
                    if($x>$rows){
                        break;
                    }
                    else{
                        $c=0;
                        $count=$_SESSION['reply_count'];
                        $cnt=$count-$rows;
                        $sql4 = "CREATE TEMPORARY TABLE temp_reply AS (SELECT date FROM reply ORDER BY date ASC LIMIT $x,$y)";
                        $result_temp = mysqli_query($conn, $sql4);

                        $sql5 = "UPDATE reply SET idx='$cnt' WHERE date=(SELECT date FROM temp_reply)";
                        $result3 = mysqli_query($conn, $sql5);

                        // Drop the temporary table
                        $sql6 = "DROP TEMPORARY TABLE IF EXISTS temp_reply";
                        $result_drop = mysqli_query($conn, $sql6);

                        //$sql4 = "UPDATE reply SET idx='$cnt' WHERE date=(SELECT date FROM reply ORDER BY date ASC LIMIT $x) ";
                        //$result3 = mysqli_query($conn, $sql4);
                        $rows--;
                        $x++;
                        $c++; 
                    }
                }
                $_SESSION['reply_count']-=$c;
            }

            echo '<script type="text/javascript">';
            echo 'alert("댓글이 삭제되었습니다.");';
            echo 'window.location.href = "read.php?num='.$_GET['post_num'].' "';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("비밀번호가 틀렸습니다.");';
            echo 'window.location.href = "read.php?num='.$_GET['post_num'].' "';
            echo '</script>';
        }
    }
    ?>
</body>
</html>