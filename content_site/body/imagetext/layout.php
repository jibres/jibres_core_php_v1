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
			$image = \content_site\assemble\element\magicbox::html($_args, [['file' => $_args['file']]]);
		}

		$text = null;

		$text .= '<div>';
		{
			$text .= a($_args, 'html_text');
		}
		$text .= '</div>';


		$html = \content_site\assemble\wrench\section::element_start($_args);
	    {
	    	$html .= \content_site\assemble\wrench\section::container($_args);
	    	{
		    	$html .= '<div class="row';
		    	if(a($_args, 'reverse'))
		    	{
		    		$html .= ' flex-row-reverse';
		    	}
		    	$html .= '">';
		    	{
					$html .= '<div class="c-xs-12 c-sm-6 c-md-6 flex items-center">';
					{
						$html .= $text;
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
	    	$html .= '</div>';
	    }
	    $html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


}
?>