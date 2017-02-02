<?php
session_start();
require_once('connect.php');
$username = htmlentities ( $_REQUEST['username'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
$password = $_REQUEST['password'];
$gendar = htmlentities ( $_REQUEST['gendar'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
$age = htmlentities ( $_REQUEST['age'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
$email = htmlentities ( $_REQUEST['email'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
$phone = htmlentities ( $_REQUEST['email'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
$usernamecheck = "SELECT username FROM Account where username = '$username'";
$stmtcheck = oci_parse($connect, $usernamecheck);
if(!$stmtcheck) {
echo "An error occurred in parsing the sql string.\n";
exit;
}
oci_execute($stmtcheck);
while(oci_fetch_array($stmtcheck)) {
$fg1 = oci_result($stmtcheck,1);
}

      if ($fg1 != $username)  {
      $query_count = "SELECT max(ID) FROM Account";
      $stmt = oci_parse($connect, $query_count); 
      if(!$stmt)  {
        echo "An error occurred in parsing the sql string.\n"; 
        exit; 
      }
      oci_execute($stmt);
        while(oci_fetch_array($stmt)){
        $count = oci_result($stmt,1);
        }
         $count++;



      $password = md5($salt.$password);

      $query = "INSERT INTO Account VALUES ( $count, '$username','$password', '$gendar', '$age', '$email', '$phone', '$phone')"; 
      $stmtreg = oci_parse($connect, $query); 

              if(!$stmtreg)  {
                echo "An error occurred in parsing the sql string.stmreg\n"; 
                exit; 
              }
      oci_execute($stmtreg);
      $_SESSION['userid'] = $count;
      $_SESSION['regsucful'] = "true"; 
      header("Location: wrong.php");
       } else 
       {            
     $message = "Username has been used.";
     echo "<script type='text/javascript'>alert('$message');window.location.href = 'login.php';</script>";

        exit; 
      }

oci_close($connect);
?>
