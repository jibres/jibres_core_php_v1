<nav class="items long">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) { ?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::that(). '/view?id='. $value['id'] ?>">
        <div class="key">
<?php
echo T_("Ticket"). ' <span class="fc-fb">#'. $value['id']. '</span> ';
echo a($value, 'displayname');
if(a($value, 'title')) { echo  ' | <b>'. a($value, 'title'). '</b>';}
 ?>
          <?php  ?>
          <?php  ?>

        </div>
        <div class="value s0"></div>
        <div class="value txtB s0"><?php if(a($value, 'plus')) { echo \dash\fit::number(a($value, 'plus')). ' <i class="sf-refresh"></i>';} ?></div>
        <div class="value"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        <div class="go <?php echo a($value, 'statuclass') ?>"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>

