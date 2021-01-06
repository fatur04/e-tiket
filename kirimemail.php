<?php 
require 'PHPMailer/src/PHPMailer.php' ;
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$email = "delantosramos@gmail.com";
$body= "
Dear : $nama <br/><br/>

Terima Kasih telah pesan tiket dari e-tiketpolines.my.id. Untuk cara pembayaran bisa ikuti panduan dibawah ini : <br/><br/>

<table>
	<thead>
		<tr>
			<td>Nomor Virtual Account</td> &#160;&#160;&#160;&#160;
			<td>08788007799</td>
		</tr>
		<tr>
			<td>Akun Pemilik Bank</td> &#160;&#160;&#160;&#160;
			<td>PT. Patur </td>
		</tr>
		<tr>
			<td>Jumlah Transfer</td> &#160;&#160;&#160;&#160;
			<td>Rp. $tarif </td>
		</tr>
	</thead>
</table><br/>

Silahkan login dan kirim bukti pembayaranmu dimenu riwayat pembelian. <br/>
Klik https://e-tiketpolines.my.id/web/login.php <br/><br/>

Salam, <br/>
Tim E-Ticket Polines <br/> ";

$mail =  new PHPMailer\PHPMailer1\PHPMailer();
    $mail->IsSMTP(); 
    $mail->IsHTML(true);
    $mail->SMTPAuth   = true; 
    $mail->Host     = "mail.e-tiketpolines.my.id";
    $mail->Port     = 465;
    $mail->SMTPSecure   = "ssl";
    $mail->Username   = "admin@e-tiketpolines.my.id"; //username SMTP
    $mail->Password   = "jAg42UF)Nnje";   //password SMTP
  $mail->From       = "admin@e-tiketpolines.my.id"; //sender email
  $mail->FromName   = "Admin E-Ticket";      //sender name
  $mail->AddAddress("$email");//recipient: email and name
  $mail->Subject    =  "Percobaan";
  $mail->Body       =  "$body";
 

    $mail->AddAttachment("/cpanel.png","filesaya");
  if($mail->Send()){
     echo "Email sent successfully";
  }else{
   echo "Email failed to send";
  }

 ?>