<?php
include 'koneksi.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $user = $_POST['user'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $cpass = password_hash($_POST['cpass'], PASSWORD_DEFAULT);

    if ($_POST['password'] == $_POST['cpass']) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (email, username, password) 
                    VALUES ('$email', '$user', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat! Registrasi Anda Berhasil.')</script>";
                $user = "";
                $email = "";
                $_POST['password'] = ""; 
                $_POST['cpass'] = "";
            } else {
                echo "<script>alert('Ooops! Mohon Maaf Ada Kesalahan')</script>";
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Cocok!.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="stylea.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-pasien">
            <p style="font-size: 2rem; font-weight: 850; text-align: center;"> REGISTER </p>
            <div class="input">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input">
                <input type="text" placeholder="User Name" name="user" value="<?php echo $user; ?>" required>
            </div>
            <div class="input">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST["password"]; ?>" required>
            </div>
            <div class="input">
                <input type="password" placeholder="Confirm Password" name="cpass" value="<?php echo $_POST['cpass']; ?>" required>
            </div>
            <div class="input">
                <button name="submit" class="btn"> Register </button>
            </div>
            <p class="login-register">Have an Account? 
                <a href="login.php"> Login </a>
            </p>
        </form>
    </div>
</body>
</html>
