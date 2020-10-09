<?php
namespace content_a\setting\samandehi;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			$post['samandehi_link1'] = null;
			$post['samandehi_link2'] = null;
		}
		else
		{
			$samandehi = null;
			if(\dash\request::post_raw('samandehi'))
			{
				$samandehi = \dash\request::post_raw('samandehi');
			}

			if(!$samandehi)
			{
				\dash\notif::error(T_("Samandehi Script is required"), 'samandehi');
				return false;
			}

			if(preg_match("/window\.open\(\"([^\"]+)(.*)src(\s?)\=(\s?)\'([^\']+)/", $samandehi, $split))
			{
				$post = [];
				$post['samandehi_link1'] = $split[1];
				$post['samandehi_link2'] = $split[5];
			}
			else
			{
				\dash\notif::error(T_("The text of samandehi contains a series of special characters that are not in your text"), 'samandehi');
				return false;
			}
		}

		\lib\app\store\edit::selfedit($post);

		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>