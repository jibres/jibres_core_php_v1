<?php
namespace lib\app\factor;


class add
{

	/**
	 * add new factor
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function new_factor($_factor, $_factor_detail, $_option = [])
	{
		$default_option =
		[
			'debug'     => true,
			'factor_id' => null,
			'from_cart' => false,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		// store not loaded!
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"), 'subdomain');
			return false;
		}

		if(!$_option['from_cart'])
		{
			// check permission to add new factor
			\dash\permission::access('factorAccess');
		}

		// check args
		$factor          = \lib\app\factor\check::factor($_factor, $_option);

		$_option['type'] = $factor['type'];

		if(!$factor || !\dash\engine\process::status())
		{
			return false;
		}

		$factor_detail = \lib\app\factor\check_detail::factor_detail($_factor_detail, $_option);

		if(!$factor_detail || !\dash\engine\process::status())
		{
			return false;
		}


		$factor['subprice']    = array_sum(array_column($factor_detail, 'sub_price_temp'));
		$factor['subdiscount'] = array_sum(array_column($factor_detail, 'sub_discount_temp'));
		$factor['subvat']      = array_sum(array_column($factor_detail, 'sub_vat_temp'));;
		$factor['subtotal']    = array_sum(array_column($factor_detail, 'sum'));
		$factor['qty']         = array_sum(array_column($factor_detail, 'count'));
		$factor['item']        = count($factor_detail);
		$factor['discount']    = $factor['discount'];

		$factor_total = floatval($factor['subtotal']) - floatval($factor['discount']);

		if($factor['discount'])
		{
			if(floatval($factor['discount']) > floatval($factor['subtotal']))
			{
				\dash\notif::error(T_("Discount is larger than order total"));
				return false;
			}
		}

		$factor['total']       = $factor_total;

		$factor['status']      = $factor['status'] ? $factor['status'] : 'draft';
		$factor['seller']      = \dash\user::id();
		$factor['date']        = date("Y-m-d H:i:s");
		$factor['title']       = null;
		$factor['pre']         = null;
		$factor['transport']   = null;
		$factor['pay']         = null;
		$factor['desc']        = $factor['desc'];


		// qty field in int(10)
		if( $factor['qty'] && !\dash\validate::int($factor['qty'], false))
		{
			\dash\notif::error(T_("Data is out of range for column qty"), 'qty');
			return false;
		}

		// item field in bigint(20)
		if( $factor['item'] && !\dash\validate::bigint($factor['item'], false))
		{
			\dash\notif::error(T_("Data is out of range for column item"), 'item');
			return false;
		}

		// subprice field in bigint(20)
		if( $factor['subprice'] && !\dash\validate::bigint($factor['subprice'], false))
		{
			\dash\notif::error(T_("Data is out of range for column subprice"), 'subprice');
			return false;
		}

		// subdiscount field in bigint(20)
		if( $factor['subdiscount'] && !\dash\validate::bigint($factor['subdiscount'], false))
		{
			\dash\notif::error(T_("Data is out of range for column subdiscount"), 'subdiscount');
			return false;
		}


		// subtotal field in bigint(20)
		if( $factor['subtotal'] && !\dash\validate::bigint($factor['subtotal'], false))
		{
			\dash\notif::error(T_("Data is out of range for column subtotal"), 'subtotal');
			return false;
		}

		// total field in bigint(20)
		if( $factor['total'] && !\dash\validate::bigint($factor['total'], false))
		{
			\dash\notif::error(T_("Data is out of range for column total"), 'total');
			return false;
		}

		// start transaction of db
		\dash\db::transaction();

		if(!$_option['factor_id'])
		{
			$factor_id = \lib\db\factors\insert::new_record($factor);
		}
		else
		{
			$factor_id = $_option['factor_id'];
		}


		if(!$factor_id)
		{
			\dash\log::set('factor:no:way:to:insert:factor');
			\dash\notif::error(T_("No way to insert factor"));
			\dash\db::rollback();
			return false;
		}

		$return = [];

		$return['factor_id'] = 'JF'. $factor_id;

		$return['price'] = \lib\price::total_down($factor_total);


		$product_need_track_stock = [];

		foreach ($factor_detail as $key => $value)
		{
			$factor_detail[$key]['factor_id'] = $factor_id;
			unset($factor_detail[$key]['sub_price_temp']);
			unset($factor_detail[$key]['sub_discount_temp']);
			unset($factor_detail[$key]['sub_vat_temp']);

			if($value['track_stock_temp'])
			{
				$product_need_track_stock[] = $value;
			}

			unset($factor_detail[$key]['track_stock_temp']);

		}

		$add_detail = \lib\db\factordetails\insert::multi_insert($factor_detail);

		if(!$add_detail)
		{
			\dash\db::rollback();
			return false;
		}

		foreach ($product_need_track_stock as $key => $value)
		{
			\lib\app\product\inventory::set('sale', (floatval($value['count']) * -1), $value['product_id'], $factor_id);
			$get_stock = \lib\app\product\inventory::get($value['product_id']);
			if(!is_null($get_stock))
			{
				if($get_stock <= 0)
				{
					\lib\app\product\edit::out_of_stock($value['product_id']);
				}
			}
		}

		if(\dash\engine\process::status())
		{
			\dash\db::commit();
			\dash\notif::ok(T_("Factor successfuly added"));
		}

		return $return;
	}
}
?>
