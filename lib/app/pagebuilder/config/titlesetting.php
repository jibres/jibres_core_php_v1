<?php
namespace lib\app\pagebuilder\config;


class titlesetting
{
	public static function ready_for_save_db($_data)
	{
		// needless to save title
		if(!a($_data, 'set_title'))
		{
			return $_data;
		}

		$titlesetting = [];

		if(array_key_exists('set_title', $_data))
		{
			$titlesetting['set_title'] = $_data['set_title'];
			unset($_data['set_title']);
		}

		if(array_key_exists('show_title', $_data))
		{
			$titlesetting['show_title'] = $_data['show_title'];
			unset($_data['show_title']);
		}

		if(array_key_exists('more_link', $_data))
		{
			$titlesetting['more_link'] = $_data['more_link'];
			unset($_data['more_link']);
		}

		if(array_key_exists('more_link_caption', $_data))
		{
			$titlesetting['more_link_caption'] = $_data['more_link_caption'];
			unset($_data['more_link_caption']);
		}

		if(!empty($titlesetting))
		{
			$titlesetting = json_encode($titlesetting, JSON_UNESCAPED_UNICODE);

			$_data['titlesetting'] = $titlesetting;

			\lib\app\pagebuilder\line\tools::input_exception('titlesetting');
		}

		return $_data;

	}


	public static function ready($_data)
	{

		$default                                  = [];

		$default['more_link_caption_placeholder'] = T_("Show more");

		$titlesetting                             = [];

		// default place holder
		if(isset($_data['titlesetting']) && is_string($_data['titlesetting']))
		{
			$titlesetting = json_decode($_data['titlesetting'], true);

			if(!is_array($titlesetting))
			{
				$titlesetting = [];
			}

		}

		$_data['titlesetting'] = array_merge($default, $titlesetting);;


		return $_data;
	}

}
?>
