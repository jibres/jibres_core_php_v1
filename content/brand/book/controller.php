<?php
namespace content\brand\book;


class controller
{
	public static function routing()
	{
		$lastVersion = '?v=10';

		$dlLink = \dash\url::cdn().'/logo/styleguide/Jibres-brand-styleguide-v4.pdf'. $lastVersion;
		if(\dash\language::current() === 'fa')
		{
			$dlLink = \dash\url::cdn().'/logo/styleguide-fa/Jibres-brand-styleguide-fa-v2.pdf'. $lastVersion;
		}

		\dash\redirect::to($dlLink, false, T_('Jibres Brand Style Guide'));
	}
}
?>