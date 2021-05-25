<?php
namespace dash;

require (core.'bin/PHPMailer/Exception.php');
require (core.'bin/PHPMailer/PHPMailer.php');
require (core.'bin/PHPMailer/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;

class mail
{
	public static function sendPHPMailer($_args)
	{
		$opt = self::prepare($_args);

		//Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			//Enable verbose debug output
			// $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;

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
			$testFile = file_get_contents(\dash\url::cdn().'/email/campaign/nowruz1400/index.html');
			$mail->Body = $testFile;

			if(isset($opt['altbody']))
			{
				$mail->AltBody = $opt['altbody'];
			}

			$mail->send();
			// echo 'Message has been sent';
			return true;
		} catch (Exception $e)
		{
			echo "11";
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
			'altbody'   => null,
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
			'fromTitle' => 'Jibres',
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



	public static function send($_args)
	{
		$default_args =
		[
			'from'    => 'no-reply@jibres.store',
			'to'      => null,
			'subject' => null,
			'body'    => null,
			'altbody' => null,
			'is_html' => true,
			'debug'   => true,
		];
		if(!is_array($_args))
		{
			$_args = [];
		}
		$_args = array_merge($default_args, $_args);
			$senderName = T_(ucfirst(\dash\url::root()));

		$mail = new \PHPMailer\PHPMailer\PHPMailer;

		//Set who the message is to be sent from
		$mail->setFrom($_args['from'], $senderName);
		$mail->addAddress($_args['to']);
		// $mail->isHTML($_args['is_html'] ? true : false);
		$mail->Subject = $_args['subject'];
		$mail->AltBody = $_args['altbody'];
		$mail->Body    = $_args['body'];

		//send the message, check for errors
		if (!$mail->send())
		{
			if($_args['debug'])
			{
				\dash\notif::error(T_("Mailer Error :error", ['error' => $mail->ErrorInfo]));
			}
		    return false;
		}
		else
		{
		    return true;
		}


		// $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
		// try
		// {
		// 	// Server settings - smtp
		// 	// $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		// 	// $mail->isSMTP();                                      // Set mailer to use SMTP
		// 	// $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
		// 	// $mail->SMTPAuth = true;                               // Enable SMTP authentication
		// 	// $mail->Username = 'user@example.com';                 // SMTP username
		// 	// $mail->Password = 'secret';                           // SMTP password
		// 	// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		// 	// $mail->Port = 587;                                    // TCP port to connect to

		// 	// use sendmail
		// 	// $mail->isSendmail();


		// 	//Recipients
		// 	$senderName = T_(ucfirst(\dash\url::root()));
		// 	$mail->setFrom('info@ermile.com', $senderName);
		// 	// $mail->setFrom('info@ermile.com', $senderName, 0);

		// 	//Set who the message is to be sent to
		// 	$mail->addAddress($_to);
		// 	// $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient

		// 	//Set the subject line
		// 	$mail->Subject = $_subject;

		// 	//Read an HTML message body from an external file, convert referenced images to embedded,
		// 	//convert HTML into a basic plain-text alternative body
		// 	$mail->msgHTML($_msg);

		// 	//Content
		// 	$mail->isHTML(true);                                  // Set email format to HTML
		// 	$mail->Subject = 'Here is the subject';
		// 	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		// 	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		// 	$mail->send();
		// 	\dash\notif::info('Message has been sent');
		// }
		// catch (\Exception $e)
		// {
		// 	// \dash\notif::error('Message could not be sent. Mailer Error: ', $e->ErrorInfo);
		// 	\dash\notif::error(htmlspecialchars($e->getMessage()));
		// }
	}
}
?>