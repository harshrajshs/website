<!DOCTYPE html>
<html>
<head>
    <title>log in</title>
    <style>
      .error {color: #FF0000;}
    </style>
</head>
<body style="background-color: LightGray;">
<div2>
        <button style="margin-left: 1200px;" onclick="window.location.href = 'about.html'" type="button">About Us</button>
        <button style="margin-left: 10px;" onclick="window.location.href = 'registration.php'" type="button">Register</button>
</div2>
<h1 style="text-align: center;">SRIJAN HOME SCHOOL</h1><br>

<?php
  $check1 = 1; 
  $check2 = 1; 
?>

<p style="text-align: center;"><span class="error" >* required field</span></p>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div style="margin-left: 550px; font-size: 20px">
      Enter your Email:
      <input type="email" name="email" required="required"> 
      <span class="error">*</span>  
      <br><br>
      Enter password:
      <input type="password" name="pass" required="required"> 
      <span class="error">*</span>  
      <br><br>
    </div>
  
    <p style="margin-left: 600px; font-size: 20px;"> <span text-align:center > 
      <input type="submit" value="submit"> </span> </p>
    <p style="margin-left: 600px; font-size: 20px;"> <span text-align:center > 
      <input type="reset" value="reset"> </span> </p>   
</form>
    
<?php
$check3 = 0;

$email=$_POST['email'];  
$pass=$_POST['pass'];

echo "entered email is $email\n";
echo "entered password is $pass\n";

$file=fopen("info.csv","r") or die("Unable to open file for reading!");

if(!empty($_POST["email"]) && !empty($_POST["pass"]))
{
  while(! feof($file))
  {
    $gmail = fgetcsv($file)[3];
    $password = fgetcsv($file)[4];
    echo "gmail is $gmail\n";
    echo "password is $password\n";
    if($gmail == $email && $password == $pass)
    {
      header( "Location:loggedin.php" );
      $check3=1;
    }
  }
  if($check3==0)
  {
    echo "<p><font color=blue size='4pt'>Email or Password is incorrect.";
  }
}

fclose($file);

?>

</body>
</html>