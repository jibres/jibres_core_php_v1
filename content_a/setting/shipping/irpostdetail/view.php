<?php
namespace content_a\setting\shipping\irpostdetail;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Calculate IR POST Shipping price'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		$weight = \dash\request::get('w');
		if($weight)
		{
			$meta = [];
			$meta['type']          = \dash\request::get('t');
			$meta['package_type']  = \dash\request::get('p');
			$meta['from_province'] = \dash\request::get('p1');
			$meta['from_city']     = \dash\request::get('c1');
			$meta['location_mode'] = 1;
			$meta['to_province']   = \dash\request::get('p2');
			$meta['to_city']       = \dash\request::get('c2');

			$irpostResult = \dash\utility\ir_post::calculate($weight, $meta);
			\dash\data::irpostResult($irpostResult);
		}

	}

}
?>
