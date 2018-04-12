<?php
    require_once dirname(__FILE__).'/../controllers/DwellerController.php';
    require_once dirname(__FILE__).'/../../vendors/vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;


    class Email{
        public static function config(){
            foreach (file(dirname(__FILE__).'/../emailconfig') as $line) {
                list($key, $value) = explode(':', $line, 2) + [NULL, NULL];
                $conf[trim($key)] = trim($value);
            }
            $mail = new PHPMailer(true);  
            //$mail->SMTPDebug = 3;                               // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $conf['SMTPHost'];  // Specify main and backup SMTP servers
            $mail->SMTPAuth = $conf['SMTPauth'];                               // Enable SMTP authentication
            $mail->Port = $conf['Port'];                                    // TCP port to connect to
            $mail->SMTPSecure = $conf["SMTPsecure"];                            // Enable TLS encryption, `ssl` also accepted
            $mail->Username = $conf['username'];                 // SMTP username
            $mail->Password = $conf['password'];                           // SMTP password
            $mail->addReplyTo($conf['username']);
            $mail->CharSet = 'UTF-8';
            return $mail;
        }

        public static function send(){
            try{
                $dweller = DwellerController::read($_GET['id'])[0];
                $mail = self::config();
                $mail->setFrom($mail->Username, 'Email desafio');
                $mail->addAddress($dweller->getEmail());     // Add a recipient
                $file = "README.md";
                //Attachments
                $mail->addAttachment($file, "Arquivo Readme");         // Add attachments

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Arquivo de texto';
                $mail->Body    = 'Segue arquivo de texto Readme ';
                $mail->send();
                header('Location: ../views/dweller/index.php');
            } catch (Exception $e) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        }

    }

    Email::send();
?>