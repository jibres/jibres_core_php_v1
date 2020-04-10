<?php
namespace content\bug;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Bug Program'));
		\dash\face::desc("All technology contains bugs. If you've found a security vulnerability, we'd like to help out. By submitting a vulnerability to a program on Jibres.");
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>