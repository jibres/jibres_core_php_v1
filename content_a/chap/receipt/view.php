<?php
namespace content_a\chap\receipt;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Print factor'));
		\dash\data::page_desc(T_('You can search in list of factors, add new factor and edit existing.'));

		\dash\data::badge_text(T_('Back to dashboard'));
		\dash\data::badge_link(\dash\url::here());



		\dash\data::pageSize(\dash\request::get('size'));

		$id = \dash\request::get('id');
		$factorDetail = \lib\app\factor::get(['id' => $id]);
		\dash\data::factorDetail($factorDetail);

		if(isset($factorDetail['factor']['type']))
		{
			switch ($factorDetail['factor']['type'])
			{
				case 'buy':
					\dash\data::badge_text(T_('Back to last buy'));
					\dash\data::badge_link(\dash\url::here(). '/factor?type=buy');
				case 'sale':
					\dash\data::badge_text(T_('Back to last sales'));
					\dash\data::badge_link(\dash\url::here(). '/factor?type=sale');
					break;

				default:
					# code...
					break;
			}
		}
	}
}
?>
