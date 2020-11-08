<?php
namespace content_a\order\comment;


class model
{

	public static function post()
	{

// pending_pay
// pay_successfull
// pending_prepare
// pending_verify
// pending_send
// sending
// deliver
// pay_unverified
// reject
// spam
// expire


		$post           = [];
		if(\dash\request::post('setaction'))
		{
			switch (\dash\request::post('setaction'))
			{
				case 'sending':
					$post['action'] = 'sending';
					break;

				case 'deliver':
					$post['action'] = 'deliver';
					break;

				case 'reject':
					$post['action'] = 'reject';
					break;

				case 'pay_successfull':
					$post['action'] = 'pay_successfull';
					break;

				default:

					break;
			}
		}
		else
		{
			$post['action'] = \dash\request::post('orderaction');
			$post['desc']   = \dash\request::post('desc');
			if(\dash\request::files('file'))
			{
				$post['file']   = \dash\upload\factor::factor_action(\lib\app\factor\get::fix_id(\dash\request::get('id')));
			}
		}

		if(!empty($post))
		{
			\lib\app\factor\action::add($post, \dash\request::get('id'));
		}
		else
		{
			\dash\notif::ok(T_("Please choose an action"));
			return false;
		}


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
