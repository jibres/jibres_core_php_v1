<?php
namespace content_a\chap;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Print factor'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/order/detail?id='. \dash\request::get('id'));

		$id = \dash\request::get('id');

		$myFactor = \lib\app\factor\get::full($id);
		\dash\data::factorInfo($myFactor);


		if(isset($myFactor['factor']) && is_array($myFactor['factor']))
		{
			\dash\data::invoice($myFactor['factor']);
		}

		if(isset($myFactor['factor_detail']) && is_array($myFactor['factor_detail']))
		{
			\dash\data::invoiceDetail($myFactor['factor_detail']);
		}


		if(isset($myFactor['address']) && is_array($myFactor['address']))
		{
			\dash\data::address($myFactor['address']);
		}

		if(isset($myFactor['factor']['customer_detail']) && is_array($myFactor['factor']['customer_detail']))
		{
			\dash\data::customer($myFactor['factor']['customer_detail']);
		}


		$storeData = \dash\data::store_store_data();

		\dash\data::storeData($storeData);

		$seller_address =
		[
			'country'  => a($storeData, 'country'),
			'province' => a($storeData, 'province'),
			'city'     => a($storeData, 'city'),
			'address'  => a($storeData, 'address'),
			'mobile'   => a($storeData, 'mobile'),
			'postcode' => a($storeData, 'postcode'),
			'phone'    => a($storeData, 'phone'),
			'fax'      => a($storeData, 'fax'),
		];

		if(a($storeData, 'factor_address'))
		{
			$seller_address =
			[
				'country'  => a($storeData, 'factor_country'),
				'province' => a($storeData, 'factor_province'),
				'city'     => a($storeData, 'factor_city'),
				'address'  => a($storeData, 'factor_address'),
				'mobile'   => a($storeData, 'factor_mobile'),
				'postcode' => a($storeData, 'factor_postcode'),
				'phone'    => a($storeData, 'factor_phone'),
				'fax'      => a($storeData, 'factor_fax'),
			];
		}

		$seller_address = \dash\app\address::ready($seller_address);
		\dash\data::sellerAddress($seller_address);

		$printSize  = \dash\url::child();
		$printModel = \dash\request::get('model');
		switch ($printSize)
		{
			case 'receipt':
			case 'fishprint':
				switch ($printModel)
				{
					case 'long':
						\dash\data::printFileUrl(root. 'content_a/chap/size-receipt/receipt-long.php');
						break;

					case 'short':
						\dash\data::printFileUrl(root. 'content_a/chap/size-receipt/receipt-short.php');
						break;

					default:
						\dash\data::printFileUrl(root. 'content_a/chap/size-receipt/receipt.php');
						break;
				}
				break;

			case 'a4':
				switch ($printModel)
				{
					case 'landscape':
						\dash\data::printFileUrl(root. 'content_a/chap/size-a4/a4-1.php');
						\dash\data::include_m2('wide');
						\dash\data::paperSize('A4.landscape');
						break;

					case 'portrait':
					default:
						\dash\data::printFileUrl(root. 'content_a/chap/size-a4/a4-1.php');
						\dash\data::include_m2('wide');
						\dash\data::paperSize('A4');
						break;
				}
				break;

			case 'a5':
						\dash\data::printFileUrl(root. 'content_a/chap/size-a4/a4-1.php');
						\dash\data::include_m2('wide');
						\dash\data::paperSize('A5');
				break;

			default:
				// \dash\data::printFileUrl(root. 'content_a/chap/size-receipt/receipt.php');
				break;
		}

		\dash\data::pageSize(\dash\request::get('size'));
		\dash\face::btnPrint(true);

		\dash\face::btnNext(\dash\url::here(). '/order/next/'. \dash\request::get('id'). '?c='. \dash\url::child());
		\dash\face::btnPrev(\dash\url::here(). '/order/prev/'. \dash\request::get('id'). '?c='. \dash\url::child());
	}
}
?>
