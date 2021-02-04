<?php $data = \dash\data::dataRow(); ?>
<?php if(\dash\data::toUserDetail()) {?>
  <nav class="items long">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::here(). '/member/glance?id='. \dash\data::dataRow_to_user();?>">
          <img src="<?php echo \dash\data::toUserDetail_avatar() ?>">
          <div class="key"><?php echo \dash\data::toUserDetail_displayname();?></div>
          <div class="value"><?php echo T_(\dash\data::toUserDetail_status());?></div>
          <div class="value"><?php echo \dash\fit::mobile(\dash\data::toUserDetail_mobile());?></div>
          <div class="go <?php echo $myIcon ?>"></div>

        </a>
      </li>
    </ul>
  </nav>
<?php } //endif ?>

<nav class="items">
  <ul>
      <li>
      <a class="f item">
        <div class="key"><?php echo T_("ID") ?></div>
        <div class="value txtB"><?php echo \dash\fit::text(\dash\data::dataRow_id()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
     <li>
      <a class="f item">
        <div class="key"><?php echo T_("Title") ?></div>
        <div class="value txtB"><?php echo \dash\data::dataRow_title(); ?></div>
        <div class="go detail"></div>
      </a>
     </li>

    <li>
      <a class="f item">
        <div class="key"><?php echo T_("Date created") ?></div>
        <div class="value txtB"><?php echo \dash\fit::date_time(\dash\data::dataRow_datecreated()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
     <?php if(\dash\data::dataRow_readdate()) {?>
     <li>
      <a class="f item">
        <div class="key"><?php echo T_("Read date") ?></div>
        <div class="value txtB"><?php echo \dash\fit::date_time(\dash\data::dataRow_readdate()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
   <?php  } //endif ?>
  </ul>
</nav>

<div class="box">
  <div class="pad">
      <p><?php echo nl2br(a($data, 'txt')); ?></p>
  </div>
</div>
