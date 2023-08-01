<?php
    session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>홈</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #DBDCEF;" >
    <h1>Hello, <?php echo $_SESSION['Name']; ?></h1>
            <div class="bt">
                <div>
                <p><input type="button" id="b2" value="글쓰기" onclick="location.href='writeForm.php'"></p>
                </div>
                <div>
                    <form method="get" action="postList.php">
                    <input type="hidden" name="page" value="1">
                    <input type="submit" id="b2" value="글 목록"/>
                    </form>
                </div> 
            </div><br>
   <center><a href="logout.php">logout</a></center>
</body>
</html>