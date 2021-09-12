<?php
namespace content_site\page\design;


class model
{
	public static function post()
	{
		$page_id = \dash\request::get('id');

		$page_id = \dash\validate::code($page_id);
		$page_id = \dash\coding::decode($page_id);
		if(!$page_id)
		{
			\dash\notif::error(T_("Invali page id"));
			return false;
		}


		self::save_page_background_font($page_id);


	}





	public static function save_page_background_font($_page_id)
	{
		$option_key = null;

		$all_post = \dash\request::post();

		foreach ($all_post as $key => $value)
		{
			if(substr($key, 0, 4) === 'opt_')
			{
				$option_key = substr($key, 4);
				$myPost[$option_key] = $value;
			}
			else
			{
				$myPost[$key] = $value;
			}
		}

		if(!$option_key || !is_string($option_key))
		{
			\dash\notif::error(T_("Option key not found!"). ' '. __LINE__);
			return false;
		}


		/**
		 * Code can not be continue
		 * Because the special save edit everything need and complete process
		 * @todo Nedd check if have not function special save make error
		 */
		if(\dash\request::post('specialsave') === 'specialsave')
		{
			$specialsave = \content_site\call_function::option_specialsave($option_key, $myPost);

			if(\content_site\utility::need_redirect())
			{
				\dash\redirect::pwd();
			}

			return $specialsave;
		}


		// save multi option
		if(\dash\request::post('multioption') === 'multi')
		{
			$value = $myPost;
		}
		else
		{
			$value = \dash\request::post('opt_'. $option_key);
		}

		$value = \content_site\call_function::option_validator($option_key, $value);

		if(!\dash\engine\process::status())
		{
			\dash\notif::error_once(T_("Please check your input"));
			return false;
		}

		// check option database name is different by option key
		$option_db_key = $option_key;

		$check_option_db_key = \content_site\call_function::option_db_key($option_key);

		if($check_option_db_key && is_string($check_option_db_key))
		{
			$option_db_key = $check_option_db_key;
		}



		\dash\pdo::transaction();

		$post_detail = \dash\db\posts::pdo_get_by_id_lock($_page_id);

		if(!$post_detail)
		{
			\dash\pdo::rollback();
			\dash\notif::error(T_("Page not found!"));
			return false;
		}

		$meta = [];
		$preview = [];

		if(isset($post_detail['meta']))
		{
			$meta = json_decode($post_detail['meta'], true);
			if(!is_array($meta))
			{
				$meta = [];
			}
		}

		if(isset($meta['preview']) && is_array($meta['preview']))
		{
			$preview = $meta['preview'];
		}

		// save multi option
		if(is_array($value))
		{
			foreach ($value as $my_key => $val)
			{
				$preview[$my_key] = $val;
			}
		}
		else
		{
			$preview[$option_db_key] = $value;
		}


		$meta['preview'] = $preview;

		$meta = json_encode($meta);

		\dash\db\posts::pdo_update(['meta' => $meta], $_page_id);

		\dash\pdo::commit();

		\dash\notif::complete();

		if(\content_site\utility::need_redirect())
		{
			\dash\notif::reloadIframe();
			\dash\redirect::pwd();
		}
	}
}
?>