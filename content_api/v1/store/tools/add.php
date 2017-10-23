<?php
namespace content_api\v1\store\tools;
use \lib\utility;
use \lib\debug;
use \lib\db\logs;
trait add
{


	public function add_store($_args = [])
	{
		$edit_mode = false;
		$default_args =
		[
			'method' => 'post',
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_args, $_args);

		// debug::title(T_("Operation Faild"));

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => utility::request(),
			]
		];

		if(!$this->user_id)
		{
			logs::set('api:store:user_id:notfound', null, $log_meta);
			debug::error(T_("User not found"), 'user', 'permission');
			return false;
		}

		$name = utility::request('name');
		$name = trim($name);
		if(!$name && $_args['method'] === 'post')
		{
			logs::set('api:store:name:not:set', $this->user_id, $log_meta);
			debug::error(T_("Store name of store can not be null"), 'name', 'arguments');
			return false;
		}

		if(mb_strlen($name) > 100)
		{
			logs::set('api:store:maxlength:name', $this->user_id, $log_meta);
			debug::error(T_("Store name must be less than 100 character"), 'name', 'arguments');
			return false;
		}

		$website = utility::request('website');
		$website = trim($website);
		if($website && mb_strlen($website) >= 200)
		{
			logs::set('api:store:maxlength:website', $this->user_id, $log_meta);
			debug::error(T_("Store website must be less than 200 character"), 'website', 'arguments');
			return false;
		}


		$slug = utility::request('slug');
		$slug = trim($slug);

		if(!$slug && !$name && $_args['method'] === 'post')
		{
			logs::set('api:store:slug:not:sert', $this->user_id, $log_meta);
			debug::error(T_("slug of store can not be null"), 'slug', 'arguments');
			return false;
		}

		// get slug of name in slug if the slug is not set
		if(!$slug && $name)
		{
			$slug = \lib\utility\shortURL::encode((int) $this->user_id + (int) rand(10000,99999) * 10000);
			// $slug = \lib\utility\filter::slug($name);
		}

		// remove - from slug
		// if the name is persian and slug not set
		// we change the slug as slug of name
		// in the slug we have some '-' in return
		$slug = str_replace('-', '', $slug);

		if($slug && mb_strlen($slug) < 5)
		{
			logs::set('api:store:minlength:slug', $this->user_id, $log_meta);
			debug::error(T_("Store slug must be larger than 5 character"), 'slug', 'arguments');
			return false;
		}

		if($slug && !preg_match("/^[A-Za-z0-9]+$/", $slug))
		{
			logs::set('api:store:invalid:slug', $this->user_id, $log_meta);
			debug::error(T_("Only [A-Za-z0-9] can use in store slug"), 'slug', 'arguments');
			return false;
		}

		// check slug
		if($slug && mb_strlen($slug) >= 50)
		{
			logs::set('api:store:maxlength:slug', $this->user_id, $log_meta);
			debug::error(T_("Store slug must be less than 500 character"), 'slug', 'arguments');
			return false;
		}

		$desc = utility::request('desc');
		if($desc && mb_strlen($desc) > 200)
		{
			logs::set('api:store:maxlength:desc', $this->user_id, $log_meta);
			debug::error(T_("Store desc must be less than 200 character"), 'desc', 'arguments');
			return false;
		}

		$logo_id = null;
		$logo_url = null;

		$logo = utility::request('logo');
		if($logo)
		{
			$logo_id = \lib\utility\shortURL::decode($logo);
			if($logo_id)
			{
				$logo_record = \lib\db\posts::is_attachment($logo_id);
				if(!$logo_record)
				{
					$logo_id = null;
				}
				elseif(isset($logo_record['meta']['url']))
				{
					$logo_url = $logo_record['meta']['url'];
				}
			}
			else
			{
				$logo_id = null;
			}
		}

		$parent = null;

		$parent = utility::request('parent');
		if($parent)
		{
			$parent = \lib\utility\shortURL::decode($parent);
		}

		if($parent)
		{
			// check this store and the parent store have one owner
			$check_owner = \lib\db\stores::get(['id' => $parent, 'creator' => $this->user_id, 'limit' => 1]);
			if(is_array($check_owner) && !array_key_exists('parent', $check_owner))
			{
				logs::set('api:store:parent:owner:not:match', $this->user_id, $log_meta);
				debug::error(T_("The parent is not in your store"), 'parent', 'arguments');
				return false;
			}
		}


		$lang = utility::request('language');
		if($lang && (mb_strlen($lang) !== 2 || !utility\location\languages::check($lang)))
		{
			logs::set('api:store:invalid:lang', $this->user_id, $log_meta);
			debug::error(T_("Invalid language field"), 'language', 'arguments');
			return false;
		}

		$country           = utility::request('country');
		if($country && mb_strlen($country) > 50)
		{
			logs::set('api:store:add:country:max:lenght', $this->user_id, $log_meta);
			debug::error(T_("You must set country less than 50 character", 'country', 'arguments'));
			return false;
		}

		$province          = utility::request('province');
		if($province && mb_strlen($province) > 50)
		{
			logs::set('api:store:add:province:max:lenght', $this->user_id, $log_meta);
			debug::error(T_("You must set province less than 50 character", 'province', 'arguments'));
			return false;
		}

		$city              = utility::request('city');
		if($city && mb_strlen($city) > 50)
		{
			logs::set('api:store:add:city:max:lenght', $this->user_id, $log_meta);
			debug::error(T_("You must set city less than 50 character", 'city', 'arguments'));
			return false;
		}

		$tel               = utility::request('tel');
		if($tel && mb_strlen($tel) > 50)
		{
			logs::set('api:store:add:tel:max:lenght', $this->user_id, $log_meta);
			debug::error(T_("You must set tel less than 50 character", 'tel', 'arguments'));
			return false;
		}

		$zipcode           = utility::request('zipcode');
		if($zipcode && mb_strlen($zipcode) > 50)
		{
			logs::set('api:store:add:zipcode:max:lenght', $this->user_id, $log_meta);
			debug::error(T_("You must set zipcode less than 50 character", 'zipcode', 'arguments'));
			return false;
		}

		$status = utility::request('status');
		if($status && !in_array($status, ['enable', 'disable']))
		{
			logs::set('api:store:add:status:invalid', $this->user_id, $log_meta);
			debug::error(T_("Invalid status of stores", 'status', 'arguments'));
			return false;
		}


		$args             = [];
		$args['name']     = $name;
		$args['slug']     = $slug;
		$args['creator']  = $this->user_id;
		$args['website']  = $website;
		$args['desc']     = $desc;
		$args['lang']     = $lang;
		$args['logo']     = $logo_url;
		$args['parent']   = $parent ? $parent : null;
		$args['country']  = $country;
		$args['province'] = $province;
		$args['city']     = $city;
		$args['phone']    = $tel;
		$args['zipcode']  = $zipcode;

		$return = [];

		\lib\temp::set('last_store_added', $slug);

		if($_args['method'] === 'post')
		{
			$store_id = \lib\db\stores::insert($args);

			if(!$store_id)
			{
				$args['slug'] = $this->slug_fix($args);
				$store_id     = \lib\db\stores::insert($args);
			}

			if(!$store_id)
			{
				logs::set('api:store:no:way:to:insert:store', $this->user_id, $log_meta);
				debug::error(T_("No way to insert store"), 'db', 'system');
				return false;
			}

			$return['store_id'] = \lib\utility\shortURL::encode($store_id);
			$return['slug']     = $args['slug'];

		}
		elseif ($_args['method'] === 'patch')
		{
			$edit_mode = true;
			$id = utility::request('id');
			$id = \lib\utility\shortURL::decode($id);
			if(!$id || !is_numeric($id))
			{
				logs::set('api:store:method:put:id:not:set', $this->user_id, $log_meta);
				debug::error(T_("Id not set"), 'id', 'permission');
				return false;
			}

			$admin_of_store = \lib\db\stores::access_store_id($id, $this->user_id, ['action' => 'edit']);

			if(!$admin_of_store || !isset($admin_of_store['id']) || !isset($admin_of_store['slug']))
			{
				logs::set('api:store:method:put:permission:denide', $this->user_id, $log_meta);
				debug::error(T_("Can not access to edit it"), 'store', 'permission');
				return false;
			}

			unset($args['creator']);
			if(!utility::isset_request('name'))             unset($args['name']);
			if(!utility::isset_request('slug'))       unset($args['slug']);
			if(!utility::isset_request('website'))          unset($args['website']);
			if(!utility::isset_request('desc'))             unset($args['desc']);

			if(!utility::isset_request('language'))         unset($args['lang']);

			if(!utility::isset_request('parent'))           unset($args['parent']);

			if(!utility::isset_request('country'))          unset($args['country']);
			if(!utility::isset_request('province'))         unset($args['province']);
			if(!utility::isset_request('city'))             unset($args['city']);
			if(!utility::isset_request('tel'))              unset($args['phone']);

			if(!utility::isset_request('zipcode'))          unset($args['zipcode']);
			if(!utility::isset_request('desc'))             unset($args['desc']);

			if(!utility::isset_request('status'))           unset($args['status']);


			if(isset($args['parent']) && intval($args['parent']) === intval($id))
			{
				logs::set('api:store:parent:is:the:store', $this->user_id, $log_meta);
				debug::error(T_("A store can not be the parent himself"), 'parent', 'arguments');
				return false;
			}

			if(array_key_exists('name', $args) && !$args['name'])
			{
				logs::set('api:store:name:not:set:edit', $this->user_id, $log_meta);
				debug::error(T_("Store name of store can not be null"), 'name', 'arguments');
				return false;
			}

			if(array_key_exists('slug', $args) && !$args['slug'])
			{
				logs::set('api:store:slug:not:set:edit', $this->user_id, $log_meta);
				debug::error(T_("slug of store can not be null"), 'slug', 'arguments');
				return false;
			}

			if(!empty($args))
			{
				$update = \lib\db\stores::update($args, $admin_of_store['id']);

				if(isset($args['slug']))
				{
					if(!$update)
					{
						$args['slug'] = $this->slug_fix($args);
						$update = \lib\db\stores::update($args, $admin_of_store['id']);
					}
					// user change slug
					if($admin_of_store['slug'] != $args['slug'])
					{
						logs::set('api:store:change:slug', $this->user_id, $log_meta);
					}
				}
			}
		}
		else
		{
			logs::set('api:store:method:invalid', $this->user_id, $log_meta);
			debug::error(T_("Invalid method of api"), 'method', 'permission');
			return false;
		}


		if(debug::$status)
		{
			debug::title(T_("Operation Complete"));
			if($edit_mode)
			{
				debug::true(T_("Store successfuly edited"));
			}
			else
			{
				debug::true(T_("Store successfuly added"));
			}
		}

		return $return;
	}


	/**
	 * fix duplicate slug
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function slug_fix($_args)
	{
		if(!isset($_args['slug']))
		{
			$_args['slug'] = (string) $this->user_id. (string) rand(1000,5000);
		}

		$new_slug     = null;
		$similar_slug = \lib\db\stores::get_similar_slug($_args['slug']);
		$count        = count($similar_slug);
		$i            = 1;
		$new_slug     = (string) $_args['slug']. (string) ((int) $count +  (int) $i);
		while (in_array($new_slug, $similar_slug))
		{
			$i++;
			$new_slug    = (string) $_args['slug']. (string) ((int) $count +  (int) $i);
		}

		\lib\temp::set('last_store_added', $new_slug);
		return $new_slug;
	}
}
?>