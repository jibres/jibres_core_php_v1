<?php
namespace lib\app\cart;


class check
{

	public static function max_limit_product($_count, $_product_detail, $_type = null)
	{
		$ready = \lib\app\product\ready::row($_product_detail);


		if(isset($ready['cart_limit']['sale_step']) && $ready['cart_limit']['sale_step'])
		{
			if(fmod($_count, $ready['cart_limit']['sale_step']))
			{
				if($_type === 'plus_count')
				{
					$_count = $_count + fmod($_count, $ready['cart_limit']['sale_step']);
				}
				elseif($_type === 'minus_count')
				{
					$_count = $_count - fmod($_count, $ready['cart_limit']['sale_step']);
				}
			}
		}

		if(isset($ready['cart_limit']['max_sale']))
		{
			if(floatval($_count) >= floatval($ready['cart_limit']['max_sale']))
			{
				\dash\notif::warn(T_("Can not order more than :val items", ['val' => \dash\fit::number($ready['cart_limit']['max_sale'])]));
				return floatval($ready['cart_limit']['max_sale']);
			}
		}

		if(isset($ready['cart_limit']['min_sale']))
		{
			if(floatval($_count) < floatval($ready['cart_limit']['min_sale']))
			{
				\dash\notif::warn(T_("Can not order less than :val items", ['val' => \dash\fit::number($ready['cart_limit']['min_sale'])]));
				return floatval($ready['cart_limit']['min_sale']);
			}
		}



		return floatval($_count);
	}

	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function cart_user($_args)
	{
		$data             =  [];
		$data['customer'] = \dash\app\user::choose_or_add($_args);

		if(!$data['customer'])
		{
			\dash\notif::error(T_("Please choose customer to add cart"));
			return false;
		}

		return $data;
	}
}
?>