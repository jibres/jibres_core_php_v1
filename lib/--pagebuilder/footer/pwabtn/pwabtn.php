<?php
namespace lib\pagebuilder\footer\pwabtn;


class pwabtn
{

	public static function allow()
	{
		return \dash\url::isLocal();

	}


	public static function input_condition($_args = [])
	{
		$_args['set_pwabtn']  = 'bit';

		$_args['pwa_title_1'] = 'string_100';
		$_args['pwa_url_1']   = 'string_100';
		$_args['pwa_icon_1']  = 'string_100';

		$_args['pwa_title_2'] = 'string_100';
		$_args['pwa_url_2']   = 'string_100';
		$_args['pwa_icon_2']  = 'string_100';

		$_args['pwa_title_3'] = 'string_100';
		$_args['pwa_url_3']   = 'string_100';
		$_args['pwa_icon_3']  = 'string_100';

		$_args['pwa_title_4'] = 'string_100';
		$_args['pwa_url_4']   = 'string_100';
		$_args['pwa_icon_4']  = 'string_100';

		return $_args;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		if(!is_array(a($_data, 'detail')))
		{
			$_data['detail'] = [];
		}

		$pwabtn = [];
		if(isset($_data['set_pwabtn']) && $_data['set_pwabtn'])
		{

			$pwabtn['title_1'] = $_data['pwa_title_1'];
			$pwabtn['url_1']   = $_data['pwa_url_1'];
			$pwabtn['icon_1']  = $_data['pwa_icon_1'];
			$pwabtn['title_2'] = $_data['pwa_title_2'];
			$pwabtn['url_2']   = $_data['pwa_url_2'];
			$pwabtn['icon_2']  = $_data['pwa_icon_2'];
			$pwabtn['title_3'] = $_data['pwa_title_3'];
			$pwabtn['url_3']   = $_data['pwa_url_3'];
			$pwabtn['icon_3']  = $_data['pwa_icon_3'];
			$pwabtn['title_4'] = $_data['pwa_title_4'];
			$pwabtn['url_4']   = $_data['pwa_url_4'];
			$pwabtn['icon_4']  = $_data['pwa_icon_4'];

		}
		elseif(a($_saved_detail, 'detail', 'pwabtn'))
		{
			$pwabtn = a($_saved_detail, 'detail', 'pwabtn');
		}

		$_data['detail'] = array_merge($_data['detail'], ['pwabtn' => $pwabtn]);

		\lib\pagebuilder\tools\tools::input_exception('detail');


		unset($_data['set_pwabtn']);
		unset($_data['pwa_title_1']);
		unset($_data['pwa_url_1']);
		unset($_data['pwa_icon_1']);
		unset($_data['pwa_title_2']);
		unset($_data['pwa_url_2']);
		unset($_data['pwa_icon_2']);
		unset($_data['pwa_title_3']);
		unset($_data['pwa_url_3']);
		unset($_data['pwa_icon_3']);
		unset($_data['pwa_title_4']);
		unset($_data['pwa_url_4']);
		unset($_data['pwa_icon_4']);


		return $_data;

	}
}
?>