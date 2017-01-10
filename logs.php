<?php
session_start();
include "config/inc.connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$username 		= $_POST['username'];
$password		= $_POST['password'];
$op 			= $_GET['op'];

if($op=="in"){
    $cek = mysql_query("SELECT * FROM user WHERE username='".$username."' AND password='".md5($password)."'");
    if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
        $c = mysql_fetch_array($cek);
        $_SESSION['username'] = $c['username'];
		$_SESSION['kd_user'] = $c['kd_user'];
        $_SESSION['level'] = $c['level'];
        if($c['level']=="admin"){
            echo "<meta http-equiv=\"refresh\" content=\"0; url=admin.php\">";
        }else if($c['level']=="user"){
            echo "<meta http-equiv=\"refresh\" content=\"0; url=user.php\">";
        }else if($c['level']=="direktur"){
            echo "<meta http-equiv=\"refresh\" content=\"0; url=direktur.php\">";
        }
    }else{
         die("<meta http-equiv=\"refresh\" content=\"0; url=index.php\">");
    }
}else if($op=="out"){
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
}
?>