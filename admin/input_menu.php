<?php

include('connection.php');
function upload_menuphoto()
{
    $namaFile = $_FILES["photo"]["name"];
    $ukuranFile = $_FILES["photo"]["size"];
    $error = $_FILES["photo"]["error"];
    $tmpName = $_FILES["photo"]["tmp_name"];

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
    move_uploaded_file($tmpName, '../menu_image/' . $namaFileBaru);

    return $namaFileBaru;
}

function add_menu($data)
{
    global $conn;
    $name = $_POST['addname'];
    $code = $_POST['addcode'];
    $photo = htmlspecialchars($_POST['photo']);
    $price = $_POST['addprice'];
    $type = $_POST['addtype'];
    $detail = $_POST['adddetail'];
    // Cek apakah ada file photo yang diupload atau tidak
    if (($_FILES['photo']['error'] == 4)) {
        $photo = '';
    } else {
        $photo = upload_menuphoto();
    }

    $sql = "INSERT INTO tblmenu VALUES(NULL, '$name', '$code', '$photo', '$price', '$type', '$detail')";
    return mysqli_query($conn, $sql);
}
function add_ongkir($data)
{
    global $conn;
    $nama_daerah = $_POST['nama_daerah'];
    $tarif = $_POST['tarif'];
    $sql = "INSERT INTO ongkir VALUES(NULL, '$nama_daerah', '$tarif')";
    return mysqli_query($conn, $sql);
}
