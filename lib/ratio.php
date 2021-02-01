<?php
namespace lib;


class ratio
{
	public static function list()
	{
		$list          = [];
		$list['1:1']   = ['title' => \dash\fit::text('1:1')];
		$list['2.5:1'] = ['title' => \dash\fit::text('2.5:1')];
		$list['4:3']   = ['title' => \dash\fit::text('4:3')];
		$list['5:3']   = ['title' => \dash\fit::text('5:3')];
		$list['16:9']  = ['title' => \dash\fit::text('16:9')];
		$list['16:10'] = ['title' => \dash\fit::text('16:10')];
		$list['19:10'] = ['title' => \dash\fit::text('19:10')];
		$list['32:9']  = ['title' => \dash\fit::text('32:9')];
		$list['64:27'] = ['title' => \dash\fit::text('64:27')];
		return $list;
	}


	/**
	 * Check input function
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function check_input()
	{
		$list = self::list();
		return ['enum' => array_keys($list)];
	}


	/**
	 * Return string of select option ratio
	 *
	 * @param      <type>  $_current_data  The current data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function select_html($_current_data = null, $_place = null)
	{
		$result     = '';

		$list       = [];

		$is_default = null;

		if($_place === 'products')
		{
			$is_default = self::default_ratio('ratio', 'product');
		}
		else
		{
			$is_default = self::default_ratio('ratio');
		}

		$list = self::list();

		foreach ($list as $key => $value)
		{
			$result.= '<option value="'. $key. '"';
			if($key == $_current_data || (!$_current_data && $key === $is_default))
			{
				$result .= ' selected';
			}
			$result.= ' >';
			if($is_default === $key)
			{
				$result .= $value['title'];
				$result .= ' ('. T_("Default").')';
			}
			else
			{
				$result .= $value['title'];
			}
			$result.= '</option>';
		}

		return $result;
	}



	public static function product_ratio($_data)
	{
		return self::ratio($_data, 'product');
	}


	public static function ratio($_data, $_type = null)
	{
		$ratio = null;
		if(is_string($_data))
		{
			$ratio = $_data;
		}

		if(strpos($ratio, ':') === false)
		{
			$ratio = self::default_ratio('ratio', $_type);
		}

		$int_ratio = null;

		$split = explode(':', $ratio);
		if(isset($split[0]) && isset($split[1]) && is_numeric($split[0]) && is_numeric($split[1]))
		{
			$int_ratio = round(floatval($split[0]) / floatval($split[1]), 5);
		}

		$result                 = [];
		$result['ratio_string'] = $ratio;
		$result['ratio']        = $int_ratio;
		$result['ratio_round']        = round($int_ratio, 2);
		$result['min_w']        = 800;
		$result['min_h']        = 600;
		$result['max_w']        = 1080;
		$result['max_h']        = 1200;

		return $result;

	}

	public static function data_ratio_html($_ratio)
	{

		$ratio = self::ratio($_ratio);

		$ratioHtml = '';
		if(isset($ratio['ratio']))
		{
			$ratioHtml .= 'data-ratio="'. $ratio['ratio']. '" ';
		}

		if(isset($ratio['min_w']))
		{
			$ratioHtml .= 'data-min-w="'. $ratio['min_w']. '" ';
		}

		if(isset($ratio['min_h']))
		{
			$ratioHtml .= 'data-min-h="'. $ratio['min_h']. '" ';
		}

		if(isset($ratio['max_w']))
		{
			$ratioHtml .= 'data-max-w="'. $ratio['max_w']. '" ';
		}

		if(isset($ratio['max_h']))
		{
			$ratioHtml .= 'data-max-h="'. $ratio['max_h']. '" ';
		}

		\dash\data::ratioHtmlDetail($ratio);

		\dash\data::ratioHtml($ratioHtml);

		return $ratioHtml;
	}


	public static function ratio_title($_ratio_float)
	{
		if(!$_ratio_float || !is_numeric($_ratio_float))
		{
			return null;
		}

		$ratio_title =
		[
			'1.78' => '16:9',
			'1.6'  => '16:10',
			'1.9'  => '19:10',
			'3.56' => '32:9',
			'2.34' => '21:9',
			'2.37' => '64:27',
			'1.67' => '5:3',
			'1'    => '1:1',
			'1.0'  => '1:1',
			'1.00' => '1:1',
		];

		$ratio_float = round($_ratio_float, 2);

		$ratio_float = (string) $ratio_float;

		if(isset($ratio_title[$ratio_float]))
		{
			return $ratio_title[$ratio_float];
		}

		return null;

	}



	public static function default_ratio($_needle = null, $_type = null)
	{
		if($_type === 'product')
		{
			$default =
			[
				'ratio' => '1:1',
				'title' => T_("1:1 (Default)"),
			];
		}
		else
		{

			$default =
			[
				'ratio' => '16:9',
				'title' => T_("16:9 (Default)"),
			];
		}

		if($_needle)
		{
			if(isset($default[$_needle]))
			{
				return $default[$_needle];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return $default;
		}
	}
}
?>