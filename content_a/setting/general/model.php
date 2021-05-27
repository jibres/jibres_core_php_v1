<?php
namespace content_a\setting\general;


class model
{
	public static function post()
	{

		if(\dash\request::post('set_logo'))
		{
			$result = \lib\app\setting\setup::upload_logo();
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return false;
		}

		if(\dash\request::post('remove_business_logo') === 'logo')
		{
			\lib\app\store\edit::selfedit(['logo' => null]);
			\dash\redirect::pwd();
			return;
		}

		$post = [];

		$unit                = [];

		if(\dash\request::post('set_currency'))
		{
			$unit['currency']    = \dash\request::post('currency');
		}

		if(\dash\request::post('set_mass'))
		{
			$unit['mass_unit']   = \dash\request::post('mass_unit');
		}

		if(\dash\request::post('set_length'))
		{
			$unit['length_unit'] = \dash\request::post('length_unit');
		}


		if(!empty($unit))
		{
			\lib\app\setting\set::set_units($unit);
		}


		if(\dash\request::post('set_lang'))
		{
			$post['lang']    = \dash\request::post('lang');
		}

		if(\dash\request::post('set_nosale'))
		{
			$post['nosale'] = \dash\request::post('nosale');
		}


		if(\dash\request::post('set_enterdisallow'))
		{
			$post['enterdisallow'] = \dash\request::post('enterdisallow') ? null : 1;
			if($post['enterdisallow'])
			{
				$post['entersignupdisallow'] = 1;
			}
		}

		if(\dash\request::post('set_entersignupdisallow'))
		{
			$post['entersignupdisallow'] = \dash\request::post('entersignupdisallow') ? null : 1;
		}

		if(!empty($post))
		{
			\lib\app\store\edit::selfedit($post);
		}


		\dash\redirect::pwd();
	}


}
?>