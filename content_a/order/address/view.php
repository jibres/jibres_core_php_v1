<?php
namespace content_a\order\address;


class view
{
	public static function config()
	{
		$orderDetail = \dash\data::orderDetail();

		$factor_id = null;

		if(isset($orderDetail['factor']['id_code']))
		{
			$factor_id = $orderDetail['factor']['id_code'];
		}

		\dash\face::title(T_('Edit address'). ' '. $factor_id);

		\dash\data::back_text(T_('Order detail'));
		\dash\data::back_link(\dash\url::this(). '/detail?id='. \dash\request::get('id'));

		$address = \dash\get::index(\dash\data::orderDetail(), 'address');
      	\dash\data::dataRowAddress($address);
	}


}
?>
