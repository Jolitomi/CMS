<?php require_once("includes/db.php");?>
<?php
    function Redirect_to($New_Location){
    header("Location:".$New_Location);
    exit;
 }

function CheckUserNameExistsOrNot($UserName){
    global $ConnectingDB;
    $sql = "SELECT username FROM admins WHERE username=:UserName";
    $stmt   = $ConnectingDB->prepare($sql);
    $stmt-> bindvalue(':userName', $UserName);
    $stmt->execute();
    $Result = $stmt->rowcount();
    if ($Result==1){
        return true;
    }else {
        return false;
    }
}
function Login_Attempt($UserName,$Password){
    global $ConnectingDB;
    $sql = "SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':userName', $UserName);
    $stmt->bindValue(':passWord',$Password);
    $stmt->execute();
    $Result = $stmt->rowCount();
    if ($Result==1){
        return $Found_Account=$stmt->fetch();
    }else {
        return null;
    }
}
?>