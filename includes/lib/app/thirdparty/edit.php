<?php
namespace lib\app\thirdparty;


trait edit
{

	/**
	 * edit a thirdparty
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_args, $_id, $_option = [])
	{
		\lib\app::variable($_args);

		$result = self::get($_id);

		if(!$result)
		{
			return false;
		}

		$id = \lib\coding::decode($_id);

		$args = self::check($id);

		if($args === false || !\lib\engine\process::status())
		{
			return false;
		}

		if(isset($args['code']) && $args['code'])
		{
			$check_duplicate =
			[
				'code'  => $args['code'],
				'store_id' => \lib\store::id(),
				'limit'    => 1,
			];

			$check_duplicate = \lib\db\userstores::get($check_duplicate);

			if(isset($check_duplicate['id']))
			{
				if(intval($check_duplicate['id']) === intval($id))
				{
					// no thing
				}
				else
				{
					\lib\notif::error(T_("Duplicate customer code in this store"), 'code');
					return false;
				}
			}
		}

		// no change type of user for every!

		if(!\lib\app::isset_request('status'))      unset($args['status']);
		if(!\lib\app::isset_request('mobile'))      unset($args['mobile']);
		if(!\lib\app::isset_request('code'))        unset($args['code']);
		if(!\lib\app::isset_request('email'))       unset($args['email']);
		if(!\lib\app::isset_request('shfrom'))      unset($args['shfrom']);
		if(!\lib\app::isset_request('nationalcode'))unset($args['nationalcode']);
		if(!\lib\app::isset_request('pasportcode')) unset($args['pasportcode']);
		if(!\lib\app::isset_request('nationalcode'))unset($args['nationalcode']);
		if(!\lib\app::isset_request('pasportcode')) unset($args['pasportcode']);
		if(!\lib\app::isset_request('firstname'))   unset($args['firstname']);
		if(!\lib\app::isset_request('lastname'))    unset($args['lastname']);
		if(!\lib\app::isset_request('father'))      unset($args['father']);
		if(!\lib\app::isset_request('birthday'))    unset($args['birthday']);
		if(!\lib\app::isset_request('pasportdate')) unset($args['pasportdate']);
		if(!\lib\app::isset_request('gender'))      unset($args['gender']);
		if(!\lib\app::isset_request('marital'))     unset($args['marital']);
		if(!\lib\app::isset_request('shcode'))      unset($args['shcode']);
		if(!\lib\app::isset_request('birthcity'))   unset($args['birthcity']);
		if(!\lib\app::isset_request('zipcode'))     unset($args['zipcode']);
		if(!\lib\app::isset_request('avatar'))      unset($args['avatar']);
		if(!\lib\app::isset_request('city'))        unset($args['city']);
		if(!\lib\app::isset_request('province'))    unset($args['province']);
		if(!\lib\app::isset_request('country'))     unset($args['country']);
		if(!\lib\app::isset_request('address'))     unset($args['address']);
		if(!\lib\app::isset_request('phone'))       unset($args['phone']);

		if($args['type'] === 'supplier')
		{
			// no thing
		}
		else
		{
			if(!\lib\app::isset_request('desc'))           unset($args['desc']);
			if(!\lib\app::isset_request('displayname'))    unset($args['displayname']);
		}

		unset($args['type']);

		if(!empty($args))
		{
			$update = \lib\db\userstores::update($args, $id);

			if(\lib\engine\process::status())
			{
				\lib\notif::ok(T_("Thirdparty successfully updated"));
			}
		}

	}
}
?>