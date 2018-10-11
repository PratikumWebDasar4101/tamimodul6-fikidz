<?php
    require_once("db.php");
    session_start();
?>
<html>
<body>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Postingan</td>
                <td><textarea name="posting"></textarea></td>
            </tr>
            <tr>
                <td>Upload Gambar</td>
                <td><input type="file" name="gambar" accept="image/*"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Post"></td>
            </tr>
            <tr>
                <td colspan="2"><a href="home.php">HOME</a></td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>

<?php
    if (isset($_POST['posting'])) {
        $posting = $_POST['posting'];
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $dir = "upload/";
        $file = $dir.$gambar;
        $nim = $_SESSION['nim'];
    
        $uploadgambar = move_uploaded_file($tmp, $file);
        if(!$uploadgambar){
            die("<center>Gagal!</center>");
        }

        $sql = "INSERT INTO posting(posting, gambar, nim) VALUES ('$posting', '$file', '$nim')";
        if (mysqli_query($conn, $sql)) {
            echo "<center>Berhasil</center>";
        }
        else {
            echo "Error: " . $sql . "<br?" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
?>