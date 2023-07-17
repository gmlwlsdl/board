<?php 
    session_start();
    require_once("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $_get['num']?>번째 글</title>
</head>
<body>
    <?php
        $num=$_SESSION['num'];
        $bno=$_GET['title'];
        $sql="SELECT * FROM post WHERE title='$bno' ";
        $result=mysqli_query($conn, $sql);
        $board=mysqli_fetch_array($result);
        $view=$board['view_cnt']+1;

        $sql2="UPDATE post SET view_cnt='$view' WHERE title='$bno' ";
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
                $post_num=$board['num'];
                $sql="SELECT * FROM reply WHERE post_num='$post_num' ORDER BY idx DESC";
                $result=mysqli_query($conn, $sql);
                $reply=mysqli_fetch_assoc($result);
                $count=mysqli_num_rows($result);
                if($count>0){?>
                    <div><b><?php echo $reply['name'];?></b></div>
                    <div><?php echo $reply['content']?></div>
                    <div><p><?php echo $reply['date']?></div>
                    <div style="float:left;">
                        <form action="get" action="reply.php">
                            <input type="text" name="pw" placeholder="password">
                            <input type="hidden" name="idx" value="<?php echo $reply['idx'];?>">
                            <input type="hidden" name="post_num" value="<?php echo $reply['post_num'];?>">
                            <input type="hidden" name="r_contents" value="<?php echo $reply['content'];?>">
                            <input type="submit" value="수정"/>
                        </form>
                    </div>
                    <div style="padding:0 0 0 10px; float:left;">
                        <form method="get" action="del.php">
                            <input type="text" name="pw" placeholder="password">
                            <input type="hidden" name="idx" value="<?php echo $reply['idx'];?>">
                            <input type="hidden" name="name" value="<?php echo $reply['name'];?>">
                            <input type="submit" value="삭제"/>
                        </form>
                     </div>
                <?php }?>
        </div>
        <br>
        <hr>
        <div>
        <h3>댓글달기</h3>
            <form method="get" action="reply.php" >
                <input type="text" name=id placeholder="ID">
                <input type="text" name=pw placeholder="PASSWORD"><br>
                <textarea name="contents" cols="80" rows="5"></textarea>
                <input type="hidden" name="post_num" value=<?php echo $num;?>>
                <input type="hidden" name="title" value=<?php echo $board['title'];?>>
                <input type="submit" value="댓글" />
            </form>
        </div>
        

</body>
</html>