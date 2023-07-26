<?php 
    session_start();
    require_once("db.php");

    $re_idx=$_GET['re_idx'];
    $re_post_num=$_GET['re_post_num'];
    $re_name=$_GET['re_name'];
    $re_contents=$_GET['re_contents'];
    
    $sql="SELECT * FROM post WHERE num='$re_post_num' ";
    $result=mysqli_query($conn, $sql);
    $board=mysqli_fetch_array($result);
    $num=$board['num']; 
    $view=++$board['view_cnt'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $num?>번째 글</title>
</head>
<body>
    <?php
        $sql2="UPDATE post SET view_cnt='$view' WHERE num='$num' ";
        $result2=mysqli_query($conn,$sql2);
        ?>
        <div>
            <h2><?php echo $board['num'];?><br></h2>
            제목 : <?php echo $board['title'];?>
        </div>
        <div>
            작성자 : <?php echo $board['writer'];?> 작성일 : <?php echo $board['write_date'];?> 조회수 : <?php echo $board['view_cnt'];?>
        </div>
        <div style="height: auto;">
            <hr/>
            <?php echo $board['contents'];?>
        </div>
        <div style="padding:0 0 0 10px; float:right;">
            <form method="get" action="postList.php">
                <input type="hidden" name="page" value="1">
                <input type="submit" value="글 목록"/>       
            </form>
        </div>
        <div style="padding:0 0 0 10px; float:right;">
                <form method="get" action="writeForm.php">
                    <input type="text" name="pw" placeholder="password">
                    <input type="hidden" name="r_title" value="<?php echo $board['title'];?>">
                    <input type="hidden" name="r_contents" value="<?php echo $board['contents'];?>">
                    <input type="hidden" name="title" value="<?php echo $board['title'];?>">
                    <input type="hidden" name="contents" value="<?php echo $board['contents'];?>">
                    <input type="hidden" name="num" value="<?php echo $board['num'];?>">
                    <input type="submit" value="수정"/>
                </form>
        </div>
        <div style="padding:0 0 0 10px; float:right;">
            <form method="get" action="del.php">
                <input type="text" name="pw" placeholder="password">
                <input type="hidden" name="num" value="<?php echo $board['num'];?>">
                <input type="hidden" name="writer" value="<?php echo $board['writer'];?>">
                <input type="submit" value="삭제"/>
            </form>
        </div>
        <br>
        <hr>
        <div>
            <h3>댓글목록</h3>
            <?php 
                $re_sql="SELECT * FROM reply WHERE post_num='$re_post_num' ORDER BY date ASC ";
                $re_result=mysqli_query($conn, $re_sql);
                while($reply=mysqli_fetch_assoc($re_result)){ 
                    if(($reply['name']==$re_name)&&($reply['content']==$re_contents)){
                        continue;
                    }?>
                    <div><b><?php echo $reply['name'];?></b></div>
                    <div><?php echo $reply['content']?></div>
                    <div><p><?php echo $reply['date']?></div>
                    <br>
                    <br>
                <?php }  ?>
                
        </div>
        <br>
        <hr>
        <div>
        <h3>댓글달기</h3>
                <form method="get" action="reply.php" >
                    <b><?php echo $_SESSION['Name']; ?></b><br>
                    <textarea name="re_contents" cols="80" rows="5"><?php echo $re_contents;?></textarea>
                    <input type="text" name="re_pw" placeholder="password">
                    <input type="hidden" name="re_post_num" value=<?php echo $num;?>>
                    <input type="hidden" name="re_id" value=<?php echo $_SESSION['ID'];?>>
                    <input type="hidden" name="re_idx" value=<?php echo $re_idx;?>>
                <input type="submit" value="수정" />   
            </form>
        </div>
        

</body>
</html>