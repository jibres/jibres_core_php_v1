<?php
namespace content_site\body\visitcard;


class layout
{


	/**
	 * Layout visitcard html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{

		$social = \lib\store::all_social_list();

		foreach ($social as $key => $value)
		{
			if(a($_args, 'use_as_socialnetwork') === 'business_socialnetwork')
			{
				$my_social = \lib\store::social($key);
				if($my_social)
				{
					$_args[$key] = a($my_social, 'user');
				}
				else
				{
					$_args[$key] = null;
				}
			}

			if(a($_args, $key))
			{
				$_args[$key] = array_merge($value, ['user' => $_args[$key], 'link' => a($value, 'link'). $_args[$key]]);
			}
		}

		if(a($_args, 'use_as_logo')          === 'business_logo')
		{
			$_args['loog'] = \lib\store::logo();
		}

		if(!a($_args, 'logo'))
		{
			$_args['logo'] = \lib\store::logo();

			if(!$_args['logo'])
			{
				$_args['logo'] = \dash\url::icon();
			}
		}


		if(a($_args, 'use_as_heading')       === 'business_heading')
		{
			$_args['heading'] = \lib\store::title();
		}

		if(a($_args, 'use_as_description')   === 'business_description')
		{
			$_args['description'] = \lib\store::desc();
		}

		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args);
	}


}
?>