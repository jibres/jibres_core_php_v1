<?php
namespace content_a\chap;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Print factor'));
		\dash\data::page_desc(T_('You can search in list of factors, add new factor and edit existing.'));


		// back
		\dash\data::page_backText(T_('Factors'));
		\dash\data::page_backLink(\lib\backlink::factor());

		$id = \dash\request::get('id');

		$factorDetail = \lib\app\factor\get::full($id);

		\dash\data::factorDetail($factorDetail);




		$printSize  = \dash\url::child();
		$printModel = \dash\request::get('model');
		switch ($printSize)
		{
			case 'receipt':
			case 'fishprint':
				switch ($printModel)
				{
					case 'long':
						\dash\data::printFileUrl('content_a/chap/size-receipt/receipt-long.html');
						break;

					case 'short':
						\dash\data::printFileUrl('content_a/chap/size-receipt/receipt-short.html');
						break;

					default:
						\dash\data::printFileUrl('content_a/chap/size-receipt/receipt.html');
						break;
				}
				break;

			case 'a4':
				\dash\data::printFileUrl('content_a/chap/size-a4/a4.html');
				break;

			case 'a5':
				\dash\data::printFileUrl('content_a/chap/size-a4/a4.html');
				break;

			default:
				// \dash\data::printFileUrl('content_a/chap/size-receipt/receipt.html');
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
