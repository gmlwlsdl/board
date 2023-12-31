<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
    <link rel="stylesheet" href="style.css">

</head>
<body style="background-color: #DBDCEF;">
    <?php 
        session_start();
        require_once("db.php");

        $catalog=$_GET['catalog'];
        $search=$_GET['search'];

        if(empty($search)){
            echo '<script type="text/javascript">'; 
            echo 'window.location.href = "postList.php";';
            echo '</script>'; 
        }
    ?>
    <h1>Hello, <?php echo $_SESSION['Name']; ?></h1>
    <div style="color: gray;"><b><?php echo $catalog?></b>에서 <b><?php echo $search?></b> 검색 결과</div>
    <div id="right">
        <input type="button" value="글 쓰기" id="b2" onclick="location.href='writeForm.php'">
    </div>
    <div id="right">
        <input type="button" value="글 목록" id="b2" onclick="location.href='postList.php'">
    </div>
    <div id="right">
        <form action="search.php" method="get">
            <select name="catalog">
                <option value="num">글번호</option>
                <option value="title">제목</option>
                <option value="writer">글쓴이</option>
            </select>
            <input type="text" id="b1" placeholder="검색어" name="search">
            <input type="submit" id="b2" value="검색">
        </form>
        </div><br>
    <?php 
        $sql1="SELECT * FROM post WHERE $catalog like '%$search%' ";
        if($result=mysqli_query($conn, $sql1)){

            $list_num=5; // 한 페이지당 글 개수
            $page_num=3; // 한 블럭 당 페이지 수
            $page=1;

            $num=mysqli_num_rows($result); //추출된 칼럼 수

            $total_page=ceil($num/$list_num); //전체 페이지 수
            $total_block=ceil($total_page/$page_num); //전체 블럭 수

            $now_block=ceil($page/$page_num); //현재 블럭 번호

            $s_pageNum=($now_block-1)*$page_num + 1; //블럭당 시작 페이지 번호

            if($s_pageNum<=0){
                $s_pageNum=1;
            };
        
            $e_pageNum=$now_block*$page_num; //블럭당 마지막 페이지 번호
        
            if($e_pageNum>$total_page){
                $e_pageNum=$total_page;
            };
        
            $start=($page-1)*$list_num; //시작번호
            $sql2="SELECT * FROM post LIMIT $start, $list_num"; // post 테이블에서 시작-끝번호 행까지 가져옴
            $result2=mysqli_query($conn,$sql2);
            $cnt=$start+1; // 시작 글 번호
            ?>
            <table>
                <tr bgcolor="#c5c6d7">
                    <th>no</th>
                    <th>title</th>
                    <th>writer</th>
                    <th>date</th>
                    <th>view</th>
                </tr>
                 <?php
                    while($array=mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><a href="read.php?num=<?php echo $array["num"]; ?>"><?php echo $array["num"]; ?></a></td>
                    <?php
                    $_SESSION['num']=$cnt;
                    $sql3="UPDATE post SET num='$cnt', page='$page' WHERE title='".$array["title"]."' ";
                    $result3=mysqli_query($conn,$sql3);?>
                    <td><a href="read.php?title=<?php echo $array["title"]; ?>"><?php echo $array["title"]; ?></a></td>
                    <td><?php echo $array["writer"];?></td>
                    <td><?php echo substr($array["write_date"],0,10);?></td>
                    <td><?php echo $array["view_cnt"];?></td>
                    </td>
                </tr>
                <br>
                <?php 
                $cnt++;
            }; ?>
            </table>

    <p>
        <div style="text-align:center">
            <?php 
            if($page<=1){
            ?>
                <a href="postList.php?page=1">이전</a> 
            <?php }
            else{ ?>
                <a href="postList.php?page=<?php echo ($page-1); ?>">이전</a>
            <?php };?>

            <?php
            for($print_page=$s_pageNum; $print_page<=$e_pageNum; $print_page++){ ?>
                <a href="postList.php?page=<?php echo $print_page; ?>"><?php echo $print_page;?></a>
            <?php };?>
            
            <?php if($page>=$total_page){
            ?>
                <a href="postList.php?page=<?php echo $total_page; ?>">다음</a>
            <?php } else{ ?>
                <a href="postList.php?page=<?php echo ($page+1); ?>">다음</a>
            <?php };?>
        </div>
        <br>
        <center>
            <a href="logout.php">logout</a>
        </center>
    </p>

    <?php }
        else{?>
            <form method="get" action="postList.php">
                <input type="hidden" name="page" value="1">
            </form>
            <?php
            echo '<script type="text/javascript">'; 
            echo 'alert("검색 결과 없음");';
            echo 'window.location.href = "postList.php";';
            echo '</script>';
        }
    ?>
</body>
</html>