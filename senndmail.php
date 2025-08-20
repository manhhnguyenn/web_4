<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $amount = $_POST['amount'];
    $type = $_POST['package'];

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    try {
        // Cấu hình SMTP Hostinger
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply@vaytheoluong247.online'; // Email Hostinger
        $mail->Password = 'Manhthu02@98';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Gửi & nhận
        $mail->setFrom('noreply@vaytheoluong247.online', 'Form Landingpage');
        $mail->addAddress('themanhbn98@gmail.com');

        // Nội dung
        $mail->isHTML(true);
        $mail->Subject = 'Thông tin vay từ landingpage';
        $mail->Body = "
            <strong>Họ tên:</strong> $name<br>
            <strong>SĐT:</strong> $phone<br>
            <strong>Số tiền muốn vay:</strong> $amount<br>
            <strong>Gói vay :</strong> $type
        ";
   
        if ($mail->send()) {
            echo json_encode(["status" => "success", "message" => "Gửi thông tin thành công!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Không thể gửi mail: " . $mail->ErrorInfo]);
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Lỗi khi gửi mail: " . $e->getMessage()]);
    }
}
