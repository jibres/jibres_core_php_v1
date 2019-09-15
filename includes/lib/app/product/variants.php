<?php
namespace lib\app\product;


class variants
{

	public static function set($_variants, $_id)
	{
		// load main product detail
		$product_detail = \lib\app\product::inline_get($_id);
		if(!$product_detail)
		{
			return false;
		}
		// set option variants to app variable
		\dash\app::variable($_variants);

		$variants = self::check_option_variable();
		if(!$variants)
		{
			return false;
		}

		$count = $variants['count'];

		$variants_json = json_encode($variants, JSON_UNESCAPED_UNICODE);
		$result = \lib\db\products\update::variants($variants_json, $product_detail['id']);

		if($result)
		{
			\dash\notif::ok(T_("Your variants was created"));
			return true;
		}
		else
		{
			\dash\log::set('dbErrorProductVariants');
			\dash\notif::error(T_("Sorry!, Cannot insert or update data"));
			return false;
		}
	}


	private static function check_option_variable()
	{

		$optionname1 = self::check_option_name('optionname1');
		$optionname2 = self::check_option_name('optionname2');
		$optionname3 = self::check_option_name('optionname3');

		if(!\dash\engine\process::status())
		{
			return false;
		}

		if($optionname1 === $optionname2)
		{
			\dash\notif::error(T_("Duplicate option name"), ['element' => ['optionname1', 'optionname2']]);
			return false;
		}

		if($optionname3 === $optionname2)
		{
			\dash\notif::error(T_("Duplicate option name"), ['element' => ['optionname3', 'optionname2']]);
			return false;
		}

		if($optionname3 === $optionname1)
		{
			\dash\notif::error(T_("Duplicate option name"), ['element' => ['optionname3', 'optionname1']]);
			return false;
		}

		$optionvalue1 = self::check_option_value('optionvalue1');
		$optionvalue2 = self::check_option_value('optionvalue2');
		$optionvalue3 = self::check_option_value('optionvalue3');

		if(!\dash\engine\process::status())
		{
			return false;
		}

		$variants = [];

		$count = 1;
		if($optionname1 && $optionvalue1)
		{
			$variants['variants'][$optionname1] = $optionvalue1;
			$count *= count($optionvalue1);
		}

		if($optionname2 && $optionvalue2)
		{
			$variants['variants'][$optionname2] = $optionvalue2;
			$count *= count($optionvalue2);
		}

		if($optionname3 && $optionvalue3)
		{
			$variants['variants'][$optionname3] = $optionvalue3;
			$count *= count($optionvalue3);
		}

		$variants['count'] = $count;

		if($count > 100)
		{
			if(\dash\url::isLocal())
			{
				\dash\notif::info("Count product variants = ". $count);
			}

			\dash\notif::error(T_("You can set maximum 100 variants"), ['element' => ['optionvalue1', 'optionvalue2', 'optionvalue3', 'optionname1', 'optionname2', 'optionname3']]);
			return false;
		}

		return $variants;
	}


	private static function check_option_name($_option_name)
	{
		$optionname = \dash\app::request($_option_name);
		if($optionname && mb_strlen($optionname) >= 100)
		{
			\dash\notif::error(T_("Please set option name less than 100 characters"), $_option_name);
			return false;
		}

		return $optionname;
	}


	private static function check_option_value($_option_value)
	{
		$optionvalue = \dash\app::request($_option_value);
		$optionvalue = explode(',', $optionvalue);
		if(is_array($optionvalue))
		{
			foreach ($optionvalue as $key => $value)
			{
				if(mb_strlen($value) >= 100)
				{
					\dash\notif::error(T_("Please set option value less than 100 characters"), $_option_value);
					return false;
				}
			}
		}

		$optionvalue = array_unique($optionvalue);
		$optionvalue = array_filter($optionvalue);

		return $optionvalue;
	}

}
?>