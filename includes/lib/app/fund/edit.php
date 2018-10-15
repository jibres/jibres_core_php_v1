<?php
namespace lib\app\fund;


trait edit
{

	/**
	 * edit a fund
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_args, $_id, $_option = [])
	{
		if(!\lib\userstore::in_store())
		{
			\dash\notif::error(T_("You are not in this store"), 'subdomain');
			return false;
		}

		\dash\app::variable($_args);

		$id = \dash\coding::decode($_id);

		$args = self::check($id);


		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(array_key_exists('status', $args) && !$args['status'])
		{
			unset($args['status']);
		}

		if(!\dash\app::isset_request('status')) unset($args['status']);

		if(!empty($args))
		{
			$update = \lib\db\funds::update($args, $id);
		}

	}
}
?>