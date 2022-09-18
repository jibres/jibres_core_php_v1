<div class="avand">
	<div class="row">
		<div class="c-xs-12 c-sm-12 c-lg-4 d-lg-block c-xl-3">
			  <?php require_once(root. 'content_business/profile/display-menu.php'); ?>
		</div>
		<div class="c-xs-12 c-sm-12 c-lg-8 c-xl-9">
			<?php

			$html = '';


			$sample  = \lib\app\setting\notification::get_sample_user(\dash\user::code());

			foreach ($sample as $event => $value)
			{

				if(!a($value, 'active'))
				{
					continue;
				}
			  $html .= '<div class="alert-info" >';

			  $html .= '<section class="f">';
			    $html .= '<div class="c8 s12">';
			      $html .= '<div class="data">';
			          if(!a($value, 'active'))
			          {
			            $html .= '<h3 class="text-gray-400">'. T_("Send sms") . ' '. a($value, 'title').'</h3>';
			          }
			          else
			          {
			            $html .= '<h3>'. T_("Send sms") . ' '. a($value, 'title').'</h3>';
			          }
			          $html .= '<div class="body">';
			          if(!a($value, 'active'))
			          {
			            $html .= '<p class="text-gray-400">'. a($value, 'text').'</p>';
			            $html .= '<i class="text-gray-400">'. T_("Disabled from sms setting").'</i>';
			          }
			          else
			          {
			            $html .= '<p>'. a($value, 'text').'</p>';
			          }
			        $html .= '</div>';
			      $html .= '</div>';
			    $html .= '</div>';
			    $html .= '<form class="c4 s12" method="post" data-patch>';
			      $html .= '<input type="hidden" name="set_'.$event.'" value="1">';
			      $html .= '<div class="action">';
			        $html .= '<div class="switch1">';
			          $html .= '<input type="checkbox" name="'.$event.'" id="set_'.$event.'" ';
			          if(!a($value, 'active'))
			          {
			            $html .= 'class="disabled" ';
			          }
			          if(a($value, 'user_active') && a($value, 'active'))
			          {
			            $html .= 'checked';
			          }
			          $html .= '>';
			          $html .= '<label for="set_'.$event.'" data-on="'. T_("On") .'" data-off="'. T_("Off"). '"></label>';
			        $html .= '</div>';
			      $html .= '</div>';
			    $html .= '</form>';

			  $html .= '</section>';

			  $html .= '</div>';
			}

			echo $html;
			?>
		</div>
	</div>
</div>
