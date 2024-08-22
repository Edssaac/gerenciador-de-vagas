<?php

namespace Library;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Library\Log;

class Mail
{
    public static function send($addresses, $subject, $body, $alt_body = '', $attachments = [], $ccs = [], $bccs = []): bool
    {
        $mail = new PHPMailer(true);

        if (empty($alt_body)) {
            $alt_body = 'Erro ao carregar HTML!';
        }

        try {
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'smtp.gmail.com';
            $mail->Username = $_ENV['MAIL_ADDRESS'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];

            $mail->setFrom($_ENV['MAIL_ADDRESS'], $_ENV['MAIL_USERNAME']);
            $mail->addReplyTo($_ENV['MAIL_ADDRESS'], $_ENV['MAIL_USERNAME']);

            $addresses = is_array($addresses) ? $addresses : [$addresses];

            foreach ($addresses as $address) {
                $mail->addAddress($address);
            }

            $attachments = is_array($attachments) ? $attachments : [$attachments];

            foreach ($attachments as $attachment) {
                $mail->addAttachment($attachment);
            }

            $ccs = is_array($ccs) ? $ccs : [$ccs];

            foreach ($ccs as $cc) {
                $mail->addCC($cc);
            }

            $bccs = is_array($bccs) ? $bccs : [$bccs];

            foreach ($bccs as $bcc) {
                $mail->addBCC($bcc);
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $alt_body;

            return $mail->send();
        } catch (Exception $e) {
            Log::write(sprintf(
                'Exceção ao enviar email: %s',
                $e->getMessage()
            ));

            return false;
        }
    }
}
