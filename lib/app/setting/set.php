<?php
namespace lib\app\setting;


class set
{
	public static function product_setting($_args)
	{

		$condition =
		[
			'default_pirce_list' => 'bit',
			'variant_product'    => 'bit',
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'product_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("Product setting saved"));
		return true;

	}

}
?>