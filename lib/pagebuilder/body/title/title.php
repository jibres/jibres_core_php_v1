<?php
namespace lib\pagebuilder\body\title;


class title
{

	public static function input_condition($_args = [])
	{
		$_args['title']             = 'string_100';
		$_args['set_title']         = 'bit';
		$_args['show_title']        = 'yes_no';
		$_args['more_link']         = ['enum' => ['show', 'hide']];
		$_args['more_link_caption'] = 'string_100';
		return $_args;
	}


	public static function ready_for_db($_data)
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

			\lib\pagebuilder\tools\tools::input_exception('titlesetting');
		}

		return $_data;

	}


	public static function ready($_data)
	{

		$default                                  = [];

		$default['more_link_caption_placeholder'] = T_("Show more");
		$default['show_title'] = 'no';
		$default['more_link'] = 'hide';

		if(isset($_data['key']) && $_data['key'] && is_string($_data['key']))
		{
			$default_value = \lib\pagebuilder\tools\tools::call_fn('body', $_data['key'], 'default_value');
			if(isset($default_value['titlesetting']) && is_array($default_value['titlesetting']))
			{
				$default = array_merge($default, $default_value['titlesetting']);
			}
		}

		$titlesetting              = [];

		// default place holder
		if(isset($_data['titlesetting']) && is_string($_data['titlesetting']))
		{
			$titlesetting = json_decode($_data['titlesetting'], true);

			if(!is_array($titlesetting))
			{
				$titlesetting = [];
			}

		}


		$_data['titlesetting'] = array_merge($default, $titlesetting);

		return $_data;
	}

}
?>
