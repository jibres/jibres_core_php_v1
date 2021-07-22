<nav class="items long">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
     <li>
      <a class="item f align-center" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>">
        <div class="key"><?php echo strip_tags(a($value, 'title')); ?></div>
        <div class="value">
          <i><?php if(a($value, 'tag1')){echo '#'. a($value, 'tag1');} ?></i>
          <i><?php if(a($value, 'tag2')){echo '#'. a($value, 'tag2');} ?></i>
          <i><?php if(a($value, 'tag3')){echo '#'. a($value, 'tag3');} ?></i>
          <i><?php if(a($value, 'tag4')){echo '#'. a($value, 'tag4');} ?></i>
          <i><?php if(a($value, 'tag5')){echo '#'. a($value, 'tag5');} ?></i>
        </div>
        <time class="value"><?php echo \dash\fit::date(a($value, 'date')); ?></time>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>
