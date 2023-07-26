<?php 
    session_start();
    require_once("db.php");

    if(!empty($_GET['title'])){
        $bno=$_GET['title'];
    }
    else if(!empty($_GET['num'])){
        $bno=$_GET['num'];
    }
    $sql="SELECT * FROM post WHERE title='$bno' OR num='$bno' ";
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
        
        <div style="padding:0 0 0 10px; float: right;">
            <form method="get" action="del.php">
                <input type="text" name="pw" placeholder="password">
                <input type="hidden" name="num" value="<?php echo $board['num'];?>">
                <input type="hidden" name="writer" value="<?php echo $board['writer'];?>">
                <input type="submit" value="삭제"/>
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
        <br>
        <hr>
        <div>
            <h3>댓글목록</h3>
            <?php 
                //정상 댓글 출력
                    $post_num=$board['num'];
                    $sql="SELECT * FROM reply WHERE post_num='$post_num' ORDER BY date ASC";
                    $result=mysqli_query($conn, $sql);
                    
                    //$count=mysqli_num_rows($result);
                    while($reply=mysqli_fetch_assoc($result)){ ?>
                        <div><b><?php echo $reply['name'];?></b></div>
                        <div><?php echo $reply['content']?></div>
                        <div><p><?php echo $reply['date']?></div>
                        <div style="padding:0 0 0 10px; float:right;">
                            <form method="get" action="re_reply.php?num=<?php echo $reply['post_num'];?>">
                                
                                <input type="hidden" name="re_idx" value="<?php echo $reply['idx'];?>">
                                <input type="hidden" name="re_post_num" value="<?php echo $reply['post_num'];?>">
                                <input type="hidden" name="re_name" value="<?php echo $reply['name'];?>">
                                <input type="hidden" name="re_contents" value="<?php echo $reply['content'];?>">
                                
                                <input type="submit" value="수정"/>
                            </form>
                        </div>
                        <div style="padding:0 0 0 10px; float:right;">
                            <form method="get" action="del.php">
                                <input type="text" name="re_pw" placeholder="password">
                                <input type="hidden" name="idx" value="<?php echo $reply['idx'];?>">
                                <input type="hidden" name="name" value="<?php echo $reply['name'];?>">
                                <input type="hidden" name="post_num" value="<?php echo $post_num;?>">
                                <input type="submit" value="삭제"/>
                            </form>
                         </div>
                        <br>
                        <br>
                    <?php }
                  ?>
                
        </div>
        <br>
        <hr>
        <div>
        <h3>댓글달기</h3>
            <form method="get" action="reply.php" >
                <b><?php echo $_SESSION['Name']; ?></b><br>
                <textarea name="contents" cols="80" rows="5"></textarea>
                <input type="hidden" name="post_num" value=<?php echo $num;?>>
                <input type="hidden" name="id" value=<?php echo $_SESSION['ID'];?>>
                <input type="hidden" name="pw" value=<?php echo $_SESSION['PW'];?>>
                <input type="submit" value="댓글" />
            </form>
        </div>
        

</body>
</html>