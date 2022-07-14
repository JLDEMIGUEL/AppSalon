<?php

namespace Classes;


use Model\Cita;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    
    public $email;
    public $nombre;
    public $token;
    public $idCita;

    public function __construct($email, $nombre, $token, $idCita='')
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        $this->idCita = $idCita;
    }

    public function enviarConfirmacion()
    {
        //Crear objeto email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '2d4af3ba87bfd8';
        $mail->Password = '1aafa1be8167dd';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
        $mail->Subject='Confirma tu cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';

        $contenido="<html>";
        $contenido.="<p><strong>Hola ".$this->nombre.".</strong> Has creado tu cuenta en AppSalon,
        solo debes confirmarla presionando el siguiente enlace.</p>";
        $contenido.="<p>Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'>Confirmar cuenta</a></p>";
        $contenido.="<p>Si no solicitaste esta cuenta, ignore el mensaje</p>";
        $contenido.="</html>";

        $mail->Body=$contenido;

        $mail->send();
    }

    public function enviarConfirmacionCita()
    {
        //Crear objeto email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '2d4af3ba87bfd8';
        $mail->Password = '1aafa1be8167dd';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
        $mail->Subject='Informacion de tu cita';

        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';

        $cita=Cita::find($this->idCita);

        $contenido="<html>";
        $contenido.="<p><strong>Hola ".$this->nombre.".</strong> Has creado una cita en AppSalon</p>";
        $contenido.="<p>Información de la cita:</p>";
        $contenido.="<p>Fecha:".$cita->fecha." </p>";
        $contenido.="<p>Hora:".$cita->hora." </p>";
        $contenido.="<p>Si no solicitaste esta cuenta, ignore el mensaje</p>";
        $contenido.="</html>";

        $mail->Body=$contenido;

        $mail->send();
    }

    public function enviarInstrucciones(){
                //Crear objeto email
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = '2d4af3ba87bfd8';
                $mail->Password = '1aafa1be8167dd';
        
                $mail->setFrom('cuentas@appsalon.com');
                $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
                $mail->Subject='Reestablece tu contraseña';
        
                $mail->isHTML(TRUE);
                $mail->CharSet='UTF-8';
        
                $contenido="<html>";
                $contenido.="<p><strong>Hola ".$this->nombre.".</strong> Has solicitado reestablecer tu
                password, sigue el siguiente enlace para hacerlo.</p>";
                $contenido.="<p>Presiona aqui: <a href='http://localhost:3000/passrecover?token=".$this->token."'>Reestablecer contraseña</a></p>";
                $contenido.="<p>Si no solicitaste esta cuenta, ignore el mensaje</p>";
                $contenido.="</html>";
        
                $mail->Body=$contenido;
        
                $mail->send();
    }
}
