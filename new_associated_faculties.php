<!DOCTYPE html>
<html>
<head>
  <title>add_faculty</title>
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<body style="background-color: LightGray;">
    <div2>
        <button style="margin-left: 1200px;" onclick="window.location.href = 'index.php'" type="button">HOME</button>
        <button style="margin-left: 10px;" onclick="window.location.href = 'about.php'" type="button">About Us</button>
        <button style="margin-left: 10px;" onclick="window.location.href = 'login.php'" type="button">Login</button>
        <button style="margin-left: 10px;" onclick="window.location.href = 'registration.php'" type="button">Register</button>
        <button style="margin-left: 10px;" onclick="window.location.href = 'search_associated_faculties.php'" type="button">search_faculty</button>
    </div2>
<h1 style="text-align: center;">MEHTA FAMILY SCHOOL OF DATA SCIENCE AND ARTIFICIAL INTELLIGENCE</h1>
<h1 style="text-align: center;">IIT GUWAHATI</h1>

<?php
$check = 1;
$keep = 0;
  $nameErr = $emailErr = $phoneErr = $deptErr =  "";
  $name = $email = $phone = $dept = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name))
    {
      $nameErr = "Only letters and white space allowed";
      $check*=0;
    }    
    $dept = test_input($_POST["dept"]);
    if (!preg_match("/^[a-zA-Z-']*$/",$dept))
    {
      $deptErr = "Only letters and white space allowed";
      $check*=0;
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
      Enter name of faculty:
      <input type="text" name="name" required="required"> 
      <span class="error">* <?php echo $nameErr;?></span>
      <br><br>
      Enter email of faculty:
      <input type="email" name="email" required="required"> 
      <span class="error">* <?php echo $emailErr;?></span> 
      <br><br>
      Enter phone no. of faculty]:
      <input type="phone" name="phone" required="required"> 
      <span class="error">* <?php echo $phoneErr;?></span>  
      <br><br>
      Enter Department of faculty:
        <select name ="dept" required="required">
          <option value = "DSAI">DSAI</option>
          <option value = "CSE">CSE</option>
          <option value = "MNC">MNC</option>
          <option value = "ECE">ECE</option>
          <option value = "EEE">EEE</option>
          <option value = "CIVIL">CIVIL</option>
          <option value = "CL">CL</option>
          <option value = "CST">CST</option>
          <option value = "BSBE">BSBE</option>
          <option value = "EP">EP</option>
        </select> 
      <span class="error">* <?php echo $deptErr;?></span>   
    </div>
  
    <p style="margin-left: 600px; font-size: 20px;"> <span text-align:center > 
      <input type="submit" value="submit"> </span> </p>
    <p style="margin-left: 600px; font-size: 20px;"> <span text-align:center > 
      <input type="reset" value="reset"> </span> </p>   
</form>

<?php

if($check==1 && (!empty($_POST["name"])) &&  (!empty($_POST["email"])) && (!empty($_POST["phone"])) && (!empty($_POST["dept"])))
{
  $keep=1;
  $delimiter = ","; 
  $name=$_POST['name'];  
  $phone=$_POST['phone'];  
  $dept=$_POST['dept'];
  $email=$_POST['email'];   

  $servername = "localhost";
  $port_no = 3306;
  $username = "harsh";
  $password = "harsh1234";
  $myDB = "facultyDB";

  try{
    $conn = new PDO("mysql:host=$servername;port=$port_no;dbname = $myDB", $username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "connected successfully";
    $sql = "INSERT INTO facultyDB.associated_faculties(NAME, PHONE, EMAIL) VALUES(:NAME,:PHONE,:EMAIL)";
    $stmt = $conn->prepare($sql);
    $stmt->EXECUTE(
        array(
            ':NAME' => $name,
            ':PHONE' => $phone,
            ':EMAIL' => $email
        )
        );

    $stmt = $conn->query("SELECT * FROM facultyDB.associated_faculties");
    $curr_id = 1;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $curr_id = $row['ID'];
    }

    $stmt = $conn->query("SELECT * FROM facultyDB.departments");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($row['DNAME']==$dept)
        {
          $DID = $row['DID'];
        }
    }

    $sql = "INSERT INTO facultyDB.works_in(ID,DID) VALUES(:ID,:DID)";
    $stmt = $conn->prepare($sql);
    $stmt->EXECUTE(
        array(
            ':ID' => $curr_id,
            ':DID' => $DID
        )
        );    

  }
  catch(PDOException $e){
    echo "Connection failed: ".$e->getMessage();
  }

  echo "<p> <font color=blue size='4pt'>******************************************************</font><font color=red size='4pt'>YOU HAVE SUCCESSFULLY ADDED THE FACULTY TO OUR LIST</font><font color=blue size='4pt'>******************************************************</font>";
}

?>



</body>
</html>