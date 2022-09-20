<?php
namespace content_site\footer;


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

		\dash\data::currentFooterPwaBtn([]);

		if(a($_args, 'use_as_footer_link') === 'custom')
		{
			if(a($_args, 'responsive') && is_array($_args['responsive']))
			{
				foreach ($_args['responsive'] as $key => $value)
				{
					$_args['responsive'][$key]['url'] = \content_site\assemble\link::generate(a($value, 'link'), true);
				}
			}
			else
			{
				$_args['responsive'] = false;
			}
		}
		elseif(a($_args, 'use_as_footer_link') === 'none')
		{
			$_args['responsive'] = []; // bug fix
			// $_args['responsive'] = false;
		}
		else
		{
			$_args['responsive'] = [];
		}

		\dash\temp::set('AppendToSectionArray', ['footer_pwa_btn' => a($_args, 'responsive')]);

		\dash\data::currentFooterPwaBtn(a($_args, 'responsive'));



		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args);
	}
}
?>
