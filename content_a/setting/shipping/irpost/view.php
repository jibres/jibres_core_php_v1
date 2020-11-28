<?php
namespace content_a\setting\shipping\irpost;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Calculate IR POST Shipping price'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		$weight = \dash\request::get('weight');
		if($weight)
		{
			$irpostResult = \dash\utility\ir_post::quick_view($weight);
			\dash\data::irpostResult($irpostResult);
		}

	}

}
?>
