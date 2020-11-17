<?php
if (!isset($_SESSION)) {
    session_start();
}
require 'functions.php';
include('emailconn.php');
$id_order = $_SESSION['id_order'];
//Fetch data ordernya
$ambilorder = $conn->query("SELECT * FROM daftar_order WHERE id_order='$id_order'");
$detailorder = $ambilorder->fetch_assoc();
$id_pelanggan = $detailorder['id_pelanggan'];
//Fetch data profile pelanggan
$ambilprofile = $conn->query("SELECT * FROM account_google WHERE id='$id_pelanggan'");
$detailprofile = $ambilprofile->fetch_assoc();
$email = $detailprofile['email'];
$name = $detailprofile['nama'];

use PHPMailer\PHPMailer\PHPMailer;  //gausah dirubah
use PHPMailer\PHPMailer\Exception;  //gausah dirubah

require 'phpmailer/src/Exception.php';    //arahkan ke folder phpmailer
require 'phpmailer/src/PHPMailer.php';    //arahkan ke folder phpmailer
require 'phpmailer/src/SMTP.php';    //arahkan ke folder phpmailer
require 'phpmailer/class.phpmailer.php';    //arahkan ke folder phpmailer
require 'phpmailer/PHPMailerAutoload.php';    //arahkan ke folder phpmailer

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
$mail->SMTPDebug  = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = $emailgakedai;                        /////////////////////// ISI DENGAN ALAMAT GMAIL KALIAN
$mail->Password = $pwgakedai;                        /////////////////////// ISI DENGAN PASSWORD GMAIL NYA

//Recipients
$mail->setFrom('noreply@richard.id', 'GAKedai Kafe');
$mail->addAddress($email, $name);     // Add a recipient

$mail->Subject = 'Bukti bayar anda tidak dapat kami verifikasi!';
// Mengatur format email ke HTML
$mail->isHTML(true);
// Konten/isi email
$mailContent = '<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
    <td style="padding: 20px 0 30px 0;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
            style="border-collapse: collapse; border: 1px solid #cccccc;">
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0;">
                    <img src="https://i.ibb.co/t4rrY8K/logo-gakedai.png" width="200" height="200"
                        style="display: block;" />
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="border-collapse: collapse;">
                        <tr>
                            <td style="color: #153643; font-family: Arial, sans-serif;">
                                <h1 style="font-size: 24px; margin: 0; text-align: center;"> Hi, ' . $name . '! Bukti bayar anda dengan </h1>
                                <ul>
                                    <h1 style="text-align: center;">Order ID : #' . $id_order . '</h1>
                                </ul>
                                <h1 style="font-size: 24px; margin: 0; text-align: center;">tidak dapat kami verifikasi!
                                </h1>
                                <h1 style="font-size: 24px; margin: 0; text-align: center;">Harap mengupload kembali bukti bayar yang sesuai.</h1>
                                <h1 style="font-size: 24px; margin: 0; text-align: center;">Terima kasih!</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#D3D3D3" style="padding: 30px 30px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="border-collapse: collapse;">
                        <tr>
                            <td style="color: #000000; font-family: Arial, sans-serif; font-size: 14px;">
                                <p style="margin: 0;">&reg; GAKedai Kafe, Indonesia 2020<br />
                            </td>
                            <td align="right">
                                <table border="0" cellpadding="0" cellspacing="0"
                                    style="border-collapse: collapse;">
                                    <tr>
                                        <td>
                                            <a href="https://twitter.com/GAK_edai">
                                                <img src="https://assets.stickpng.com/images/5a2fe479cc45e43754640849.png"
                                                    alt="Twitter." width="38" height="38" style="display: block;"
                                                    border="0" />
                                            </a>
                                        </td>
                                        <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                        <td>
                                            <a href="https://www.facebook.com/GAKedai-109105887563754/">
                                                <img src="https://www.transparentpng.com/thumb/facebook-logo-png/image-black-facebook-logo-png-26.png"
                                                    alt="Facebook." width="38" height="38" style="display: block;"
                                                    border="0" />
                                            </a>
                                        </td>
                                        <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                        <td>
                                            <a href="https://www.instagram.com/gakedai/">
                                                <img src="https://assets.stickpng.com/images/5ecec78673e4440004f09e77.png"
                                                    alt="Instagram." width="38" height="38" style="display: block;"
                                                    border="0" />
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
    echo "<script>window.location.assign('admin/listOrder.php')</script>";
}
