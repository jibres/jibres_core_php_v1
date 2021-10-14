<?php
$sidebar_links = [];

$sidebar_links[] =
[
  'href'   => \dash\url::here(). '/sitemap',
  'title'  => T_("Sitemap"),
  'icon'   => 'Globe',
  'direct' => false,
];


if(\dash\permission::check('siteBuilderSetting'))
{
  $sidebar_links[] =
  [
    'href'   => \dash\url::here(). '/staticfile',
    'title'  => T_("Static file"),
    'icon'   => 'Tools',
    'direct' => false,
  ];
}

if(\dash\permission::check('_group_cms'))
{
  $sidebar_links[] =
  [
    'href'   => \dash\url::kingdom(). '/cms',
    'title'  => T_("Content Management"). T_(" & "). T_("Blog"),
    'icon'   => 'Note',
    'direct' => true,
  ];
}

if(\dash\permission::check('cmsAttachmentView'))
{
  $sidebar_links[] =
  [
    'href'   => \dash\url::kingdom(). '/cms/files',
    'title'  => T_("Files"),
    'icon'   => 'Folder',
    'direct' => true,
  ];
}



if(\dash\permission::check('siteBuilderSetting'))
{
  $sidebar_links[] =
  [
    'href'   => \dash\url::kingdom(). '/a/setting/legal',
    'title'  => T_("Legal pages"),
    'icon'   => 'FraudProtectUnprotected',
    'direct' => true,
  ];
}



if(\dash\permission::check('siteBuilderSetting'))
{
  $sidebar_links[] =
  [
    'href'   => \dash\url::kingdom(). '/a/setting/domain',
    'title'  => T_("Domains"),
    'icon'   => 'Domains',
    'direct' => true,
  ];

}


if(\dash\permission::check('siteBuilderSetting'))
{
  $sidebar_links[] =
  [
    'href'   => \dash\url::kingdom(). '/a/setting/menu',
    'title'  => T_("Menu"),
    'icon'   => 'MobileHamburger',
    'direct' => true,
  ];
}

/*=====================================
=            Generate html            =
=====================================*/

$html = '';

foreach ($sidebar_links as $key => $value)
{
  $html .= '<nav class="sections items">';
  {
    $html .= '<ul>';
    {
      $html .= '<li>';
      {
        $html .= "<a class='item f' href='". a($value, 'href'). "'";
        if(a($value, 'direct'))
        {
          $html .= ' data-direct';
        }

        $html .= ">";
        {
          $html .= '<div class="key">'. a($value, 'title'). '</div>';
          {
            $html .= '<img class="p-2.5" src="'. \dash\utility\icon::url(a($value, 'icon')). '">';
          }
          $html .= '</a>';
        }
      }
      $html .= '</li>';
    }
    $html .= '</ul>';
  }
  $html .= '</nav>';

}



echo $html;


/*=====  End of Generate html  ======*/

?>
