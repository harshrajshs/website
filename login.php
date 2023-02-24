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
        <button style="margin-left: 10px;" onclick="window.location.href = 'registration.html'" type="button">Register</button>
</div2>
<h1 style="text-align: center;">MEHTA FAMILY SCHOOL OF DATA SCIENCE AND ARTIFICIAL INTELLIGENCE</h1>
<h1 style="text-align: center;">IIT GUWAHATI</h1>

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

if(!empty($_POST["email"]) && !empty($_POST["pass"]))
{
  $servername = "localhost";
  $port_no = 3306;
  $username = "harsh";
  $password = "harsh1234";
  $myDB = "portalDB";

  try{
    $conn = new PDO("mysql:host=$servername;port=$port_no;dbname = $myDB", $username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "connected successfully";

    $stmt = $conn->query("SELECT * FROM portalDB.UserData");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($row['EMAIL'] == $email && $row['PASSWORD1'] == $pass)
        {
          header( "Location:loggedin.php" );
          $check3=1;
        }
    }
    }
    catch(PDOException $e){
        echo "Connection failed: ".$e->getMessage();
      }
    



    // $sql = "INSERT INTO portalDB.UserData(NAME1, GENDER, DOB, EMAIL, PASSWORD1) VALUES(:NAME1,:GENDER,:DOB,:EMAIL,:PASSWORD1)";
    // $stmt = $conn->prepare($sql);
    // $stmt->EXECUTE(
    //     array(
    //         ':NAME1' => $name,
    //         ':GENDER' => $gender,
    //         ':DOB' => $dob,
    //         ':EMAIL' => $email,
    //         ':PASSWORD1' => $pass
    //     )
    //     );
  }
    
    if($check3==0)
    {
      echo "<p><font color=blue size='4pt'>Email or Password is incorrect.";
    }


?>

</body>
</html>