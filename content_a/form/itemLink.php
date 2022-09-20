<?php
$links   = [];
$links[] =
	[
		'group' => 1,
		'path'  => 'dashboard',
		'icon'  => 'sf-gauge',
		'title' => T_("Form Dashboard"),
	];
$links[] =
	[
		'group' => 2,
		'path'  => 'edit',
		'icon'  => 'sf-list-ul',
		'title' => T_("Items list"),
	];

$links[] =
	[
		'group' => 2,
		'path'  => 'setting',
		'icon'  => 'sf-pencil-square-o',
		'title' => T_("Edit form setting"),
	];

$links[] =
	[
		'group' => 2,
		'path'  => 'thankyou',
		'icon'  => 'sf-heart-o',
		'title' => T_("Thank you message"),
	];


$links[] =
	[
		'group' => 2,
		'path'  => 'status',
		'icon'  => 'sf-plug',
		'title' => T_("Status"),
	];

$links[] =
	[
		'group' => 2,
		'path'  => 'sorting',
		'icon'  => 'sf-sort',
		'title' => T_("Sort items"),
	];


$links[] =
	[
		'group' => 2,
		'path'  => 'tag',
		'icon'  => 'sf-tag',
		'title' => T_("Tags"),
	];


$links[] =
	[
		'group' => 2,
		'path'  => 'condition',
		'icon'  => 'sf-atom',
		'title' => T_("Form condition"),
	];

$links[] =
	[
		'group' => 2,
		'path'  => 'inquiry',
		'icon'  => 'sf-group-full',
		'title' => T_("Inquiry"),
	];


$links[] =
	[
		'group' => 2,
		'path'  => 'resultpage',
		'icon'  => 'sf-eye',
		'title' => T_("Result page"),
	];


$links[] =
	[
		'group' => 3,
		'path'  => 'answer',
		'icon'  => 'sf-file-text',
		'title' => T_("Answers"),
	];


$links[] =
	[
		'group' => 3,
		'path'  => 'report',
		'icon'  => 'sf-pie-chart',
		'title' => T_("Reports"),
	];

if(\content_a\form\analytics\controller::check_count_answer_1000())
{

	$links[] =
		[
			'group' => 4,
			'path'  => 'analytics',
			'icon'  => 'sf-analytics-chart-graph',
			'title' => T_("Analyze answers"),
		];

}
$links[] =
	[
		'group' => 5,
		'path'  => 'item/add',
		'icon'  => 'sf-plus ok',
		'title' => T_("Add new question"),
	];


$html       = '';
$last_group = null;
$id         = \dash\request::get('id');
$urlThis    = \dash\url::this();
foreach ($links as $key => $link)
{
	if($link['group'] !== $last_group)
	{
		$last_group = $link['group'];
		$html       .= '<nav class="items long">';
		$html       .= '<ul>';
	}

	$ok = null;
	if(\dash\url::child() === $link['path'] || \dash\url::child() === substr($link['path'], 0, strpos($link['path'], '/')))
	{
		$ok = 'ok';
	}

	$html .= '<li>';
	{
		$html .= '<a class="f item" href="' . $urlThis . '/' . $link['path'] . '?id=' . $id . '">';
		{
			$html .= '<i class="' . $link['icon'] . '"></i>';
			$html .= '<div class="key">' . $link['title'] . '</div>';
			$html .= '<div class="go ' . $ok . '"></div>';
		}
		$html .= '</a>';
	}
	$html .= '</li>';

	if(a($links, ($key + 1), 'group') !== $last_group)
	{

		$html .= '</ul>';
		$html .= '</nav>';
	}


}
echo $html;
?>