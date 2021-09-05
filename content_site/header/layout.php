<?php
namespace content_site\header;


class layout
{


	/**
	 * Layout blog html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{

		if(a($_args, 'use_as_logo')   === 'business_logo')
		{
			$_args['logo'] = \lib\store::logo();
		}

		if(a($_args, 'logo'))
		{
			$_args['logo'] = \lib\filepath::fix($_args['logo']);
		}

		if(a($_args, 'use_as_heading')       === 'business_heading')
		{
			$_args['heading'] = \lib\store::title();
		}

		if(a($_args, 'use_as_description')   === 'business_description')
		{
			$_args['description'] = \lib\store::desc();
		}

		if(a($_args, 'link_cart'))
		{
			$_args['cart_count'] = \lib\app\cart\get::my_cart_count();
		}

		if(a($_args, 'responsive_header_title'))
		{
			\dash\face::titlePWA(a($_args, 'responsive_header_title'));
		}

		if(a($_args, 'responsive_header_search_link') === false)
		{
			\dash\data::search_link(null);
		}
		else
		{
			\dash\data::search_link(\dash\url::kingdom().'/search');
		}

		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args);
	}
}
?>
