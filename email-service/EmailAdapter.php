<?php

use PHPMailer\PHPMailer\PHPMailer;

final class EmailAdapter
{


    private PHPMailer $mail;

    public function __construct(PHPMailer $mail, EmailConfig $config)
    {
        $this->mail = $mail;

        // configuration 
        $this->mail->SMTPDebug  = $config->getSMTPDebug();
        $this->mail->SMTPAuth = $config->isSMPTAuth();
        $this->mail->SMTPSecure = $config->getSMTPSecure();
        $this->mail->Port = $config->getPort();
        $this->mail->Host = $config->getHost();
        $this->mail->Username = $config->getUsername();
        $this->mail->Password = $config->getPassword();
    }

    public function setPattern(string $patternName, array $variables): void
    {
        $patternAbsoulutePath = __DIR__ . '/patterns/' . $patternName . '.txt';
        if (file_exists($patternAbsoulutePath)) {
            $stringMessage = file_get_contents($patternAbsoulutePath);

            $keys  = array_keys($variables);

            foreach ($keys as $key) {

                $stringMessage = str_replace("{{ {$key} }}", $variables[$key], $stringMessage);
            }
          
            $this->mail->Body = $stringMessage;
        } else {
            throw new Exception('The pattern not exists');
        }
    }
    public function setFrom(string $from): void
    {
        $this->mail->From = $from;
    }
    public function setFromName(string $fromName): void
    {
        $this->mail->FromName = $fromName;
    }
    public function setSubject(string $subject): void
    {
        $this->mail->Subject = $subject;
    }

    public function send(): void
    {
        try {
            // $this->mail->send();
            echo $this->mail->Body . PHP_EOL;
            echo "Message has been sent successfully";
        } catch (Exception $e) {
            echo "Mailer Error: " . $this->mail->ErrorInfo;
        }
    }
}
