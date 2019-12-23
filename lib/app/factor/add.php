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
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		\dash\permission::access('factorAccess');

		if(!\lib\store::id())
		{
			\dash\log::set('factor:store_id:notfound');
			\dash\notif::error(T_("Store not found"), 'subdomain');
			return false;
		}

		// start transaction of db
		\dash\db::transaction();

		\dash\app::variable($_factor);
		// check args
		$factor          = \lib\app\factor\check::factor($_option);
		$_option['type'] = $factor['type'];

		if($factor === false || !\dash\engine\process::status())
		{
			\dash\db::rollback();
			return false;
		}

		\dash\app::variable($_factor_detail);

		$factor_detail = \lib\app\factor\check::factor_detail($_option);

		if($factor_detail === false || !\dash\engine\process::status())
		{
			\dash\db::rollback();
			return false;
		}


		$return = [];

		$qty_sum = 0;

		foreach ($factor_detail as $key => $value)
		{
			$sum                      = (floatval($value['price']) * floatval($value['count']));
			$discount = 0;

			if(isset($value['discount']))
			{
				$discount                 = (floatval($value['discount']) * floatval($value['count']));
			}

			if(isset($value['count']))
			{
				$qty_sum                 += floatval($value['count']);
			}

			$factor['detailsum']      += $sum;
			$factor['detaildiscount'] += $discount;
			$factor['detailtotalsum'] += $sum - $discount;
		}

		// $factor['qty']      = array_sum(array_column($factor_detail, 'count'));
		$factor['qty']      = $qty_sum;
		$factor['item']     = count($factor_detail);
		$factor['vat']      = null;
		$factor['discount'] = null;
		$factor['status']   = 'draft';
		$factor['sum']      = floatval($factor['detailtotalsum']) - floatval($factor['discount']);

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

		$return['factor_id'] = \dash\coding::encode($factor_id);

		foreach ($factor_detail as $key => $value)
		{
			$factor_detail[$key]['factor_id'] = $factor_id;
		}

		$add_detail = \lib\db\factordetails\insert::multi_insert($factor_detail);

		if(!$add_detail)
		{
			\dash\db::rollback();
			return false;
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
