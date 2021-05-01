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
		$_args['show_mode']         = ['enum' => ['simple', 'special']];

		$_args['more_link_caption'] = 'string_100';
		$_args['more_link_url']     = 'string_200';
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

		if(array_key_exists('more_link_url', $_data))
		{
			$titlesetting['more_link_url'] = $_data['more_link_url'];
			unset($_data['more_link_url']);
		}


		if(array_key_exists('show_mode', $_data))
		{
			$titlesetting['show_mode'] = $_data['show_mode'];
			unset($_data['show_mode']);
		}

		if(!empty($titlesetting))
		{
			$titlesetting = json_encode($titlesetting, JSON_UNESCAPED_UNICODE);

			$_data['titlesetting'] = $titlesetting;

			\lib\pagebuilder\tools\tools::input_exception('titlesetting');
		}

		unset($_data['set_title']);
		unset($_data['show_mode']);

		return $_data;

	}


	public static function ready($_data)
	{

		$default                                  = [];

		$default['more_link_caption_placeholder'] = T_("Show more");
		$default['show_title'] = 'no';
		$default['more_link'] = 'hide';

		$element = null;
		if(isset($_data['key']) && $_data['key'] && is_string($_data['key']))
		{
			$element = $_data['key'];
		}

		if(isset($_data['type']) && $_data['type'] && is_string($_data['type']))
		{
			$element = $_data['type'];
		}

		if($element)
		{
			$default_value = \lib\pagebuilder\tools\tools::call_fn('body', $element, 'default_value');
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



	public static function draw($_args, $_link = null)
	{

		if(a($_args, 'titlesetting', 'show_title') === 'no')
		{
			return '';
		}


		$html              = '';
		$title             = a($_args, 'title');
		$more_link         = a($_args, 'titlesetting', 'more_link');
		$show_mode         = a($_args, 'titlesetting', 'show_mode');
		$more_link_caption = a($_args, 'titlesetting', 'more_link_caption');

		if(!$more_link_caption)
		{
			$more_link_caption = a($_args, 'titlesetting', 'more_link_caption_placeholder');
		}

		$link = a($_args, 'titlesetting', 'more_link_url');

		if($show_mode === 'simple')
		{
			if($more_link === 'hide' || !$link)
			{
				$html .= '<div class="eTitle">';
				{
					$html .= '<h2 class="title">'. $title. '</h2>';
				}
				$html .= '</div>';
			}
			else
			{
				$html .= "<div class='eTitle row'>";
				{
					$html .= "<div class='c'>";
					{
						$html .= '<h2 class="title">'. $title .'</h2>';
					}
					$html .= "</div>";
					$html .= "<div class='c-auto os'>";
					{
						$html .= "<a class='more' href='" . $link . "'>". $more_link_caption . "</a>";
					}
					$html .= "</div>";
				}
				$html .= "</div>";
			}

		}
		else
		{
			if($more_link === 'hide' || !$link)
			{
				$html .= '<h2 class="jTitle1">'. $title. '</h2>';
			}
			else
			{
				// $html .= '<h2 class="jTitle1">';
				{

					$html .= "<a class='more' href='" . $link . "'><h2 class='jTitle1'>". $title . "</h2></a>";
				}
				// $html .= "</h2>";
			}
		}


		return $html;
	}

}
?>
