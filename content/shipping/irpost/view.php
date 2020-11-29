<?php
namespace content\shipping\irpost;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Postal Service Shipping Calculator'));
		\dash\face::desc(T_("Determining the cost of shipping domestically is now made easy. Simply fill in the blanks, and let our online calculator figure out your postage."));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-shipping-1.jpg');


		$weight = \dash\request::get('w');
		if(is_numeric($weight) || $weight)
		{
			$meta                  = [];
			$meta['detail']        = 1;
			$meta['type']          = \dash\request::get('t');
			$meta['package_type']  = \dash\request::get('p');
			$meta['from_province'] = \dash\request::get('p1');
			$meta['from_city']     = \dash\request::get('c1');
			$meta['send_type']     = \dash\request::get('sendtype');
			$meta['to_province']   = \dash\request::get('p2');
			$meta['to_city']       = \dash\request::get('c2');

			$irpostResult = \dash\utility\ir_post::calculate($weight, $meta);
			\dash\data::irpostResult($irpostResult);
		}

	}

}
?>
