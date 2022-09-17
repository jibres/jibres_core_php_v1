<?php
namespace lib\app\product;


class ganje
{

	private static function in_ganje_store() : bool
	{
		return floatval(\lib\store::id()) === \lib\api\business\ganje::ganje_business_id();
	}


	/**
	 * Check limited
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function limited()
	{
		if(\lib\app\plan\planCheck::access('ganje'))
		{
			return false;
		}

		$count_added_by_ganje = \lib\db\products\get::count_added_by_ganje();



		if(floatval($count_added_by_ganje) >= 10)
		{
			return true;
		}

		return false;
	}


	/**
	 * Searches for the first match.
	 *
	 * @param      string  $_search  The search
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function search($_search) : array
	{
		if(!$_search)
		{
			return [];
		}

		if(self::in_ganje_store())
		{
			return [];
		}

		$ganje = \lib\api\business\ganje::search($_search);

		$list = [];

		if(isset($ganje['result']) && is_array($ganje['result']) && $ganje['result'])
		{
			$list = $ganje['result'];
		}

		if(self::limited())
		{
			foreach ($list as $key => $value)
			{
				$list[$key]['limited'] = true;
			}
		}


		return $list;

	}


	/**
	 * Fetches a by identifier.
	 *
	 * @param      <type>  $_id    The identifier
	 *
	 * @return     bool    The by identifier.
	 */
	public static function fetch_by_id($_id)
	{

		if(self::in_ganje_store())
		{
			return null;
		}

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		if(self::limited())
		{
			return false;
		}

		$ganje = \lib\api\business\ganje::detail($id);

		if(!$ganje || !isset($ganje['result']) || !is_array(a($ganje, 'result')))
		{
			return false;
		}

		$ganje_product = $ganje['result'];

		return $ganje_product;
	}


	/**
	 * Fetches a by barcode.
	 *
	 * @param      <type>  $_barcode  The barcode
	 *
	 * @return     bool    The by barcode.
	 */
	public static function fetch_by_barcode($_barcode, $_force = false)
	{

		if(self::in_ganje_store())
		{
			return null;
		}

		$barcode = \dash\validate::string_100($_barcode);
		if(!$barcode)
		{
			return false;
		}

		if(self::limited() && !$_force)
		{
			return false;
		}

		$ganje = \lib\api\business\ganje::barcode($barcode);

		if(!$ganje || !isset($ganje['result']) || !is_array(a($ganje, 'result')))
		{
			return false;
		}

		$ganje_product = $ganje['result'];

		if(isset($ganje_product[0]))
		{
			$ganje_product = $ganje_product[0];
		}

		return $ganje_product;
	}



	/**
	 * Get ganje product by id or by barcode
	 *
	 * @param      <type>  $_id       The identifier
	 * @param      <type>  $_barcode  The barcode
	 *
	 * @return     <type>  The by identifier barcode.
	 */
	public static function fetch_by_id_barcode($_id, $_barcode)
	{
		if(self::in_ganje_store())
		{
			return null;
		}


		if($_id)
		{
			return self::fetch_by_id($_id);
		}
		elseif($_barcode)
		{
			return self::fetch_by_barcode($_barcode);
		}
	}


	/**
	 * Fill add or edit request args by ganje detail
	 *
	 * @param      array  $_args  The arguments
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function fill_args(array $_args) : array
	{
		if(!isset($_args['add_from_ganje']))
		{
			return $_args;
		}


		if(self::in_ganje_store())
		{
			return $_args;
		}

		if(self::limited())
		{
			return $_args;
		}


		// detect and load ganje product
		if(a($_args, 'add_from_ganje_type') === 'id')
		{
			$ganje_product = \lib\app\product\ganje::fetch_by_id($_args['add_from_ganje']);
		}
		elseif(a($_args, 'add_from_ganje_type') === 'barcode')
		{
			$ganje_product = \lib\app\product\ganje::fetch_by_barcode($_args['add_from_ganje']);
		}
		else
		{
			return $_args;
		}

		if($ganje_product)
		{

			$_args['ganje_id']        = a($ganje_product, 'id');
			$_args['ganje_lastfetch'] = date("Y-m-d H:i:s");


			$ganje_gallery_raw = [];
			if(a($ganje_product, 'gallery_array'))
			{
				$ganje_gallery_raw = array_column($ganje_product['gallery_array'], 'path');
			}

			$_args['gallery_raw'] = $ganje_gallery_raw;


			$ganje_category = [];
			if(a($ganje_product, 'category'))
			{
				$ganje_category = array_column($ganje_product['category'], 'title');
			}


			if(!a($_args, 'category'))
			{
				$_args['category'] = $ganje_category;
			}


			if(a($ganje_product, 'property') && !a($_args, 'property'))
			{
				$_args['property'] = $ganje_product['property'];
			}

			if(!a($_args, 'title'))
			{
				$_args['title'] = a($ganje_product, 'title');
			}

			if(!a($_args, 'title2'))
			{
				$_args['title2'] = a($ganje_product, 'title2');
			}

			if(!a($_args, 'slug'))
			{
				$_args['slug']   = a($ganje_product, 'slug');
			}

			if(!a($_args, 'desc'))
			{
				$_args['desc']   = a($ganje_product, 'desc');
			}

			if(!a($_args, 'barcode'))
			{
				$_args['barcode']   = a($ganje_product, 'barcode');
			}

			if(!a($_args, 'barcode2'))
			{
				$_args['barcode2']   = a($ganje_product, 'barcode2');
			}
		}

		return $_args;
	}


	public static function check_product(array $_product_detail)
	{
		if(self::in_ganje_store())
		{
			return null;
		}

		if(a($_product_detail, 'ganje_id'))
		{
			if(a($_product_detail, 'ganje_lastfetch'))
			{
				if(strtotime($_product_detail['ganje_lastfetch']) >= \lib\api\business\ganje::get_lastupdate(true))
				{
					return null;
				}
			}
			else
			{
				return self::detect_update($_product_detail);
			}
		}
		else
		{
			if(a($_product_detail, 'barcode'))
			{
				$ganje_product = self::fetch_by_barcode($_product_detail['barcode'], true);
			}
			elseif(a($_product_detail, 'barcode2'))
			{
				$ganje_product = self::fetch_by_barcode($_product_detail['barcode2'], true);
			}
			else
			{
				return null;
			}

			if(!$ganje_product)
			{
				return null;
			}

			if(self::limited())
			{
				$ganje_product['limited'] = true;
			}

			return $ganje_product;

		}

	}


	public static function detect_update(array $_product_detail)
	{


		$ganje_identify = null;
		$ganje_type     = null;

		if(a($_product_detail, 'barcode'))
		{
			$ganje_identify = $_product_detail['barcode'];
			$ganje_type     = 'barcode';
		}
		elseif(a($_product_detail, 'barcode2'))
		{
			$ganje_identify = $_product_detail['barcode2'];
			$ganje_type     = 'barcode';
		}
		elseif(a($_product_detail, 'ganje_id'))
		{
			$ganje_identify = $_product_detail['ganje_id'];
			$ganje_type     = 'id';
		}
		elseif(a($_product_detail, 'title'))
		{
			$ganje_identify = $_product_detail['title'];
			$ganje_type     = 'title';
		}
		elseif(a($_product_detail, 'title2'))
		{
			$ganje_identify = $_product_detail['title2'];
			$ganje_type     = 'title';
		}
		else
		{
			// nothing detect fo search in ganje
			return null;
		}

		$ganje_product = [];

		switch ($ganje_type)
		{
			case 'barcode':
				$ganje_product = self::fetch_by_barcode($ganje_identify);
				break;

			case 'id':
				$ganje_product = self::fetch_by_id($ganje_identify);
				break;

			case 'title':
				// $ganje_product = self::fetch_by_title($ganje_identify);
				return null;
				break;

			default:
				return null;
				break;
		}

		// can not load ganje product
		if(!is_array($ganje_product))
		{
			return null;
		}

		// update last fetch date
		\lib\db\products\update::ganje_lastfetch($_product_detail['id']);

		/**

			TODO:
			- compare title
			- compare gallery
			- compare category
			- compare property
			- compare desc
		 */

		$need_update = [];

		if(!\dash\validate::is_equal(a($_product_detail, 'title') , a($ganje_product, 'title')))
		{
			$need_update['title'] = $ganje_product['title'];
		}

		if(!\dash\validate::is_equal(a($_product_detail, 'title2') , a($ganje_product, 'title2')))
		{
			$need_update['title2'] = $ganje_product['title2'];
		}

		if(!\dash\validate::is_equal(a($_product_detail, 'desc') , a($ganje_product, 'desc')))
		{
			$need_update['desc'] = $ganje_product['desc'];
		}

		if(!\dash\validate::is_equal(a($_product_detail, 'barcode') , a($ganje_product, 'barcode')))
		{
			$need_update['barcode'] = $ganje_product['barcode'];
		}

		if(!\dash\validate::is_equal(a($_product_detail, 'barcode2') , a($ganje_product, 'barcode2')))
		{
			$need_update['barcode2'] = $ganje_product['barcode2'];
		}

		return null;



	}



	public static function product_html($_data, $_in_edit_module = false)
	{
		$html = '';

		$html .= '<div class="flex flex-row bg-white mt-2 rounded-lg">';
		{

			$html .= '<div class="w-36 h-36 hidden md:block">';
			{
				if(a($_data, 'thumb'))
				{
					$html .= '<img class="object-cover w-36 h-36 rounded-lg " src="'. a($_data, 'thumb'). '" alt="'.a($_data, 'title').'">';
				}
			}
			$html .= '</div>';

			$html .= '<div class="flex-grow flex flex-col">';
			{

				$html .= '<div class="flex-grow">';
				{

					$html .= '<div class="flex flex-row">';
					{
						$html .= '<div class="flex-grow">';
						{
							$html .= '<div class="p-3">';
							{
								$html .= a($_data, 'title');

								if(a($_data, 'title2'))
								{
									$html .= '<div class="text-gray-500">';
									{
										$html .= a($_data, 'title2');
									}
									$html .= '</div>';
								}


								if(a($_data, 'category_list') && is_array($_data['category_list']))
								{
									$html .= '<div class="mt-1">';
									{
										foreach ($_data['category_list'] as $category)
										{
											$html .= '<span class="p-1 m-1 rounded-lg bg-gray-200">';
											{
												$html .= '#'. a($category, 'title');
											}
											$html .= '</span>';
										}
									}
									$html .= '</div>';
								}

							}
							$html .= '</div>';

						}
						$html .= '</div>';

						$html .= '<div class="flex-none">';
						{
							if(a($_data, 'barcode') || a($_data, 'barcode2'))
							{
								$barcode = null;
								if(a($_data, 'barcode'))
								{
									$barcode .= ''. $_data['barcode'];
								}
								if(a($_data, 'barcode2'))
								{
									$barcode .= '|'. $_data['barcode2'];
								}

								$html .= '<div class="p-1" title="'.$barcode.'">';
								{
									$html .= \dash\utility\icon::svg('upc', 'bootstrap', 'DarkGray', 'w-6 h-6');
								}
								$html .= '</div>';
							}

							if(a($_data, 'gallery_array', 'files'))
							{
								$html .= '<div class="p-1" title="'.T_("Have gallery").'">';
								{
									$html .= \dash\utility\icon::svg('images', 'bootstrap', 'DarkGray', 'w-5 h-5');
								}
								$html .= '</div>';
							}
						}
						$html .= '</div>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="flex-none flex flex-row">';
				{
					$html .= '<div class="flex-grow">';
					{

					}
					$html .= '</div>';
					$html .= '<div class="flex-none p-1">';
					{
						if(a($_data, 'limited'))
						{
							$planMessageTitle = \lib\app\plan\planMessage::needUpgrade();
							$planMessageLink = \lib\app\plan\planMessage::getLink();
							$html .= '<a href="'.$planMessageLink. '" class="btn-success">'. $planMessageTitle. '</a>';
						}
						else
						{
							if($_in_edit_module)
							{
								$html .= '<div data-ajaxify data-data=\'{"gid": "'.a($_data, 'id').'"}\' class="btn-info">'. T_("Update"). '</div>';
							}
							else
							{
								$add_url         = \dash\url::this(). '/add?';
								$add_args        = [];
								$add_args['gid'] = a($_data, 'id');

								if(isset($is_barcode_page) && $is_barcode_page)
								{
									$add_args['barcodepage'] = 1;
								}
								$add_args['iframe'] = 1;
								$add_args['ganje'] = 1;

								$add_url .= \dash\request::build_query($add_args);

								$html .= '<a href="'.$add_url.'" target="_blank" data-type="iframe" data-preload="false" data-fancybox class="btn-primary">'. T_("Add"). '</a>';
							}

						}
					}
					$html .= '</div>';
				}
				$html .= '</div>';

			}
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}
}
?>