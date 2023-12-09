<?php

include 'koneksi.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: reservasi.php");
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['user'];
		header("Location: reservasi.php");
	} else {
		echo "<script>alert('Oops! Email Atau Password Anda Salah.')</script>";
        echo "Error: " . mysqli_error($conn);
        echo "Debug: Email not found - $email";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form - Pasien</title>
    <link rel="stylesheet" href="stylea.css">

</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-pasien">
            <p style="font-size: 2rem; font-weight: 850; text-align: center;"> LOGIN </p>
            <div class="input">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input">
                <button name="submit" class="btn"> Log in </button>
            </div>
            <p class="login-register">Don't Have an Account? 
                <a href="register.php">Register</a>
            </p>
        </form>
    </div>
</body>
</html>