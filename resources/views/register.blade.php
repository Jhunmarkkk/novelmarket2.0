<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Register Now!</title>


    <style>

body {
  background-image: url('bagongregisterbg.png');
  background-size: cover;
  background-position: center;
  display: flex;
  justify-content: center;
  height: 100vh;
  font-family: Arial, sans-serif;
  margin: 0;
}

.form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  max-width: 350px;
  background-color: #fff;
  padding: 10px 70px;
  border-radius: 20px;
  position: absolute;
  top: 50%;
  left: 30%;
  transform: translate(-50%, -50%);
}

.title {
  font-size: 28px;
  color: royalblue;
  font-weight: 600;
  letter-spacing: -1px;
  position: relative;
  display: flex;
  align-items: center;
  padding-left: 30px;
}

.title::before,.title::after {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  border-radius: 50%;
  left: 0px;
  background-color: royalblue;
}

.title::before {
  width: 18px;
  height: 18px;
  background-color: royalblue;
}

.title::after {
  width: 18px;
  height: 18px;
  animation: pulse 1s linear infinite;
}

.message, .signin {
  color: rgba(88, 87, 87, 0.822);
  font-size: 14px;
}

.signin {
  text-align: center;
}

.signin a {
  color: royalblue;
}

.signin a:hover {
  text-decoration: underline royalblue;
}

.flex {
  display: flex;
  width: 100%;
  gap: 6px;
}

.form label {
  position: relative;
}

.form label .input {
  width: 100%;
  padding: 10px 10px 20px 10px;
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;
}

.form label .input + span {
  position: absolute;
  left: 10px;
  top: 15px;
  color: grey;
  font-size: 0.9em;
  cursor: text;
  transition: 0.3s ease;
}

.form label .input:placeholder-shown + span {
  top: 15px;
  font-size: 0.9em;
}

.form label .input:focus + span,.form label .input:valid + span {
  top: 30px;
  font-size: 0.7em;
  font-weight: 600;
}

.form label .input:valid + span {
  color: green;
}

.submit {
  border: none;
  outline: none;
  background-color: royalblue;
  padding: 10px;
  border-radius: 10px;
  color: #fff;
  font-size: 16px;
  transform: .3s ease;
}

.submit:hover {
  background-color: rgb(56, 90, 194);
}

@keyframes pulse {
  from {
    transform: scale(0.9);
    opacity: 1;
  }

  to {
    transform: scale(1.8);
    opacity: 0;
  }
}

</style>
</head>
<body>

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "jdbstore_db";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    $customer_image = $_FILES['customer_image']['name'];
    $targetDir = __DIR__ . '/uploads/'; // Change this to your desired directory
    $targetPath = $targetDir . $customer_image;

    if (move_uploaded_file($_FILES["customer_image"]["tmp_name"], $targetPath)) {
        echo "File uploaded successfully";
    } else {
        echo "Error uploading file";
    }

    $sql = "INSERT INTO customer (fname, lname, username, password, customer_image) VALUES ('$fname', '$lname', '$usernameInput', '$passwordInput', '$customer_image')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully")</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<form class="form" method="post" action="{{route('register.post')}}" enctype="multipart/form-data">
    <p class="title">Register</p>
    <p class="message">Signup now and get full access to our website.</p>
    <!-- Existing form content -->
    <div class="flex">
        <label>
            <input required="" placeholder="" type="text" name="fname" class="input">
            <span>Firstname</span>
        </label>
        <label>
            <input required="" placeholder="" type="text" name="lname" class="input">
            <span>Lastname</span>
        </label>
    </div>

    <label>
        <input required="" placeholder="" type="text" name="username" class="input">
        <span>Username</span>
    </label> 
    <label>
        <input required="" placeholder="" type="password" name="password" class="input">
        <span>Password</span>
    </label>

    <label class="custom-file-upload" for="image">
        <div class="text">
            <p class="message">Upload your profile picture</p>
        </div>
        <input type="file" id="image" name="customer_image">
    </label>

    <button type="submit" class="submit">Submit</button>
    <p class="signin">Already have an account? <a href="LoginPage.php">Sign in</a></p>
</form>

</body>
</html>