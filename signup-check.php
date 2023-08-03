 <?php 
    require_once("db.php");

    $id=$_GET["ID"];
    $pw=$_GET["PW"];
    $re_pw=$_GET["R_PW"];
    $name=$_GET["NAME"];
    $email=$_GET["Email"];

    if((empty($id&&$pw&&$re_pw&&$name&&$email))){
        echo '<script type="text/javascript">'; 
        echo 'alert("정보를 모두 기입해 주세요.");'; 
        echo 'window.location.href = "signup.php";';
        echo '</script>';
    }
    else{
        if($pw==$re_pw){
            $sql="SELECT * FROM account_table WHERE id='$id' ";
            $result=mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>0){
                echo '<script type="text/javascript">'; 
                echo 'alert("이미 사용중인 ID입니다.");';
                echo 'window.location.href = "signup.php";';
                echo '</script>';
            }
            else{
                $sql2="INSERT INTO account_table(id, pw, name, email) 
                    VALUES('$id', '$pw', '$name', '$email')";
                mysqli_query($conn,$sql2);
                echo '<script type="text/javascript">'; 
                echo 'alert("회원가입 완료!");';
                echo 'window.location.href = "index.php";';
                echo '</script>';
            }
        }
        else if($pw!=$re_pw){
            echo '<script type="text/javascript">'; 
            echo 'alert("비밀번호를 확인해 주세요");'; 
            echo 'window.location.href = "signup.php";';
            echo '</script>';
        }
    }
?>