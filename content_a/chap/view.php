<?php
namespace content_a\chap;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Print factor'));
		\dash\data::page_desc(T_('You can search in list of factors, add new factor and edit existing.'));

		\dash\data::badge_text(T_('Back to dashboard'));
		\dash\data::badge_link(\dash\url::here());

		$id = \dash\request::get('id');
		$factorDetail = \lib\app\factor::get(['id' => $id]);
		\dash\data::factorDetail($factorDetail);


		$printType = \dash\url::child();
		switch ($printType)
		{
			case 'receipt':
			case 'fishprint':
				\dash\data::printFileUrl('content_a/chap/display-receipt.html');
				break;

			case 'a4':
				\dash\data::printFileUrl('content_a/chap/display-receipt.html');
				break;

			case 'a5':
				\dash\data::printFileUrl('content_a/chap/display-receipt.html');
				break;

			default:
				// \dash\data::printFileUrl('content_a/chap/display-receipt.html');
				break;
		}

		\dash\data::pageSize(\dash\request::get('size'));


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
