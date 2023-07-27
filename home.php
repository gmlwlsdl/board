<?php
    session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>홈</title>
</head>
<body>
    <h1>Hello, <?php echo $_SESSION['Name']; ?></h1>
    <p><input type="button" value="글쓰기" onclick="location.href='writeForm.php'"></p>
    <script language="javascript">
        document.frm.submit();
    </script>
    <form method="get" action="postList.php">
        <input type="hidden" name="page" value="1">
        <input type="submit" value="글 목록"/>
    </form>
    <a href="logout.php">logout</a>
</body>
</html>