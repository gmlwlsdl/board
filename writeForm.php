<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #DBDCEF;">
    <div> 
        작성자 <?php echo $_SESSION['Name'] ?>
    </div>
    <br>
    <form action="write.php" method="get">
        <div>
            <?php if(isset($_GET['num'])){
                $num=$_GET['num'];
            }?>
            <?php 
            if(isset($_GET['r_title'])){ 
                $r_title=$_GET['r_title']; 
                $origin=$_GET['title'];?>
                <input type="text" name="r_title" id="b1" value="<?php echo $origin; ?>" required>
            <?php } 
            else if(!isset($_GET['r_title'])){
                 ?><input type="text" name="title" id="b1" placeholder="제목" required><?php }?>
        </div>

        <div>
            <br>
            <?php 
            if(isset($_GET['r_contents'])){
                $r_contents=$_GET['r_contents'];?>
                <textarea name="r_contents" id="b3"><?php echo $r_contents;?></textarea>
            <?php } 
            else if(!isset($_GET['r_contents'])){ 
                 ?><textarea name="contents" id="b3" placeholder="작성할 내용을 입력해 주세요."></textarea><?php }?>        
        </div>
        <div id="left">
                <input type="text" id="b1" name="pw" placeholder="password">
                <?php if(!empty($_GET['num'])){?>
                    <input type="hidden" name="num" value="<?php echo $num;?>">
                <?php } ?>
                <input type="submit" id="b2" value="글 올리기">
            </div>
        </div>
    </form>
        <div id="left">
                <form method="get" action="postList.php">
                    <input type="hidden" name="page" value="1">
                    <input type="submit" id="b2" value="글 목록"/>       
            </form>
    
</body>
</html>