<?php
namespace content_business\home;


class view
{
	public static function config()
	{
		// @todo reza use new class to only load and return store
		\dash\layout\business::check_website();

		switch (\dash\data::website_template())
		{
			case 'comingsoon':
				break;

			case 'visitcard':
				\dash\face::css('business/visitcard-1/visitcard-1.css');
				break;

			default:
				break;
		}
	}
}
?>