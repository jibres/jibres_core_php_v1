<?php
if(\dash\data::propertyList())
{
  $html .= '<div class="box productInfo">';
  {
	$html .= '<table class="tbl1 responsive v5">';
	{
		foreach (\dash\data::propertyList() as $property => $cat)
		{
		    $html .= '<tr class="group">';
		    {
		        $html .= '<th colspan="2">';
		        {
		        	$html .= $cat['title'];
		        }
		        $html .= '</th>';
		    }
		    $html .= '</tr>';
			foreach ($cat['list'] as $key => $value)
			{
				if(is_null(a($value, 'value')))
				{
					continue;
				}
			    $html .= '<tr>';
			    {
			        $html .= '<th>';
			        {
			        	$html .= $value['key'];
			        }
			        $html .= '</th>';
			        $html .= '<td>';
			        {

			          if(a($value, 'link'))
			          {
			            $html .= '<a href="'. a($value, 'link') .'">'. $value['value']. '</a>';
			          }
			          else
			          {
			            if(a($value, 'bold'))
			            {
			              $html .= '<div class="txtB">';
			            }

			            if(is_numeric($value['value']))
			            {
			            	$html .=  \dash\fit::number($value['value']);
			            }
			            else
			            {
			            	$html .= $value['value'];
			            };

			            if(a($value, 'unit'))
			            {
			            	$html .= '<small class="fc-mute">'. a($value, 'unit'). '</small>';
			            }

			            if(a($value, 'bold'))
			            {
			              $html .= '</div>';
			            }
			          }
			        }
			        $html .= '</td>';

			    }
			    $html .= '</tr>';
			}
		}
	}
	$html .= '</table>';

  }
  $html .= '</div>';
}
?>