<?php
namespace content_account\my\email;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Email'));

		// back
		\dash\data::back_text(T_('Personal info'));
		\dash\data::back_link(\dash\url::this());

		$my_email_list = \dash\app\user\email::get_my_list();

		if(!is_array($my_email_list))
		{
			$my_email_list = [];
		}

		$myList            = [];
		$myList['primary'] = [];
		$myList['verify']  = [];
		$myList['other']   = [];

		foreach ($my_email_list as $key => $value)
		{
			if(a($value, 'primary'))
			{
				$myList['primary'][] = $value;
			}
			elseif(a($value, 'verify'))
			{
				$myList['verify'][] = $value;
			}
			else
			{
				$myList['other'][] = $value;
			}
		}

		\dash\data::myList($myList);

		$email = \dash\request::get('email');
		if($email && \dash\validate::email($email, false))
		{
			\dash\data::myEmail($email);
		}
	}
}
?>
