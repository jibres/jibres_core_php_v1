<?php 
if(isset($currentSectionDetail['discardable']) && $currentSectionDetail['discardable'] && \dash\url::subchild())
{
	$html .= '<nav class="items long mT20">';
	{
	    $html .= '<ul>';
	    {
	      $html .= '<li>';
	      {
	          $html .= "<div class='item f' data-confirm data-data='{\"discard\": \"discard\"}'>";
	          {
	            $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" alt="Undo" src="'. \dash\utility\icon::url('Undo'). '">';
	            $html .= '<div class="key">'. T_("Discard change"). '</div>';
	            $html .= '<div class="go"></div>';
	          }
	          $html .= '</div>';
	      }
	      $html .= '</li>';
	    }
	    $html .= '</ul>';
	}
	$html .= '</nav>';
}
?>