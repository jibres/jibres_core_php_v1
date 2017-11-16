<?php
namespace lib\app\factor;
use \lib\debug;


trait edit
{
	/**
	 * edit a factor
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_args, $_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		\lib\app::variable($_args);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		$id = \lib\app::request('id');
		$id = \lib\utility\shortURL::decode($id);

		if(!$id || !is_numeric($id))
		{
			\lib\app::log('api:factor:method:put:id:not:set', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Id not set"));
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\app::log('api:factor:edit:store:id:not:set', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Id not set"));
			return false;
		}

		$load_factor = \lib\db\factors::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(empty($load_factor) || !$load_factor || !isset($load_factor['id']))
		{
			\lib\app::log('api:factor:edit:factor:not:found', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Can not access to edit it"), 'factor', 'permission');
			return false;
		}

		$args = self::check($_option);

		if($args === false || !\lib\debug::$status)
		{
			return false;
		}

		if(!\lib\app::isset_request('desc'))           unset($args['desc']);

		if(array_key_exists('title', $args) && !$args['title'])
		{
			\lib\app::log('api:factor:title:not:set:edit', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Title of factor can not be null"), 'title');
			return false;
		}


		if(!empty($args))
		{
			$update = \lib\db\factors::update($args, $load_factor['id']);

			if(isset($args['slug']))
			{
				if(!$update)
				{
					$args['slug'] = self::slug_fix($args);
					$update = \lib\db\factors::update($args, $load_factor['id']);
				}
				// user change slug
				if($load_factor['slug'] != $args['slug'])
				{
					\lib\app::log('api:factor:change:slug', \lib\user::id(), $log_meta);
				}
			}
		}

		$return = [];

		if(\lib\debug::$status)
		{
			\lib\debug::true(T_("Your factor successfully updated"));
		}

		self::clean_cache('var');

		return $return;
	}
}
?>
