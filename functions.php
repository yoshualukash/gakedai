<?php
//Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "gakedai");
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function register($data)
{
    global $conn;
    $nama = $data["nama"];
    $email = $data["email"];
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM account_usr WHERE username = '$username'");
    $result1 = mysqli_query($conn, "SELECT username FROM account_google WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username yang dipilih sudah terdaftar');
            </script>";
        return false;
    } elseif (mysqli_fetch_assoc($result1)) {
        echo "<script>
            alert('Username yang dipilih sudah terdaftar');
            </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password != $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }
    //enkripsi passwordnya
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO account_usr VALUES('', '$nama', '$email', '$username', '$password')");
    return mysqli_affected_rows($conn);
}

function login($data)
{
    global $conn;
    $username = $data["username"];
    $password = $data["password"];
    $_SESSION['username'] = $username;
    $result = mysqli_query($conn, "SELECT * FROM account_usr WHERE username = '$username'");
    $row1 = mysqli_fetch_assoc($result);
    $_SESSION['id_user'] = $row1['id'];
    //Cek username di database
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        //Cek password
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            echo "<script>
			alert('Selamat datang, $username !');
			document.location.href = 'index.php';
            </script>";
            return exit;
        }
    }
}
function send_message($data)
{
    global $conn;
    $nama = $data["nama"];
    $email = $data["email"];
    $judul = $data["judul"];
    $pesan = $data["pesan"];

    //tambahkan pesan baru ke database
    mysqli_query($conn, "INSERT INTO pesan_saran VALUES('', '$nama', '$email', '$judul', '$pesan')");
    return mysqli_affected_rows($conn);
}
function upload_buktibayar()
{
    $namaFile = $_FILES["buktibayar"]["name"];
    $ukuranFile = $_FILES["buktibayar"]["size"];
    $error = $_FILES["buktibayar"]["error"];
    $tmpName = $_FILES["buktibayar"]["tmp_name"];

    //cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
            alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }
    //cek apakah file upload adalah gambar atau tidak
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('tolong masukkan gambar dengan tipe 'jpg', 'jpeg', atau 'png' saja);
            </script>";
        return false;
    }
    //cek jika ukuran file terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
            alert('ukuran gambar terlalu besar, upload gambar ukuran < 1 mb');
            </script>";
        return false;
    }
    //lolos pengecekan
    //generate nama baru jika nama nya ada yang sama
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= "$ekstensiGambar";
    move_uploaded_file($tmpName, 'buktibayar/' . $namaFileBaru);

    return $namaFileBaru;
}

function add_buktibayar($data)
{
    global $conn;
    $id = $data['id'];
    $photo = htmlspecialchars($_POST['buktibayar']);
    // Cek apakah ada file photo yang diupload atau tidak
    if (($_FILES['buktibayar']['error'] == 4)) {
        $photo = '';
    } else {
        $photo = upload_buktibayar();
    }
    $sqlstatus = "UPDATE daftar_order SET status_pesan='1' WHERE id_order='$id' ";
    mysqli_query($conn, $sqlstatus);
    $sql = "UPDATE daftar_order SET buktibayar='$photo' WHERE id_order='$id' ";
    return mysqli_query($conn, $sql);
}
