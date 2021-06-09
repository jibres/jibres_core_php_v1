<?php
namespace dash\email;

require (core.'bin/PHPMailer/Exception.php');
require (core.'bin/PHPMailer/PHPMailer.php');
require (core.'bin/PHPMailer/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;

class mail
{
	public static function send($_args)
	{
		// prepare args
		$emailData = self::prepare($_args);


		// send email
		// detect service
		// detect broker
		// and everything to send email

		$providerData = self::emailProviderSelector();

		// in normal condition send it from local
		// but because of network problem in Iran we need broker!
		// return self::smtp($emailData, $providerData);

		// send to broker and broker send to service
		$result = \dash\email\broker::transfer($emailData, $providerData);

		$emailData['response'] = \dash\temp::get('rawBrokerEmailResponseForHistory');

		// save log in history
		\dash\email\history::set($emailData);
	}


	private static function smtp($_args, $_provider)
	{
		$opt = $_args;
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
			//Enable SMTP authentication
			$mail->SMTPAuth   = true;
			//Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

			// fill provider data
			$via = $_provider['via'];
			//Set the SMTP server to send through
			$mail->Host     = $_provider['smtp_host'];
			//SMTP username
			$mail->Username = $_provider['smtp_username'];
			//SMTP password
			$mail->Password = $_provider['smtp_password'];
			//TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
			$mail->Port     = $_provider['smtp_port'];

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

			$send = $mail->send();

			// echo 'Message has been sent';
			return true;
		} catch (Exception $e)
		{
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			return false;
		}
	}


	private static function emailProviderSelector()
	{
		$provider = [];
		// select service
		$provider['via'] = 'smtp';
		$provider['provider'] = 'sendinblue';
		// load service secrets
		$provider['broker_token']  = \dash\setting\whisper::say('email/sendinblue', 'broker_token');
		$provider['smtp_host']     = \dash\setting\whisper::say('email/sendinblue', 'smtp_host');
		$provider['smtp_username'] = \dash\setting\whisper::say('email/sendinblue', 'smtp_username');
		$provider['smtp_password'] = \dash\setting\whisper::say('email/sendinblue', 'smtp_password');
		$provider['smtp_port']     = \dash\setting\whisper::say('email/sendinblue', 'smtp_port');

		return $provider;
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


	public static function sample($_to = null)
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

		return self::send($sample);
	}
}
?>