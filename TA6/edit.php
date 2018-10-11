<?php
    require_once("db.php");
    session_start();
    $nim = $_SESSION['nim'];
    $sql = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
    $row = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html>
<body>
    <form method="post">
        <table align="center">
            <tr>
                <td colspan="2" align="center"><h2>Edit Profil</h2></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" maxlength="35" value="<?php echo $row['nama'];?>" required></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td><input type="text" name="nim" pattern="\d*" maxlength="10" minlength="10" value="<?php echo $row['nim'];?>" readonly disabled></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td><input type="radio" name="kelas" <?php if($row['kelas'] == "D3MI-41-01") { ?> checked <?php } ?> value="D3MI-41-01">D3MI-41-01 
                <input type="radio" name="kelas" <?php if($row['kelas'] == "D3MI-41-02") { ?> checked <?php } ?> value="D3MI-41-02">D3MI-41-02 
                <input type="radio" name="kelas" <?php if($row['kelas'] == "D3MI-41-03") { ?> checked <?php } ?> value="D3MI-41-03">D3MI-41-03 
                <input type="radio" name="kelas" <?php if($row['kelas'] == "D3MI-41-04") { ?> checked <?php } ?> value="D3MI-41-04">D3MI-41-04</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><input type="radio" name="jeniskelamin" <?php if($row['jeniskelamin'] == "laki-laki") { ?> checked <?php } ?>value="laki-laki">Laki-laki
                <input type="radio" name="jeniskelamin" <?php if($row['jeniskelamin'] == "perempuan") { ?> checked <?php } ?>value="perempuan">Perempuan</td>
            </tr>
            <tr>
                <td>Hobi</td>
                <td><input type="checkbox" name="hobi[]" value="Membaca">Membaca <br>
                <input type="checkbox" name="hobi[]" value="Menulis">Menulis <br>
                <input type="checkbox" name="hobi[]" value="Mewarnai">Mewarnai <br><br></td>
            </tr>
            <tr>
                <td>Fakultas</td>
                <td><select name="fakultas">
                        <option <?php if($row['fakultas'] == "FIT") { ?> selected <?php } ?> value="FIT">FIT</option>
                        <option <?php if($row['fakultas'] == "FEB") { ?> selected <?php } ?> value="FEB">FEB</option>
                        <option <?php if($row['fakultas'] == "FIK") { ?> selected <?php } ?> value="FIK">FIK</option>
                        <option <?php if($row['fakultas'] == "FTE") { ?> selected <?php } ?> value="FTE">FTE</option>
                        <option <?php if($row['fakultas'] == "FIF") { ?> selected <?php } ?> value="FIF">FIF</option>
                        <option <?php if($row['fakultas'] == "FRI") { ?> selected <?php } ?> value="FRI">FRI</option>
                        <option <?php if($row['fakultas'] == "FKB") { ?> selected <?php } ?> value="FKB">FKB</option>
                    </select></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" rows="5"><?php echo $row['alamat'];?></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Submit"></td>
            </tr>
        </table>
    </form> 
    </center>   
</body>
</html>
<?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $jeniskelamin = $_POST['jeniskelamin'];
        $hobi = $_POST['hobi'];
        $fakultas = $_POST['fakultas'];
        $alamat = $_POST['alamat'];

        $list_hobi = implode(", ", $hobi);
    
        $sql = "UPDATE mahasiswa SET nama = '$nama', kelas = '$kelas', jeniskelamin = '$jeniskelamin', hobi = '$list_hobi', fakultas = '$fakultas', alamat = '$alamat' WHERE nim = '$nim'";
    
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Berhasil Diedit'); location='home.php'</script>";
        }else {
            echo "Error: " . $sql . "<br?" . mysqli_error($conn);
        }
    
        mysqli_close($conn);
    }
?>