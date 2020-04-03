<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
//发邮件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($email,$body,$subject){

    //实例化和传递'true'启用异常
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码

    //服务设置
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.163.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'y1730447@163.com';                     // SMTP username
    $mail->Password   = 'TBYLDNWFNCLNSDWD';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //收件人
    $mail->setFrom('y1730447@163.com', '书城');//第一个参数要和$mail->Username一致
    $mail->addAddress($email);     //收件人
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // 附件
    //$mail->addAttachment();         // Add attachments
    //$mail->addAttachment();    // Optional name

    // 内容
    $mail->isHTML(true);                                  // 设置html格式
    $mail->Subject = $subject;//标题
    $mail->Body    = $body;//内容
    //$mail->AltBody = '这是非HTML邮件客户端的纯文本正文';

    return $mail->send();
}