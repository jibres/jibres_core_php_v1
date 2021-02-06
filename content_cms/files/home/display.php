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

<section class="row">
  <div class="c-xs-6 c-sm-3">
    <a href="<?php echo \dash\url::this(). '/datalist?type=image'; ?>" class="stat x70">
      <h3><?php echo T_("Images");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'image'));?></div>
    </a>
  </div>
  <div class="c-xs-6 c-sm-3">
    <a href="<?php echo \dash\url::this(). '/datalist?type=audio'; ?>" class="stat x70">
      <h3><?php echo T_("Audio");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'audio'));?></div>
    </a>
  </div>
  <div class="c-xs-6 c-sm-3">
    <a href="<?php echo \dash\url::this(). '/datalist?type=video'; ?>" class="stat x70">
      <h3><?php echo T_("Vedeo");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'video'));?></div>
    </a>
  </div>
  <div class="c-xs-6 c-sm-3">
    <a href="<?php echo \dash\url::this(). '/datalist?type=other'; ?>" class="stat x70">
      <h3><?php echo T_("Other");?></h3>
      <div class="val"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'other'));?></div>
    </a>
  </div>
</section>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
    <div id="chartdivcmsfiles" class="box chart x270 s0" data-abc='cms/files'>
      <div class="hide">
        <div id="charttitleunit"><?php echo T_("Count") ?></div>
        <div id="chartfiletitle"><?php echo T_("File") ?></div>
        <div id="charttitle"><?php echo T_("Total file count per type") ?></div>
        <div id="chartcategory"><?php echo a($dashboard, 'charttype', 'category') ?></div>
        <div id="chartdata"><?php echo a($dashboard, 'charttype', 'data') ?></div>
      </div>
    </div>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">

<?php if($provider) {?>
    <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::kingdom(). '/a/setting/thirdparty'; ?>">
          <img class="avatar" src="<?php echo $provider['image'] ?>" alt="<?php echo $dashboard['upload_provider_name'] ?>">
          <div class="key"><?php echo T_("Your file is uploaded on :provider ", ['provider' => $provider['title']]) ?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>
<?php } //endif ?>

    <nav class="items long">
     <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist">
          <i class="sf-files-o"></i>
          <div class="key"><?php echo T_('Total file');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'total_count')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?order=desc&sort=size">
          <i class="sf-lamp"></i>
          <div class="key"><?php echo T_('Total size');?></div>
          <div class="value"><?php echo \dash\fit::file_size(a($dashboard, 'total_size')); ?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>
    <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/add">
          <i class="sf-cloud-upload"></i>
          <div class="key"><?php echo T_('Upload');?></div>

          <div class="go plus ok"></div>
        </a>
      </li>
     </ul>
   </nav>


  <nav class="items long">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=image">
          <i class="sf-file-image-o"></i>
          <div class="key"><?php echo T_('Image');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'image')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=audio">
          <i class="sf-music"></i>
          <div class="key"><?php echo T_('Audio');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'audio')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=video">
          <i class="sf-file-video-o"></i>
          <div class="key"><?php echo T_('Video');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'video')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=pdf">
          <i class="sf-file-pdf-o"></i>
          <div class="key"><?php echo T_('PDF');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'pdf')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=archive">
          <i class="sf-file-archive-o"></i>
          <div class="key"><?php echo T_('ZIP');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboard, 'type_count', 'archive')); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist?type=other">
          <i class="sf-file-o"></i>
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
        <a class="item f">
          <i class="sf-database"></i>
          <div class="key"><?php echo T_('Storage limit');?></div>
          <div class="value"><?php echo \dash\fit::file_size(a($dashboard, 'storage_limit')); ?></div>
          <div class="go detail"></div>
        </a>
      </li>
      <li>
        <a class="item f">
          <i class="sf-battery-half"></i>
          <div class="key"><?php echo T_('Useage percent');?></div>
          <div class="value"><?php echo \dash\fit::text(a($dashboard, 'used_percent')). ' '. T_("%"); ?></div>
          <div class="go detail"></div>
        </a>
      </li>
     </ul>
   </nav>



  </div>
</div>
</div>