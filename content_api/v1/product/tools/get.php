<?php
namespace content_api\v1\product\tools;
use \lib\utility;
use \lib\debug;
use \lib\db\logs;

trait get
{
	public $logo_urls = [];

	/**
	 * ready data of product to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public function ready_product($_data, $_options = [])
	{
		$default_options =
		[
			'check_is_my_product' => true,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'creator':
				// case 'parent':
					if(isset($value))
					{
						$result[$key] = \lib\utility\shortURL::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'slug':
					$result[$key] = isset($value) ? (string) $value : null;
					$result['url'] = isset($value) ? Protocol. '://'. $value. '.jibres.'. Tld : null;
					break;

				case 'country':
				case 'city':
				case 'province':
				case 'zipcode':
				case 'name':
				case 'website':
				case 'desc':
				case 'alias':
				case 'status':
					$result[$key] = isset($value) ? (string) $value : null;
					break;
				case 'lang':
					$result['language'] = isset($value) ? (string) $value : null;
					break;

				case 'logo':
					if($value)
					{
						$result['logo'] = $this->host('file'). '/'. $value;
					}
					else
					{
						$result['logo'] = $this->host('siftal_image');
					}
					break;

				case 'createdate':
					$result[$key] = $value;
					$date_now = new \DateTime("now");
					$start    = new \DateTime($value);
					$result['day_use']    = $date_now->diff($start)->days;
					$result['day_use']++;
					break;

				case 'telegram_id':
					$result['telegram'] = $value ? true : false;
					break;

				case 'plan':
					$result[$key] = $value;
					break;
				default:
					continue;
					break;
			}
		}

		return $result;
	}


	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public function get_list_product($_args = [])
	{
		if(!$this->user_id)
		{
			return false;
		}

		$meta            = [];
		$meta['creator'] = $this->user_id;
		$result          = \lib\db\products::search($this->user_id, $meta);
		$temp            = [];
		foreach ($result as $key => $value)
		{
			$check = $this->ready_product($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}


	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public function get_list_product_child($_args = [])
	{
		if(!$this->user_id)
		{
			return false;
		}
	}

	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public function get_product($_options = [])
	{
		$default_options =
		[
			'debug' => true,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		if($_options['debug'])
		{
			debug::title(T_("Operation Faild"));
		}

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
			// return false;
		}

		$id = utility::request("id");
		$id = \lib\utility\shortURL::decode($id);

		$shortname = utility::request('shortname');

		if(!$id && !$shortname)
		{
			if($_options['debug'])
			{
				logs::set('api:product:id:shortname:not:set', $this->user_id, $log_meta);
				debug::error(T_("Product id or shortname not set"), 'id', 'arguments');
			}
			return false;
		}

		if($id && $shortname)
		{
			logs::set('api:product:id:shortname:together:set', $this->user_id, $log_meta);
			if($_options['debug'])
			{
				debug::error(T_("Can not set product id and shortname together"), 'id', 'arguments');
			}
			return false;
		}

		if($id)
		{
			$result = \lib\db\products::access_product_id($id, $this->user_id, ['action' => 'view']);
		}
		else
		{
			$result = \lib\db\products::access_product($shortname, $this->user_id, ['action' => 'view']);
		}

		if(!$result)
		{
			if($id)
			{
				$result = \lib\db\products::get(['id' => $id, 'limit' => 1]);
			}
			elseif($shortname)
			{
				$result = \lib\db\products::get(['shortname' => $shortname, 'limit' => 1]);
			}

			if($result)
			{
				if(\lib\permission::access('load:all:product', null, $this->user_id))
				{
					$result = $result;
				}
				else
				{
					\lib\temp::set('product_access_denied', true);
					\lib\temp::set('product_exist', true);
					$result = false;
				}
			}
		}

		if(!$result)
		{
			logs::set('api:product:access:denide', $this->user_id, $log_meta);
			if($_options['debug'])
			{
				debug::error(T_("Can not access to load this product details"), 'product', 'permission');
			}
			return false;
		}

		if($_options['debug'])
		{
			debug::title(T_("Operation complete"));
		}

		$result = $this->ready_product($result);

		return $result;
	}
}
?>