<?php

namespace App;



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../src/vendor/autoload.php';

/*require dirname(__DIR__, 3) . '/webshop/vendor/PHPMailer/src/Exception.php';
require dirname(__DIR__, 3) . '/webshop/vendor/PHPMailer/src/PHPMailer.php';
require dirname(__DIR__, 3) . '/webshop/vendor/PHPMailer/src/SMTP.php';*/


class Email
{
    protected PHPMailer $php_mailer;

    public function __construct(array $mail_config)
    {
        $this->php_mailer = new PHPMailer(true);
        $this->php_mailer->isSMTP();
        $this->php_mailer->Host       = $mail_config['host'];
        $this->php_mailer->Port       = $mail_config['port'];
        $this->php_mailer->SMTPAuth   = true;
        $this->php_mailer->Username   = $mail_config['username'];
        $this->php_mailer->Password   = $mail_config['password'];
        $this->php_mailer->SMTPSecure = $mail_config['sec'];
        $this->php_mailer->isHTML(true);
    }

    public function send_mail(string $from, string $to, string $subject, string $text): bool
    {
        try {
            $this->php_mailer->setFrom($from);
            $this->php_mailer->addAddress($to);
            $this->php_mailer->Subject = $subject;
            $this->php_mailer->Body    = '<DOCTYPE html><html lang="en"><body>' . $text . '</body></html>';

            $this->php_mailer->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
