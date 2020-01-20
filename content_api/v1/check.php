<?php
namespace content_api\v1;


class check
{
	public static function basic_api_detail()
	{

		if(!in_array(\dash\url::subdomain(), ['developers', null]))
		{
			\dash\redirect::remove_subdomain();
		}

		$module = \dash\url::module();

		if(!$module || ($module === 'doc' && !\dash\url::child()) || (in_array($module, ['v1', 'v2'])))
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
			\dash\redirect::to(\dash\url::here(). '/v1/doc');
		}


		if($module === 'v1')
		{
			\content_api\v1\tools::master_check();
		}
		elseif($module === 'v2')
		{
			// \content_api\v1\tools::master_check();
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