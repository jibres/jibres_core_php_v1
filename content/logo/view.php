<?php
namespace content\logo;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Logo'));
		\dash\face::desc(T_('Our logo represents simplicity, vivacity, agility, scalability and reliability; Values that we believe them as a company.'));

		// btn
		\dash\data::back_text(T_('Jibres Brand'));
		\dash\data::back_link(\dash\url::kingdom().'/brand');
	}
}
?>