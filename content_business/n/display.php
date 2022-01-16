<?php
if(\dash\data::displayShowPostList())
{
	$html = '';
	$html .= '<div class="postBlock">';
	{
 		$html .= '<div class="avand">';
 		{
			$html .= '<div class="postList">';
			{
				foreach (\dash\data::dataTable() as $key => $value)
				{
					$html .= '<div class="text">';
					{

						$html .= '<section class="f">';
						{

							$html .= '<div class="cauto s12 pRa10 text-center">';
							{

								$html .= '<a href="'.a($value, 'link').'">';
								{
									if(a($value, 'thumb'))
									{
										$html .= '<img src="'.a($value, 'thumb').'" alt="'.a($value, 'title').'">';
									}
								}
								$html .= '</a>';
							}
							$html .= '</div>';

							$html .= '<div class="c s12">';
							{

								$html .= '<h3>';
								{
									$html .= '<a href="'.a($value, 'link').'">';
									{
										$html .= a($value, 'title');
									}
									$html .= '</a>';
								}
								$html .= '</h3>';
								$html .= '<p> ';
								{
									$html .= a($value, 'excerpt');
								}
								$html .= '</p>';
							}
							$html .= '</div>';
						}
						$html .= '</section>';
					}
					$html .= '</div>';

				} // endfi
			}
			$html .= '</div> ';
 		}
		$html .= '</div>';
	}
	$html .= '</div>';

	echo $html;

	\dash\utility\pagination::html();
}
else
{
	require_once(core. '/layout/post/layout-v2.php');
}
?>