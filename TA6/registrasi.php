<?php
    require_once("db.php");
?>
<html>
<body>
    <form method="post">
        <table align="center">
            <tr>
                <td colspan="2" align="center"><h2>Daftar</h2></td>
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
                <td>Nama</td>
                <td><input type="text" name="nama" maxlength="35"></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td><input type="text" name="nim" pattern="\d*" maxlength="10" minlength="10" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="signup" value="Daftar"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];

        $sql = "INSERT INTO akun(username, password) VALUES ('$username', '$password')";
        mysqli_query($conn, $sql);

        $sql_id = "SELECT id FROM akun WHERE username = '$username'";
        $result = mysqli_query($conn, $sql_id);
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];

        $sql_mahasiswa = "INSERT INTO mahasiswa(nama, nim, id) VALUES ('$nama', '$nim', '$id')";

        if (mysqli_query($conn, $sql_mahasiswa)) {
            echo "<center>Berhasil Dibuat</center>";
        }
        else {
            echo "Error: " . $sql . "<br?" . mysqli_error($conn);
        }
        mysqli_close($conn);
        echo "<center> <a href='login.php'>Login</a> </center>";
    }
?>