<?
  $user=$_GET['username'];
  $name=$_GET['name'];
  $pass=$_GET['pass'];
  $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
  $servername = "pbot001.cuicotomxesg.us-east-2.rds.amazonaws.com";
  $username = "pbot001";
  $password = "123456789";
  $dbname = "pbot001db";


      $conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			mysqli_set_charset($conn,"utf8");
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

		      $stmt = $conn->prepare('INSERT INTO pbot001db.waiting_approve (username,hashpass,name) VALUES (?,?,?)');
		      $stmt->bind_param('sss', $user, $hash_pass, $name); 
			$stmt->execute();
      			$stmt->close();
			$conn->close();
		echo "successfull";
?>
