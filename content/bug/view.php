<?php
namespace content\bug;


class view
{

	public static function config()
	{

		\dash\face::title(T_('Jibres Bug Program'));
		\dash\face::desc(T_("All technology contains bugs. If you've found a security vulnerability, we'd like to help out. By submitting a vulnerability to a program on Jibres."));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-bug-1.jpg');

		\dash\data::global_scriptPage('matrix.js');

		\dash\session::set('ticket_load_page_time', time());

		$codeurl = \dash\session::get('temp_ticket_codeurl');
		if($codeurl && !\dash\user::login())
		{
			\dash\data::tempTicketCodeURL($codeurl);
			\dash\session::clean('temp_ticket_codeurl');
		}

	}
}
?>