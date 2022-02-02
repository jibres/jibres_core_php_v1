<?php
namespace content_site\body\imagetext;


class layout
{
	/**
	 * Layout imagetext html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$image = null;
		if(a($_args, 'file'))
		{
			$image = '<img src="'. \lib\filepath::fix($_args['file']). '">';
		}

		$html = \content_site\assemble\wrench\section::element_start($_args);
	    {
	    	$html .= \content_site\assemble\wrench\section::container($_args);
	    	{
		    	$html .= '<div class="content-center m-auto">';
		    	{
		    		if(a($_args, 'position') === 'left')
		    		{
		    			$html .= '<div class="row">';
			    		{
							$html .= '<div class="c-xs-12 c-sm-6 c-md-6">';
							{
								$html .= a($_args, 'html_text');
							}
							$html .= '</div>';
							$html .= '<div class="c-xs-12 c-sm-6 c-md-6">';
							{
								$html .= $image;
							}
							$html .= '</div>';
			    		}
			    		$html .= '</div>';
		    		}
		    		elseif(a($_args, 'position') === 'right')
		    		{
			    		$html .= '<div class="row">';
			    		{
							$html .= '<div class="c-xs-12 c-sm-6 c-md-6">';
							{
								$html .= $image;
							}
							$html .= '</div>';
							$html .= '<div class="c-xs-12 c-sm-6 c-md-6">';
							{
								$html .= a($_args, 'html_text');
							}
							$html .= '</div>';
			    		}
			    		$html .= '</div>';
		    		}
		    		elseif(a($_args, 'position') === 'up')
		    		{

						$html .= '<div class="">';
						{
							$html .= $image;
						}
						$html .= '</div>';
						$html .= '<div class="">';
						{
							$html .= a($_args, 'html_text');
						}
						$html .= '</div>';

		    		}
		    		elseif(a($_args, 'position') === 'down')
		    		{

						$html .= '<div class="">';
						{
							$html .= a($_args, 'html_text');
						}
						$html .= '</div>';
						$html .= '<div class="">';
						{
							$html .= $image;
						}
						$html .= '</div>';

		    		}
	    		}
	    		$html .= '</div>';
	    	}
	    	$html .= '</div>';
	    }
	    $html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


}
?>