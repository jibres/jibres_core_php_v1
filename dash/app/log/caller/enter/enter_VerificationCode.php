<?php
namespace dash\app\log\caller\enter;


class enter_VerificationCode
{
	public static function site($_args = [])
	{
		$code = isset($_args['data']['mycode']) ? $_args['data']['mycode'] : null;
		$secret = isset($_args['data']['secret']) ? $_args['data']['secret'] : null;

		$code = \dash\fit::text($code);
		$result              = [];
		$result['title']     = T_("Verification code");
		$result['icon']      = 'log-in';
		$result['cat']      = T_("Enter");
		$result['iconClass'] = 'fc-green';

		$excerpt = T_("The verification code has been sent to you");

		$result['excerpt'] = $excerpt;

		$txt = '';
		$txt .= T_("The validation code is made to enter your account");
		$txt .= "<br>";
		$txt .= T_("Be careful! if you did not request this code");
		$txt .= "<br>";
		$txt .= T_("Perhaps someone has entered your password correctly and intends to login to your account!");
		$link = '<a href="'. \dash\url::kingdom(). '/account/security/sessions">'. T_("here"). '</a>';
		$txt .= "<br>";
		$txt .= T_("You can see your active sessions :val", ['val' => $link]);
		$txt .= "<br>";
		$txt .= T_("Or change your password more securely.");

		$result['txt'] = $txt;

		return $result;

	}

	public static function expire()
	{
		return date("Y-m-d H:i:s", time()+(60*5) ); // 5 min
	}

	public static function is_notif()
	{
		return true;
	}

}
?>