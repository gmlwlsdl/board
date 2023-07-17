<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>
<body>
    <div> 
        작성자 <?php echo $_SESSION['Name'] ?>
    </div>
    <form action="write.php" method="get">
        <div>
            <?php if(isset($_GET['num'])){
                $num=$_GET['num'];
            }?>
            제목 
            <?php 
            if(isset($_GET['r_title'])){ 
                $r_title=$_GET['r_title']; 
                $origin=$_GET['title'];?>
                <input type="text" name="r_title" value="<?php echo $origin; ?>" required>
            <?php } 
            else if(!isset($_GET['r_title'])){
                 ?><input type="text" name="title" required><?php }?>
        </div>
        <div>
            내용<br>
            <?php 
            if(isset($_GET['r_contents'])){
                $r_contents=$_GET['r_contents'];?>
                <textarea name="r_contents" cols="80" rows="10"><?php echo $r_contents;?></textarea>
            <?php } 
            else if(!isset($_GET['r_contents'])){ 
                 ?><textarea name="contents" cols="80" rows="10"></textarea><?php }?>        
        </div>
        <div style="padding:0 0 0 10px; float:left;">
            <?php if(!empty($_GET['num'])||!empty($_GET['pw'])){
                $pw=$_GET['pw'];?>
                <input type="hidden" name="pw" value="<?php echo $pw?>">
                <input type="hidden" name="num" value="<?php echo $_GET['num'];?>">
            <?php } ?>
            <input type="submit" value="글 올리기">
        </div>
        <div style="padding:0 0 0 10px; float:left;">
            <form method="get" action="postList.php">
                <input type="hidden" name="page" value="1">
                <input type="submit" value="글 목록"/>       
            </form>
        </div>
    </form>
</body>
</html>