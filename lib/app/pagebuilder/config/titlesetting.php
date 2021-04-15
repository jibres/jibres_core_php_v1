<?php
namespace lib\app\pagebuilder\config;


class titlesetting
{
	public static function ready_for_save_db(&$data, $_data)
	{
		// needless to save title
		if(!a($_data, 'set_title'))
		{
			return;
		}

		$titlesetting = [];

		if(array_key_exists('set_title', $_data))
		{
			$titlesetting['set_title'] = $_data['set_title'];
		}

		if(array_key_exists('show_title', $_data))
		{
			$titlesetting['show_title'] = $_data['show_title'];
		}

		if(array_key_exists('more_link', $_data))
		{
			$titlesetting['more_link'] = $_data['more_link'];
		}

		if(array_key_exists('more_link_caption', $_data))
		{
			$titlesetting['more_link_caption'] = $_data['more_link_caption'];
		}

		if(!empty($titlesetting))
		{
			$titlesetting = json_encode($titlesetting, JSON_UNESCAPED_UNICODE);

			$data['titlesetting'] = $titlesetting;

			\lib\app\pagebuilder\line\tools::input_exception('titlesetting');
		}

	}


	public static function ready(&$data)
	{
		if(isset($data['titlesetting']) && is_string($data['titlesetting']))
		{
			$titlesetting = json_decode($data['titlesetting'], true);

			if(!is_array($titlesetting))
			{
				$titlesetting = []; // the default value
			}

			// default place holder
			$titlesetting['more_link_caption_placeholder'] = T_("Show more");

			$data['titlesetting'] = $titlesetting;
		}
	}

}
?>
