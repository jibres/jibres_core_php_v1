<?php
namespace dash\email;

require (core.'bin/PHPMailer/Exception.php');
require (core.'bin/PHPMailer/PHPMailer.php');
require (core.'bin/PHPMailer/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;

class mail
{
	public static function sendPHPMailerBroker($_args)
	{
		// get settings
		\dash\setting\sendgrid::smtp_host();
		\dash\setting\sendgrid::smtp_username();
		\dash\setting\sendgrid::smtp_password();
		\dash\setting\sendgrid::smtp_port();
	}

	public static function sendPHPMailer($_args)
	{
		$opt = self::prepare($_args);

		//Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			//Enable verbose debug output
			if(\dash\url::content() === 'love' && \dash\url::module() === 'email')
			{
				// $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
				// to debug connection
				$mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_CONNECTION;
			}

			//Send using SMTP
			$mail->isSMTP();

			//Set the SMTP server to send through
			$mail->Host       = 'smtp-relay.sendinblue.com';
			//Enable SMTP authentication
			$mail->SMTPAuth   = true;
			//SMTP username
			$mail->Username   = 'mr.javad.adib@gmail.com';
			//SMTP password
			$mail->Password   = 'Vx5k2LbmBXjd90Ep';
			//Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			//TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
			$mail->Port       = 587;
			// check and find email provider


			//Recipients
			$mail->setFrom($opt['from'], $opt['fromTitle']);

			if(isset($opt['to']))
			{
				//Add a recipient
				$mail->addAddress($opt['to']);
			}

			//Content
			//Set email format to HTML
			$mail->isHTML(true);

			if(isset($opt['subject']))
			{
				$mail->Subject = $opt['subject'];
			}

			if(isset($opt['body']))
			{
				$mail->Body = $opt['body'];
			}

			if(isset($opt['altbody']))
			{
				$mail->AltBody = $opt['altbody'];
			}

			// save log in history
			\dash\email\history::set($_args);

			$mail->send();
			// echo 'Message has been sent';
			return true;
		} catch (Exception $e)
		{
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			return false;
		}
	}


	private static function prepare($_args)
	{
		$default_args =
		[
			'from'      => 'no-reply@jibres.store',
			'fromTitle' => 'Jibres',
			'to'        => null,
			'subject'   => null,
			'body'      => null,
			'altbody'   => T_('Html is not loaded on this email'),
			'is_html'   => true,
			'debug'     => true,
		];
		if(!is_array($_args))
		{
			$_args = [];
		}
		$_args = array_merge($default_args, $_args);

		return $_args;
	}


	public static function sampleEmail($_to = null)
	{
		$sample =
		[
			'from'      => 'no-reply@jibres.store',
			'fromTitle' => T_('Jibres'),
			'to'        => "Mr.Javad.Adib@gmail.com",
			'subject'   => "Test ". rand(1,100),
			'body'      => "Salam 123",
			'altbody'   => "Html is not loaded on this email",
		];

		if(isset($_to))
		{
			$sample['to'] = $_to;
		}

		return self::sendPHPMailer($sample);
	}
}
?>