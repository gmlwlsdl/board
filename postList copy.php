//안 쓰는 파일

<?php 
session_start();
require_once("db.php");

//$sql="SELECT * FROM post WHERE(num, write_date) IN (SELECT num, MAX(write_date) FROM post GROUP BY num)";
//$result=mysqli_query($conn, $sql);
//$row = mysqli_fetch_assoc($result);

$sql="SELECT * FROM post";
$result=mysqli_query($conn,$sql2);
$total_row=mysqli_num_rows($result2);

if($total_row==1){
    $update_sql="UPDATE post SET num=1 WHERE num=1";
    $update_result=mysqli_query($conn, $update_sql);
}
else{
    $update_sql="UPDATE post SET num=$total_row WHERE num=0";
    $update_result=mysqli_query($conn, $update_sql);
}

$sql2="SELECT * FROM post WHERE num=$total_row";
$result2=mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result2);
$num=$row['num'];

$list_num=5; //글 개수
$page_num=5; //페이지 개수
$offset=$list_num*($page-1);

$total_page=ceil($total_row/$list_num); //페이지 총 개수
$cur_num=$total_row-$list_num*($page-1); //

$total_block=ceil($total_page/$page_num);
$bloack=ceil($page/$page_num);

$first=($block-1)*$page_num;
$last=$block*$page_num;

?>
