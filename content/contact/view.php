<?php
namespace content\contact;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Contact Us'). ' | '. T_("Jibres"));
		\dash\face::desc(T_('Knowing your valuable comments about bugs and problems and more importantly your precious offers will help us in this way.'));

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-contact-1.jpg');

		\dash\session::set('ticket_load_page_time', time());

		$codeurl = \dash\session::get('temp_ticket_codeurl');
		if($codeurl && !\dash\user::login())
		{
			\dash\data::tempTicketCodeURL($codeurl);
			\dash\session::clean('temp_ticket_codeurl');
		}

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>