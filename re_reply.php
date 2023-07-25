<?php
    session_start();
    require_once("db.php");
    $pw=$_GET['pw'];
    $idx=$_GET['idx'];
    $post_num=$_GET['post_num'];
    $name=$_GET['name'];
    $content=$_GET['contents']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>댓글 수정</title>
</head>
<body>
    <h2>댓글 수정</h2>
    <div><b><?php echo $name; ?></b></div>
    <form action="get" action='reply.php'>
        <textarea name="r_content" cols="80" rows="10"><?php echo $content?></textarea>
        <input type="hidden" value="<?php echo $pw; ?>">
        <input type="hidden" value="<?php echo $idx; ?>">
        <input type="hidden" value="<?php echo $post_num; ?>">
        <input type="hidden" value="<?php echo $name; ?>">
    </form>
</body>
</html>