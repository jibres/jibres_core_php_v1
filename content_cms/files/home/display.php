<?php
$dashboard = \dash\data::dashboardDetail();
$provider = [];
if(a($dashboard, 'upload_special_provider') && a($dashboard, 'upload_provider_name'))
{
  switch ($dashboard['upload_provider_name'])
  {

    case 'arvancloud':
      $provider['title'] = T_("ArvanCloud");
      $provider['image'] = \dash\url::cdn(). '/img/thirdparty/arvancloud.svg';
      break;

    case 'digitalocean':
      $provider['title'] = T_("DigitalOcean");
      $provider['image'] = \dash\url::cdn(). '/img/thirdparty/digitalocean.svg';
      break;

    case 'aws':
    default:
      $provider['title'] = T_("AWS");
      $provider['image'] = \dash\url::cdn(). '/img/thirdparty/aws.svg';
      break;
  }
}

?>


<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
    <div class="row">
      <div class="c-xs-12 c-sm-12 c-md-6">
        <div id="chartdivcmsfiles" class="box chart x470 s0" data-abc='cms/files'>
          <div class="hide">
            <div id="charttitleunit"><?php echo T_("Count") ?></div>
            <div id="chartfiletitle"><?php echo T_("File") ?></div>
            <div id="charttitle"><?php echo T_("Total file count per type") ?></div>
            <div id="chartcategory"><?php echo a($dashboard, 'charttype', 'category') ?></div>
            <div id="chartdata"><?php echo a($dashboard, 'charttype', 'data') ?></div>
          </div>
        </div>
      </div>

      <div class="c-xs-12 c-sm-12 c-md-6">
        <div id="chartdivcmsfilessize" class="box chart x470 s0" data-abc='cms/files'>
          <div class="hide">
            <div id="charttitleunitsize"><?php echo T_("Size") ?></div>
            <div id="chartfiletitlesize"><?php echo T_("File") ?></div>
            <div id="charttitlesize"><?php echo T_("Total file size per type") ?></div>
            <div id="chartcategorysize"><?php echo a($dashboard, 'charttypesize', 'category') ?></div>
            <div id="chartdatasize"><?php echo a($dashboard, 'charttypesize', 'data') ?></div>
          </div>
        </div>
      </div>

    </div>
<?php if($provider) {?>
    <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::kingdom(). '/a/setting/thirdparty'; ?>">
          <img class="avatar" src="<?php echo $provider['image'] ?>" alt="<?php echo $dashboard['upload_provider_name'] ?>">
          <div class="key"><?php echo T_("Your file is uploaded on :provider ", ['provider' => a($provider, 'title')]) ?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>
<?php } //endif ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">

   <nav class="items long">
     <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist">
          <?php echo \dash\utility\icon::svg('file-earmark-medical', 'bootstrap'); ?>
          <div class="key"><?php echo T_('Total file');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'total_count')); ?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>

  <nav class="items long">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=image">
          <?php echo \dash\utility\icon::svg('file-earmark-image', 'bootstrap') ?>
          <div class="key"><?php echo T_('Image');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'image')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=audio">
          <?php echo \dash\utility\icon::svg('file-earmark-music', 'bootstrap') ?>
          <div class="key"><?php echo T_('Audio');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'audio')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=video">
          <?php echo \dash\utility\icon::svg('file-earmark-play', 'bootstrap') ?>
          <div class="key"><?php echo T_('Video');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'video')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=pdf">
          <?php echo \dash\utility\icon::svg('file-earmark-pdf', 'bootstrap') ?>
          <div class="key"><?php echo T_('PDF');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'pdf')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=archive">
          <?php echo \dash\utility\icon::svg('file-earmark-zip', 'bootstrap') ?>
          <div class="key"><?php echo T_('ZIP');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'archive')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=other">
          <?php echo \dash\utility\icon::svg('file-earmark', 'bootstrap') ?>
          <div class="key"><?php echo T_('Other files');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'other')); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>

   <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/add">
          <?php echo \dash\utility\icon::svg('cloud-arrow-up', 'bootstrap') ?>
          <div class="key"><?php echo T_('Upload New File');?></div>

          <div class="go plus ok"></div>
        </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
        <a class="item f">
          <?php echo \dash\utility\icon::svg('sd-card', 'bootstrap') ?>
          <div class="key"><?php echo T_('Storage Limit');?></div>
          <div class="value"><?php echo \dash\fit::file_size(a($dashboard, 'storage_limit')); ?></div>
          <div class="go detail"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?order=desc&sort=size">
          <?php echo \dash\utility\icon::svg('battery-full', 'bootstrap') ?>
          <div class="key"><?php echo T_('Used Space');?></div>
          <div class="value"><?php echo \dash\fit::file_size(a($dashboard, 'total_size')); ?></div>
          <div class="go detail"></div>
        </a>
      </li>
      <li>
        <a class="item f">
          <?php echo \dash\utility\icon::svg('battery-half', 'bootstrap') ?>
          <div class="key"><?php echo T_('Useage percent');?></div>
          <div class="value font-bold"><?php echo \dash\fit::text(a($dashboard, 'used_percent')). ' '. T_("%"); ?></div>
          <div class="go detail"></div>
        </a>
      </li>
     </ul>
   </nav>



  </div>
</div>
</div>