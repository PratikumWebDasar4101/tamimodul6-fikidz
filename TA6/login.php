<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<body>
    <form method="post">
        <table align="center">
            <tr>
                <td colspan="2" align="center"><h2>Login</h2></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="login" value="Login"></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><a href="registrasi.php">Daftar</a></td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>
<?php
if(isset($_POST['username'])){
    require_once("db.php");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username' AND password = '$password'");
    $row = mysqli_fetch_assoc($sql);
    $num = mysqli_num_rows($sql);
    $id = $row['id'];

    if ($num != 0) {
        $query = mysqli_query($conn, "SELECT nim FROM mahasiswa WHERE id = '$id'");
        $data = mysqli_fetch_assoc($query);
        $_SESSION['nim'] = $data['nim'];
        header("location: home.php");
    }else{
        echo "<script>alert('Akun Belum Terdaftar'); location='login.php'</script>";
    }
    mysqli_close($conn);
}
?>