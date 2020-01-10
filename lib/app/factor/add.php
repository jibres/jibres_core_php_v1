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


		// store not loaded!
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"), 'subdomain');
			return false;
		}

		// check permission to add new factor
		\dash\permission::access('factorAccess');

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}


		\dash\app::variable($_factor);
		// check args
		$factor          = \lib\app\factor\check::factor($_option);
		$_option['type'] = $factor['type'];

		if($factor === false || !\dash\engine\process::status())
		{
			return false;
		}

		\dash\app::variable($_factor_detail);

		$factor_detail = \lib\app\factor\check_detail::factor_detail($_option);

		if($factor_detail === false || !\dash\engine\process::status())
		{
			return false;
		}

		$factor['subprice']    = array_sum(array_column($factor_detail, 'sub_price_temp'));
		$factor['subdiscount'] = array_sum(array_column($factor_detail, 'sub_discount_temp'));
		$factor['subvat']      = array_sum(array_column($factor_detail, 'sub_vat_temp'));;
		$factor['subtotal']    = array_sum(array_column($factor_detail, 'sum'));
		$factor['qty']         = array_sum(array_column($factor_detail, 'count'));
		$factor['item']        = count($factor_detail);
		$factor['discount']    = null;
		$factor['total']       = intval($factor['subtotal']) - intval($factor['discount']);
		$factor['status']      = 'draft';

		// qty field in int(10)
		if(\dash\number::is_larger($factor['qty'], 999999999))
		{
			\dash\notif::error(T_("Data is out of range for column qty"), 'qty');
			return false;
		}

		// item field in bigint(20)
		if(\dash\number::is_larger($factor['item'], 9999999999999999999))
		{
			\dash\notif::error(T_("Data is out of range for column item"), 'item');
			return false;
		}

		// subprice field in bigint(20)
		if(\dash\number::is_larger($factor['subprice'], 9999999999999999999))
		{
			\dash\notif::error(T_("Data is out of range for column subprice"), 'subprice');
			return false;
		}

		// subdiscount field in bigint(20)
		if(\dash\number::is_larger($factor['subdiscount'], 9999999999999999999))
		{
			\dash\notif::error(T_("Data is out of range for column subdiscount"), 'subdiscount');
			return false;
		}


		// subtotal field in bigint(20)
		if(\dash\number::is_larger($factor['subtotal'], 9999999999999999999))
		{
			\dash\notif::error(T_("Data is out of range for column subtotal"), 'subtotal');
			return false;
		}

		// total field in bigint(20)
		if(\dash\number::is_larger($factor['total'], 9999999999999999999))
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

		foreach ($factor_detail as $key => $value)
		{
			$factor_detail[$key]['factor_id'] = $factor_id;
			unset($factor_detail[$key]['sub_price_temp']);
			unset($factor_detail[$key]['sub_discount_temp']);
			unset($factor_detail[$key]['sub_vat_temp']);
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
