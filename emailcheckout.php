<?php
date_default_timezone_set("Asia/Bangkok");
if (!isset($_SESSION)) {
    session_start();
}
require 'functions.php';
include('emailconn.php');
$tglemail = date("D, d F Y");
$id_pelanggan = $_SESSION['idpelanggan'];
$id_pembelian_barusan = $_SESSION['idpembelianbarusan'];
// Ambil Biodata User
$ambilprofile = $conn->query("SELECT * FROM account_google WHERE id='$id_pelanggan'");
$detailprofile = $ambilprofile->fetch_assoc();
$email = $detailprofile['email'];
$name = $detailprofile['nama'];
// Ambil Daftar Ordernya
$ambil1 = $conn->query("SELECT * FROM daftar_order JOIN account_google ON daftar_order.id_pelanggan = account_google.id WHERE daftar_order.id_order='$id_pembelian_barusan'");
$detail = $ambil1->fetch_assoc();
$customer = $detail['nama'];
$orderno = $detail['id_order'];
$notelp = $detail['no_telepon'];
$alamat = $detail['alamat'];
$tglbeli = $detail['tanggal_beli'];
$waktubeli = $detail['waktu_beli'];

$totalbelanja = 0;
//PHP Mailer
use PHPMailer\PHPMailer\PHPMailer; //gausah dirubah
use PHPMailer\PHPMailer\Exception; //gausah dirubah

require 'phpmailer/src/Exception.php'; //arahkan ke folder phpmailer
require 'phpmailer/src/PHPMailer.php'; //arahkan ke folder phpmailer
require 'phpmailer/src/SMTP.php'; //arahkan ke folder phpmailer
require 'phpmailer/class.phpmailer.php'; //arahkan ke folder phpmailer
require 'phpmailer/PHPMailerAutoload.php'; //arahkan ke folder phpmailer

//Create a new PHPMailer instance
$mail = new PHPMailer;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = $emailgakedai; /////////////////////// ISI DENGAN ALAMAT GMAIL KALIAN
$mail->Password = $pwgakedai; /////////////////////// ISI DENGAN PASSWORD GMAIL NYA

//Recipients
$mail->setFrom('noreply@richard.id', 'GAKedai Kafe');
$mail->addAddress($email, $name); // Add a recipient

$mail->Subject = 'Order GAKedai anda telah kami terima!';
// Mengatur format email ke HTML
$mail->isHTML(true);
// Konten/isi email
$mailContent = '<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 20px 0 30px 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                <tr>
                    <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0;">
                        <img src="https://i.ibb.co/t4rrY8K/logo-gakedai.png" width="200" height="200" style="display: block;" />
                    </td>
                </tr>
                <tr>
                    <td align="center" style="color: #153643; font-family: Arial, sans-serif; ">
                        <h2>Halo, ' . $customer . '!
                            Order anda pada :</h2>
                        <ul> ' . $tglemail . '</ul> 
                        <h2> sudah kami terima, dan sedang dalam proses.</h2>
                        <h2 style="margin: 0; text-align: center;">Rincian Order Anda</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td>
                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Customer &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;' . $customer . '</h4>
                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Order No &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;' . $orderno . '</h4>
                        <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor Telepon &nbsp;: &nbsp;' . $notelp . '</h4>
                        <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat Antar &nbsp; &nbsp; &nbsp;:</h4>
                        <ul>&nbsp;&nbsp;&nbsp;&nbsp;' . $alamat . '</ul>
                        <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $tglbeli . '&nbsp; ' . $waktubeli . '</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table class="table">';
$ambil = $conn->query("SELECT * FROM pembelian_produk JOIN tblmenu ON pembelian_produk.id_produk = tblmenu.id WHERE pembelian_produk.id_order='$id_pembelian_barusan'");
while ($pecah = $ambil->fetch_assoc()) {
    $mailContent .= '
                                <tr>
                                    <th>
                                        <ul>
                                            <h3 style=" text-align: left;">' . $pecah['nama_produk'] . '</h3>
                                        </ul>
                                    </th>
                                    <td>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    </td>
                                    <td>
                                        <h3>Rp.' . number_format($pecah['harga']) . '</h3>
                                    </td>
                                    <td>
                                        <h3>(' . $pecah['jumlah'] . 'x)</h3>
                                    </td>
                                    <td>
                                        <h3>&nbsp; &nbsp; &nbsp; &nbsp;Rp.' . number_format($pecah['harga'] * $pecah['jumlah']) . '</h3>
                                    </td>
                                </tr>';
    $totalbelanja += $pecah['harga'] * $pecah['jumlah'];
}
$mailContent .= '
<tr>
    <th colspan="4">
        <h3>SubTotal </h3>
    </th>
    <th>
        <h3>&nbsp; &nbsp; &nbsp; &nbsp;Rp.' . number_format($totalbelanja) . '</h3>
    </th>
</tr>
<tr>
    <th colspan="4">
        <h3> Ongkir </h3>
    </th>
    <th>
        <h3>&nbsp; &nbsp; &nbsp; &nbsp;Rp.' . number_format($detail['tarif']) . '</h3>
    </th>
</tr>
<tr>
    <th colspan="4">
        <h3> Unique ID </h3>
    </th>
    <th>
        <h3>&nbsp; &nbsp; &nbsp; &nbsp;Rp.' . number_format($detail['uniq_id']) . '</h3>
    </th>
</tr>
</table>
<hr>
<h2 style=" text-align: right;">Total Pembayaran : Rp. ' . number_format($detail['total_order']) . '</h2>
<hr>
<h2>Segera lunasi order anda, agar pesanan anda dapat segera kami proses!</h2>
</td>
</tr>
<tr>
    <td bgcolor="#D3D3D3" style="padding: 30px 30px;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="color: #000000; font-family: Arial, sans-serif; font-size: 14px;">
                    <p style="margin: 0;">&reg; GAKedai Kafe, Indonesia 2020<br />
                </td>
                <td align="right">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td>
                                <a href="https://twitter.com/GAK_edai">
                                    <img src="https://assets.stickpng.com/images/5a2fe479cc45e43754640849.png" alt="Twitter." width="38" height="38" style="display: block;" border="0" />
                                </a>
                            </td>
                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                            <td>
                                <a href="https://www.facebook.com/GAKedai-109105887563754/">
                                    <img src="https://www.transparentpng.com/thumb/facebook-logo-png/image-black-facebook-logo-png-26.png" alt="Facebook." width="38" height="38" style="display: block;" border="0" />
                                </a>
                            </td>
                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                            <td>
                                <a href="https://www.instagram.com/gakedai/">
                                    <img src="https://assets.stickpng.com/images/5ecec78673e4440004f09e77.png" alt="Instagram." width="38" height="38" style="display: block;" border="0" />
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
</td>
</tr>
</table>';
$mail->Body = $mailContent;
// Kirim email
if ($mail->send()) {
    echo "<script>
    window.location.assign('nota.php?id=" . $id_pembelian_barusan . "')
</script>";
}
