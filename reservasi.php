<?php
include 'koneksi.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: index.html");
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $user = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $telpon = $_POST['telpn'];

    $sql = "INSERT INTO dpasien (email, username, password, telpn) 
            VALUES ('$email', '$user', '$password', '$telpon')";
    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Selamat! Reservasi berhasil.')</script>";
        echo "<script>window.location.href = 'index.html';</script>";

    } else {
        echo "<script>alert('Ooops! Terjadi kesalahan.')</script>";
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Reservasi Pasien </title>
    <link rel="stylesheet" href="stylea.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-pasien">
            <p style="font-size: 2rem; font-weight: 850; text-align: center;"> RESERVASI </p>
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
                <input type="telpn" placeholder="No Telpon" name="telpon" value="<?php echo $telpon; ?>" required>
            </div>
            <div class="input">
                <button name="submit" class="btn"> Register </button>
            </div>
        </form>
    </div>
</body>
</html>
