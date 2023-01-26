<!DOCTYPE html>
<html>
<head>
  <title>registration</title>
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<body style="background-color: LightGray;">
    <div2>
        <button style="margin-left: 1200px;" onclick="window.location.href = 'about.html'" type="button">About Us</button>
        <button style="margin-left: 10px;" onclick="window.location.href = 'login.php'" type="button">Login</button>
    </div2>
<h1 style="text-align: center;">SRIJAN HOME SCHOOL</h1><br>

<?php
$check = 1;
$keep = 0;
  $first_nameErr = $last_nameErr = $genderErr = $dobErr = $emailErr = $passErr = $conf_passErr =  "";
  $first_name = $last_name = $gender = $dob = $email = $pass = $conf_pass = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $first_name = test_input($_POST["first_name"]);
    if (!preg_match("/^[a-zA-Z-']*$/",$first_name))
    {
      $first_nameErr = "Only letters and white space allowed";
      $check*=0;
    }
    $last_name = test_input($_POST["last_name"]);
    if (!preg_match("/^[a-zA-Z-']*$/",$last_name))
    {
      $last_nameErr = "Only letters and white space allowed";
      $check*=0;
    }
    if(!empty($_POST["pass"]) && !empty($_POST["conf_pass"]))
    {
      $pass = test_input($_POST["pass"]);
      $conf_pass = test_input($_POST["conf_pass"]);
      if (strlen($_POST["pass"]) <= '8') {
          $passErr = "Your Password Must Contain At Least 8 Characters!";
          $check*=0;
      }
      elseif(!preg_match("#[0-9]+#",$pass)) {
          $passErr = "Your Password Must Contain At Least 1 Number!";
          $check*=0;
      }
      elseif(!preg_match("#[A-Z]+#",$pass)) {
          $passErr = "Your Password Must Contain At Least 1 Capital Letter!";
          $check*=0;
      }
      elseif(!preg_match("#[a-z]+#",$pass)) {
          $passErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
          $check*=0;
      }
      else if(($_POST["pass"] != $_POST["conf_pass"]))
      {
          $conf_passErr = "confirmed password is not same as password";
          $check*=0;
      }
  }    
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<p style="text-align: center;"><span class="error" >* required field</span></p>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div style="margin-left: 550px; font-size: 20px">
      Enter your first name:
      <input type="text" name="first_name" required="required"> 
      <span class="error">* <?php echo $first_nameErr;?></span>
      <br><br>
      Enter your last name:
      <input type="text" name="last_name" required="required"> 
      <span class="error">* <?php echo $last_nameErr;?></span>
      <br><br>
      Select gender:
        <select name ="gender" required="required">
          <option value = "male">MALE</option>
          <option value = "female">FEMALE</option>
        </select> 
      <span class="error">* <?php echo $genderErr;?></span>  
      <br><br>
      Enter your DOB:
      <input type="date" name="dob" required="required"> 
      <span class="error">* <?php echo $dobErr;?></span>  
      <br><br>
      Enter your Email:
      <input type="email" name="email" required="required"> 
      <span class="error">* <?php echo $emailErr;?></span>  
      <br><br>
      Enter password:
      <input type="password" name="pass" required="required"> 
      <span class="error">* <?php echo $passErr;?></span>  
      <br><br>
      Confirm password:
      <input type="password" name="conf_pass" required="required"> 
      <span class="error">* <?php echo $conf_passErr;?></span>  
      <br><br>
    </div>
  
    <p style="margin-left: 600px; font-size: 20px;"> <span text-align:center > 
      <input type="submit" value="submit"> </span> </p>
    <p style="margin-left: 600px; font-size: 20px;"> <span text-align:center > 
      <input type="reset" value="reset"> </span> </p>   
</form>

<?php

if($check==1 && (!empty($_POST["first_name"])) && (!empty($_POST["last_name"])) && (!empty($_POST["last_name"])) && (!empty($_POST["gender"])) && (!empty($_POST["dob"]) && (!empty($_POST["email"])) && (!empty($_POST["pass"])) && (!empty($_POST["conf_pass"]))))
{
  $keep=1;
  $fp=fopen("info.csv","a") or die("Unable to open file for writting!");
  $delimiter = ","; 
  $first_name=$_POST['first_name'];  
  $last_name=$_POST['last_name'];
  $gender=$_POST['gender'];  
  $dob=$_POST['dob'];
  $email=$_POST['email'];  
  $pass=$_POST['pass'];
  $conf_pass = $_POST['conf_pass'];
  $name = $first_name . " " . $last_name;
  $fields = array($name, $gender, $dob, $email, $pass, $conf_pass); 
  fputcsv($fp, $fields, $delimiter); 
  
  fclose($fp);

  echo "<p> <font color=blue size='4pt'>******************************************************</font><font color=red size='4pt'>YOU HAVE REGISTERED SUCCESSFULLY, NOW YOU CAN LOGIN</font><font color=blue size='4pt'>******************************************************</font>";
}

?>



</body>
</html>