<?php
$listPermission = \dash\data::listPermission();
if(!is_array($listPermission))
{
  $listPermission = [];
}
?>

<?php if($listPermission) {?>

  <h3><?php echo T_("List of permissions") ?></h3>
  <nav class="items">
     <ul>
    <?php foreach ($listPermission as $key => $value) { ?>
        <li>
          <a class="f" href="<?php echo \dash\url::this(). '/edit?id='. $value['id']; ?>">
            <div class="key"><?php echo \dash\get::index($value, 'key'); ?></div>
            <?php if(\dash\get::index($value, 'user_count')) {?>
              <div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'user_count')). ' '. T_("Person") ?> </div>
            <?php } //endif ?>
            <div class="go"></div>
          </a>
        </li>
    <?php } //endif ?>
     </ul>
  </nav>

<?php }else{ ?>
<div class="msg info2 txtB font-14">
  <p><?php echo T_("Hi") ?></p>
  <p><?php echo T_("You have not any permission group") ?></p>
  <p><a href="<?php echo \dash\url::this(). '/add' ?>"><?php echo T_("Add new permission") ?></a></p>

</div>
<?php } //endif ?>

