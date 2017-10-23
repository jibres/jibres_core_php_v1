<?php
namespace content_a\main;
use \lib\utility;

trait _use
{
	// API OPTIONS
	use \addons\content_api\v1\home\tools\_use;

	/**
	 * check team language and redirect if is set
	 * the 'data' mean the arguments of this function is data of team
	 * you can set the id or shortname of team and change the data to 'id' or 'shortname'
	 */
	public function checkout_team_lanuage_force($_args = null, $_type = 'data')
	{
		$team_data = [];

		switch ($_type)
		{
			case 'data':
				$team_data = $_args;
				break;

			case 'id':
				if(is_numeric($_args))
				{
					$team_data = \lib\db\teams::get_by_id($_args);
				}
				break;

			case 'shortname':
				if(is_string($_args))
				{
					$team_data = \lib\db\teams::get_by_shortname($_args);
				}
				break;
		}

		/**
		 * { item_description }
		 */
		if(isset($team_data['language']))
		{
			$team_language = $team_data['language'];

			if(\lib\utility\location\languages::check($team_language))
			{
				$new_url               = $this->url('full');
				$url                   = $this->url('root');
				$url_property          = \lib\router::get_url();
				$url_get               = utility::get();

				$site_language         = \lib\define::get_language();
				$site_language_default = \lib\define::get_language('default');

				if($team_language === $site_language)
				{
					// no thing
				}
				else
				{
					if($team_language === $site_language_default)
					{
						if($url_get)
						{
							$new_url = $url. '/'. $url_property. '?'. $url_get;
						}
						else
						{
							$new_url = $url. '/'. $url_property;
						}
					}
					else
					{
						if($url_get)
						{
							$new_url = $url. '/'. $team_language. '/'. $url_property. '?'. $url_get;
						}
						else
						{
							$new_url = $url. '/'. $team_language. '/'. $url_property;
						}
					}
				}
				if($new_url !== $this->url('full'))
				{
					$this->redirector($new_url)->redirect();
				}
			}
		}
	}



}
?>