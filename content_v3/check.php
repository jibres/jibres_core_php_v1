<?php
namespace content_v3;


class check
{
	public static function basic_api_detail()
	{

		if(!in_array(\dash\url::subdomain(), ['developers', 'api', 'core', null]))
		{
			\dash\redirect::remove_subdomain();
		}

		$module = \dash\url::module();

		if(!$module || ($module === 'doc' && !\dash\url::child()) || (in_array($module, ['v3', 'v3'])))
		{
			// nothing
		}
		else
		{
			\dash\header::status(404, T_("Invalid url"));
		}

		// redirect api/doc to api/{last version of api}/doc
		if($module === 'doc' && !\dash\url::child())
		{
			\dash\redirect::to(\dash\url::here(). '/v3/doc');
		}


		if($module === 'v3')
		{
			\content_v3\tools::master_check();
		}
		elseif($module === 'v3')
		{
			// \content_v3\tools::master_check();
		}
		elseif($module)
		{
			\dash\header::status(404);
		}

		// save api log
		\dash\app\apilog::start();
	}
}
?>