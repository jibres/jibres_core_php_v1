<?php
namespace lib\pagebuilder\header\logo;


class logo
{

	public static function input_condition($_args = [])
	{
		$_args['remove_header_logo'] = 'string_100';

		return $_args;
	}




	public static function ready($_data)
	{
		if(isset($_data['detail']['logo']) && $_data['detail']['logo'])
		{
			$_data['detail']['logourl'] = \lib\filepath::fix($_data['detail']['logo']);
		}

		return $_data;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$header = [];

		$image_path = null;

		if(\dash\request::files('logo'))
		{
			$image_path = \dash\upload\website::upload_image('logo');

			if(!\dash\engine\process::status())
			{
				return false;
			}
		}
		else
		{
			if(isset($_saved_detail['detail']['logo']))
			{
				$image_path = $_saved_detail['detail']['logo'];
			}
		}

		if($_data['remove_header_logo'] === 'logo')
		{
			$image_path = null;
		}

		$header['logo'] = $image_path;


		$saved_detail = [];

		if(is_array($_saved_detail['detail']))
		{
			$saved_detail = $_saved_detail['detail'];
		}

		$saved_detail = array_merge($saved_detail, $_data['detail'], $header);

		unset($saved_detail['logourl']);
		unset($saved_detail['have_header_menu']);

		$_data['detail'] = $saved_detail;

		\lib\pagebuilder\tools\tools::input_exception('detail');

		unset($_data['remove_header_logo']);

		return $_data;

	}



}
?>