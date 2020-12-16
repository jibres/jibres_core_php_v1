<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::this(). '/edit?id='.  a($value, 'id') ?>">
        <img src="<?php echo a($value, 'thumb'); ?>" alt="<?php echo T_("Post image") ?>">
        <div class="key"><?php echo a($value, 'title'); ?></div>
        <div class="value ltr"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></div>
        <div class="go <?php echo $value['icon_list'] ?>"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>


  <table class="tbl1 v1 fs11 tblFiles">
    <thead>
      <tr>
        <th></th>
        <th data-sort="<?php echo a($sortLink, 'title', 'order'); ?>"><a href='<?php echo a($sortLink, 'title', 'link'); ?>'><?php echo T_("File Name"); ?></a></th>
        <th class="max-w200 s0 m0" data-sort="<?php echo a($sortLink, 'type', 'order'); ?>"><a href='<?php echo a($sortLink, 'type', 'link'); ?>'><?php echo T_("Type"); ?></a></th>
        <th class="max-w200" data-sort="<?php echo a($sortLink, 'size', 'order'); ?>"><a href='<?php echo a($sortLink, 'size', 'link'); ?>'><?php echo T_("Size"); ?></a></th>
        <th class="max-w200 s0" data-sort="<?php echo a($sortLink, 'date', 'order'); ?>"><a href='<?php echo a($sortLink, 'date', 'link'); ?>'><?php echo T_("Date"); ?></a></th>
      </tr>
    </thead>

    <tbody>

      <?php foreach ($dataTable as $key => $value) {?>

      <tr>
        <td class="thumb">
          <a href="<?php echo $value['path']; ?>" target="_blank">
            <?php if(isset($value['type']) && $value['type'] === 'image') {?>

            <img src="<?php echo a($value, 'path'); ?>" alt="<?php echo a($value, 'title'); ?>">

            <?php }else{ ?>

            <div><span>.<?php echo a($value, 'ext'); ?></span></div>

            <?php } //endif ?>

          </a>
        </td>
        <td>
            <div class="fileName" title="<?php echo a($value, 'title'); ?>"><?php echo substr(a($value, 'title'), 0, 70); ?></div>
            <div class="f">
              <div class="c">
                <a class="badge primary" href="<?php echo a($value, 'path'); ?>" target="_blank"><?php echo T_("View"); ?></a>
              </div>

            </div>
        </td>
        <td class="s0 m0 ltr txtL collapsing"><i class="sf-file-<?php echo a($value, 'type'); ?>-o fs16 mR5"></i> <?php echo a($value, 'mime'); ?></td>
        <td><?php echo \dash\fit::number(a($value, 'size')); ?></td>
        <td class="s0 ltr txtL collapsing"><div><?php echo \dash\fit::date(a($value, 'datecreated')); ?></div></td>
      </tr>
      <?php }//endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

