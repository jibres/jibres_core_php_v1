

<?php pageStepsList(); ?>

<?php
if(\dash\data::dataTable())
{
  if(\dash\data::dataFilter())
  {
    htmlSearchBox();
    htmlTable();
    htmlFilter();

  }
  else
  {
    htmlSearchBox();
    htmlTable();

  }
}
else
{
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlFilterNoResult();

  }
  else
  {
    htmlStartAddNew();

  }
}


?>




<?php function htmlSearchBox() {?>

<div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' >

    <?php if(\dash\data::allNeedSearch()) {?>
      <?php foreach (\dash\data::allNeedSearch() as $key => $value) {?>
        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
      <?php } //endfor ?>
    <?php }// nedif ?>

    <div class="input">
      <label for="q" data-kerkere=".ShowFilterResult" data-kerkere-icon class="addon"><?php echo T_("Advance result"); ?></label>
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?>  data-pass='submit' autocomplete='off'>
      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
    <?php iKerkere(); ?>
  </form>
</div>
<?php } //endfunction ?>


<?php function htmlTable() {?>
  <?php if(\dash\permission::supervisor() && \dash\request::get('duplicate')) {?>

  <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr>
        <th><?php echo \dash\request::get('duplicate'); ?></th>
        <th><?php echo T_("Count"); ?></th>
        <th><?php echo T_("Show"); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>

      <tr>
        <td><?php echo @$value[\dash\request::get('duplicate')]; ?></td>
        <td><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?></td>
        <td><a href="<?php echo \dash\url::this(); ?>?find<?php echo \dash\request::get('duplicate'); ?>=<?php echo @$value[\dash\request::get('duplicate')]; ?>&showlog=1" class="badge warn"><?php echo T_("Detail"); ?></a></td>
      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
  <?php \dash\utility\pagination::html(); ?>


<?php }else{ ?>


<?php
$sortLink = \dash\data::sortLink();

$shoLogUrl = '';
if(\dash\request::get('showlog'))
{
  $shoLogUrl = '&showlog=1';
}

$statuUrl = '';
if(\dash\request::get('status'))
{
  $shoLogUrl = '&status='. \dash\request::get('status');
}

?>
<table class="tbl1 v1 cbox fs12">
    <thead>
      <tr class="fs07">
        <th data-sort="<?php echo \dash\get::index($value, 'username', 'order'); ?>">
          <a href='<?php echo \dash\get::index($value, 'username', 'link'); ?>'><?php echo T_("Username"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'displayname', 'order'); ?>">
          <a href='<?php echo \dash\get::index($value, 'displayname', 'link'); ?>'><?php echo T_("Display Name"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'mobile', 'order'); ?>" class="collapsing">
          <a href='<?php echo \dash\get::index($value, 'mobile', 'link'); ?>'><?php echo T_("Mobile"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'email', 'order'); ?>" class="collapsing s0 m0">
          <a href='<?php echo \dash\get::index($value, 'email', 'link'); ?>'><?php echo T_("Email"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'password', 'order'); ?>" class="collapsing s0">
          <a href='<?php echo \dash\get::index($value, 'password', 'link'); ?>'><?php echo T_("Password"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'status', 'order'); ?>" class="collapsing s0">
          <a href='<?php echo \dash\get::index($value, 'status', 'link'); ?>'><?php echo T_("Status"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'permission', 'order'); ?>" class="collapsing s0 m0">
          <a href='<?php echo \dash\get::index($value, 'permission', 'link'); ?>'><?php echo T_("Permission"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'datecreated', 'order'); ?>" class="collapsing s0 m0">
          <a href='<?php echo \dash\get::index($value, 'datecreated', 'link'); ?>'><?php echo T_("Created date"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'datemodified', 'order'); ?>" class="collapsing s0 m0">
          <a href='<?php echo \dash\get::index($value, 'datemodified', 'link'); ?>'><?php echo T_("Last Modified"); ?></a>
        </th>
        <th>
          <?php echo T_("Edit"); ?>
        </th>
      </tr>
    </thead>
    <tbody>

      <?php foreach (\dash\data::dataTable() as $key => $value) {?>


      <tr <?php if(isset($value['status']) && in_array($value['status'], ['disable','removed','filter','unreachable'])) { echo ' class= "negative"';}else{}?>>
        <td>
          <a href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo $value['id']; ?><?php echo $shoLogUrl; ?>">
            <img src="<?php echo $value['avatar']; ?>" alt='<?php echo $value['id']; ?>' width="40" class="pRa5"> <?php echo $value['username']; ?>
          </a>
        </td>
        <td>
          <div class="s0">
            <small>
              <a href="<?php echo \dash\url::this(); ?>?gender=<?php echo $value['gender']; ?><?php echo $statuUrl; ?>"><?php if($value['gender'] === 'male') { echo T_("Mr"); }elseif($value['gender'] == 'female') { echo T_("Mrs"); }else{ echo '-';} ?></a>
              <a href="<?php echo \dash\url::this(); ?>?firstname=<?php echo urlencode($value['firstname']); ?><?php echo $statuUrl; ?>"><?php echo $value['firstname']; ?></a>
            </small>
            <a href="<?php echo \dash\url::this(); ?>?lastname=<?php echo urlencode($value['lastname']); ?><?php echo $statuUrl; ?>"><?php echo $value['lastname']; ?></a>
          </div>
          <div class="mT5">
            <a href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo $value['id']; ?><?php echo $shoLogUrl; ?>" class="txtB block"><span class="sf-user"></span> <?php echo $value['displayname']; ?></a>
          </div>
        </td>
        <td class="pRa5">
          <a href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo $value['id']; ?><?php echo $shoLogUrl; ?>"><?php echo \dash\fit::mobile($value['mobile']); ?></a>
        </td>
        <td class="s0 m0 pRa5">
          <a href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo $value['id']; ?><?php echo $shoLogUrl; ?>"><?php echo $value['email']; ?></a>
        </td>
        <td class="s0 collapsing">

          <?php if(isset($value['password']) && $value['password']) {?><i class="sf-check fc-green" title='<?php echo T_("Password is set"); ?>'></i><?php }else{ ?><i class="sf-times fc-red" title='<?php echo T_("Password is not set!"); ?>'></i><?php }//endif ?>
          <?php if(isset($value['twostep']) && $value['twostep']) {?><a href="<?php echo \dash\url::this(); ?>?twostep=yes<?php echo $statuUrl; ?>"><i class="sf-unlock-alt fc-green" title='<?php echo T_("Two step verification in enabled"); ?>'></i></a><?php }else{ ?><i class="sf-unlock fc-mute" title='<?php echo T_("Two step verification in disable"); ?>'></i><?php }//endif ?>
          <?php if(isset($value['chatid']) && $value['chatid']) {?><a href="<?php echo \dash\url::this(); ?>?chatid=yes<?php echo $statuUrl; ?>"><i class="sf-paper-plane fc-blue" title='<?php echo T_("Have chatid"); ?>'></i></a><?php }else{ ?><a href="<?php echo \dash\url::this(); ?>?chatid=no<?php echo $statuUrl; ?>"><i class="sf-paper-plane fc-mute" title='<?php echo T_("Have not chatid"); ?>'></i></a><?php }//endif ?>
          <?php if(isset($value['android_uniquecode']) && $value['android_uniquecode']) {?><a href="<?php echo \dash\url::this(); ?>?android_uniquecode=yes<?php echo $statuUrl; ?>"><i class="sf-android fc-blue" title='<?php echo T_("Have android_uniquecode"); ?>'></i></a><?php }else{ ?><a href="<?php echo \dash\url::this(); ?>?android_uniquecode=no<?php echo $statuUrl; ?>"><i class="sf-android fc-mute" title='<?php echo T_("Have not android uniquecode"); ?>'></i></a><?php }//endif ?>

          <?php if(isset($value['email']) && $value['email']) {?>

            <a href="<?php echo \dash\url::this(); ?>?email=yes<?php echo $statuUrl; ?>">
              <i class="sf-at fc-blue" title='<?php echo T_("Have email"); ?>'></i>
            </a>

          <?php }else{ ?>

            <a href="<?php echo \dash\url::this(); ?>?email=no<?php echo $statuUrl; ?>">
              <i class="sf-at fc-mute" title='<?php echo T_("Have not email"); ?>'></i>
            </a>

          <?php } //endif ?>

        </td>
        <td class="s0">
          <a href="<?php echo \dash\url::this(); ?>?status=<?php echo $value['status']; ?>"><?php echo T_($value['status']); ?></a>
        </td>
        <td class="s0 m0">
          <a href="<?php echo \dash\url::this(); ?>?permission=<?php echo $value['permission']; ?><?php echo $statuUrl; ?>"><?php echo T_(ucfirst($value['permission'])); ?></a>
        </td>
        <td class="s0 m0"><small class="fc-mute"><?php if(isset($value['datecreated']) && $value['datecreated']) { echo \dash\fit::date_human($value['datecreated']); }else{ echo '-';} ?></small></td>
        <td class="s0 m0"><small class="fc-mute"><?php if(isset($value['datemodified']) && $value['datemodified']) { echo \dash\fit::date_human($value['datemodified']); }else{ echo '-';} ?></small></td>
        <td class="collapsing"><a href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo $value['id']; ?><?php echo $shoLogUrl; ?>"><i class="sf-edit fc-blue"></i></a></td>
      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html() ?>

<?php } //endif ?>


<?php } //endfunction ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?><?php if(\dash\request::get('status')) { echo '?status='. \dash\request::get('status');} ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?><?php if(\dash\request::get('status')) { echo '?status='. \dash\request::get('status');} ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?> <a href="<?php echo \dash\url::this(); ?>/add"><?php echo T_("Try to start with add new user!"); ?></a></p>
<?php } //endfunction ?>







<?php function iKerkere() {?>



<div class="ShowFilterResult"
<?php if(
  !\dash\request::get('username')      &&
  !\dash\request::get('avatar')        &&
  !\dash\request::get('displayname')   &&
  !\dash\request::get('mobile')        &&
  !\dash\request::get('chatid')        &&
  !\dash\request::get('android_uniquecode')       &&
  !\dash\request::get('email')         &&
  !\dash\request::get('password')      &&
  !\dash\request::get('twostep')       &&
  !\dash\request::get('permission')    &&
  !\dash\request::get('language')      &&
  !\dash\request::get('duplicate')
)
{
  echo "data-kerkere-content='hide'";
}
?>
>

    <h6 data-kerkere=".showFilterBymobile" data-kerkere-icon><?php echo T_("Filter by mobile"); ?></h6>
    <div class="showFilterBymobile" <?php if(!\dash\request::get('mobile')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFiltermobile(); ?>
    </div>

    <h6 data-kerkere=".showFilterByUsername" data-kerkere-icon><?php echo T_("Filter by username"); ?></h6>
    <div class="showFilterByUsername" <?php if(!\dash\request::get('username')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFilterUsername(); ?>
    </div>

    <h6 data-kerkere=".showFilterByemail" data-kerkere-icon><?php echo T_("Filter by email"); ?></h6>
    <div class="showFilterByemail" <?php if(!\dash\request::get('email')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFilteremail(); ?>
    </div>

    <h6 data-kerkere=".showFilterBychatid" data-kerkere-icon><?php echo T_("Filter by chatid"); ?></h6>
    <div class="showFilterBychatid" <?php if(!\dash\request::get('chatid')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFilterchatid(); ?>
    </div>

    <h6 data-kerkere=".showFilterByandroid" data-kerkere-icon><?php echo T_("Filter by android_uniquecode"); ?></h6>
    <div class="showFilterByandroid" <?php if(!\dash\request::get('android_uniquecode')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFilterandroid(); ?>
    </div>

    <h6 data-kerkere=".showFilterByavatar" data-kerkere-icon><?php echo T_("Filter by avatar"); ?></h6>
    <div class="showFilterByavatar" <?php if(!\dash\request::get('avatar')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFilteravatar(); ?>
    </div>

    <h6 data-kerkere=".showFilterBydisplayname" data-kerkere-icon><?php echo T_("Filter by displayname"); ?></h6>
    <div class="showFilterBydisplayname" <?php if(!\dash\request::get('displayname')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFilterdisplayname(); ?>
    </div>

    <h6 data-kerkere=".showFilterBypassword" data-kerkere-icon><?php echo T_("Filter by password"); ?></h6>
    <div class="showFilterBypassword" <?php if(!\dash\request::get('password')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFilterpassword(); ?>
    </div>

    <h6 data-kerkere=".showFilterBytwostep" data-kerkere-icon><?php echo T_("Filter by twostep"); ?></h6>
    <div class="showFilterBytwostep" <?php if(!\dash\request::get('twostep')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFiltertwostep(); ?>
    </div>

    <h6 data-kerkere=".showFilterBypermission" data-kerkere-icon><?php echo T_("Filter by permission"); ?></h6>
    <div class="showFilterBypermission" <?php if(!\dash\request::get('permission')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFilterpermission(); ?>
    </div>

    <h6 data-kerkere=".showFilterBylanguage" data-kerkere-icon><?php echo T_("Filter by language"); ?></h6>
    <div class="showFilterBylanguage" <?php if(!\dash\request::get('language')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFilterlanguage(); ?>
    </div>

    <?php if(\dash\permission::supervisor()) {?>

    <h6 data-kerkere=".showFilterByduplicate" data-kerkere-icon><?php echo T_("Filter by duplicate"); ?></h6>
    <div class="showFilterByduplicate" <?php if(!\dash\request::get('duplicate')) { echo "data-kerkere-content='hide'";} ?>>
      <?php iFilterduplicate(); ?>
    </div>
    <?php } ?>



    <div class="mT10">
      <a href="<?php echo \dash\url::this(); ?>" class="btn "><?php echo T_("Clear filter"); ?></a>
      <button class="btn primary"><?php echo T_("Apply"); ?></button>
    </div>

</div>

<?php } //endfunction ?>

<?php function iFilterduplicate() {?>
  <?php if(\dash\permission::supervisor()) {?>

<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="duplicate" value="mobile" id="duplicateyes" <?php if(\dash\request::get('duplicate') == 'mobile'  ){?> checked <?php } ?>>
      <label for="duplicateyes"><?php echo T_("Have duplicate mobile"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="duplicate" value="email" id="duplicateno" <?php if(\dash\request::get('duplicate') == 'email' ){?> checked <?php } ?>>
      <label for="duplicateno"><?php echo T_("Have duplicate email"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="duplicate" value="username" id="duplicateusername" <?php if(\dash\request::get('duplicate') == 'username' ){?> checked <?php } ?>>
      <label for="duplicateusername"><?php echo T_("Have duplicate username"); ?></label>
    </div>
  </div>

</div>
<?php } //endif ?>
<?php } //endfunction ?>


<?php function iFilterandroid() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="android_uniquecode" value="yes" id="android_uniquecodeyes" <?php if(\dash\request::get('android_uniquecode') == 'yes'  ){?> checked <?php } ?>>
      <label for="android_uniquecodeyes"><?php echo T_("Have android_uniquecode"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="android_uniquecode" value="non" id="android_uniquecodenon" <?php if(\dash\request::get('android_uniquecode') == 'non'  ){?> checked <?php } ?>>
      <label for="android_uniquecodenon"><?php echo T_("Non"); ?></label>
    </div>
  </div>

</div>
<?php } //endfunction ?>

<?php function iFilterlanguage() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="language" value="yes" id="languageyes" <?php if(\dash\request::get('language') == 'yes'  ){?> checked <?php } ?>>
      <label for="languageyes"><?php echo T_("Have language"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="language" value="no" id="languageno" <?php if(\dash\request::get('language') == 'no' ){?> checked <?php } ?>>
      <label for="languageno"><?php echo T_("Have not language"); ?></label>
    </div>
  </div>

    <div class="c">
    <div class="radio3">
      <input type="radio" name="language" value="non" id="languagenon" <?php if(\dash\request::get('language') == 'non'  ){?> checked <?php } ?>>
      <label for="languagenon"><?php echo T_("Non"); ?></label>
    </div>
  </div>
</div>
<?php } //endfunction ?>


<?php function iFilterchatid() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="chatid" value="yes" id="chatidyes" <?php if(\dash\request::get('chatid') == 'yes'  ){?> checked <?php } ?>>
      <label for="chatidyes"><?php echo T_("Have chatid"); ?></label>
    </div>
  </div>


    <div class="c">
    <div class="radio3">
      <input type="radio" name="chatid" value="non" id="chatidnon" <?php if(\dash\request::get('chatid') == 'non'  ){?> checked <?php } ?>>
      <label for="chatidnon"><?php echo T_("Non"); ?></label>
    </div>
  </div>
</div>
<?php } //endfunction ?>


<?php function iFilterpermission() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="permission" value="yes" id="permissionyes" <?php if(\dash\request::get('permission') == 'yes'  ){?> checked <?php } ?>>
      <label for="permissionyes"><?php echo T_("Have permission"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="permission" value="no" id="permissionno" <?php if(\dash\request::get('permission') == 'no' ){?> checked <?php } ?>>
      <label for="permissionno"><?php echo T_("Have not permission"); ?></label>
    </div>
  </div>

    <div class="c">
    <div class="radio3">
      <input type="radio" name="permission" value="non" id="permissionnon" <?php if(\dash\request::get('permission') == 'non'  ){?> checked <?php } ?>>
      <label for="permissionnon"><?php echo T_("Non"); ?></label>
    </div>
  </div>
</div>
<?php } //endfunction ?>


<?php function iFiltertwostep() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="twostep" value="yes" id="twostepyes" <?php if(\dash\request::get('twostep') == 'yes'  ){?> checked <?php } ?>>
      <label for="twostepyes"><?php echo T_("Have twostep"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="twostep" value="no" id="twostepno" <?php if(\dash\request::get('twostep') == 'no' ){?> checked <?php } ?>>
      <label for="twostepno"><?php echo T_("Have not twostep"); ?></label>
    </div>
  </div>

    <div class="c">
    <div class="radio3">
      <input type="radio" name="twostep" value="non" id="twostepnon" <?php if(\dash\request::get('twostep') == 'non'  ){?> checked <?php } ?>>
      <label for="twostepnon"><?php echo T_("Non"); ?></label>
    </div>
  </div>
</div>
<?php } //endfunction ?>



<?php function iFilterpassword() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="password" value="yes" id="passwordyes" <?php if(\dash\request::get('password') == 'yes'  ){?> checked <?php } ?>>
      <label for="passwordyes"><?php echo T_("Have password"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="password" value="no" id="passwordno" <?php if(\dash\request::get('password') == 'no' ){?> checked <?php } ?>>
      <label for="passwordno"><?php echo T_("Have not password"); ?></label>
    </div>
  </div>

    <div class="c">
    <div class="radio3">
      <input type="radio" name="password" value="non" id="passwordnon" <?php if(\dash\request::get('password') == 'non'  ){?> checked <?php } ?>>
      <label for="passwordnon"><?php echo T_("Non"); ?></label>
    </div>
  </div>
</div>
<?php } //endfunction ?>



<?php function iFilteremail() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="email" value="yes" id="emailyes" <?php if(\dash\request::get('email') == 'yes'  ){?> checked <?php } ?>>
      <label for="emailyes"><?php echo T_("Have email"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="email" value="no" id="emailno" <?php if(\dash\request::get('email') == 'no' ){?> checked <?php } ?>>
      <label for="emailno"><?php echo T_("Have not email"); ?></label>
    </div>
  </div>

    <div class="c">
    <div class="radio3">
      <input type="radio" name="email" value="non" id="emailnon" <?php if(\dash\request::get('email') == 'non'  ){?> checked <?php } ?>>
      <label for="emailnon"><?php echo T_("Non"); ?></label>
    </div>
  </div>
</div>
<?php } //endfunction ?>



<?php function iFiltermobile() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="mobile" value="yes" id="mobileyes" <?php if(\dash\request::get('mobile') == 'yes'  ){?> checked <?php } ?>>
      <label for="mobileyes"><?php echo T_("Have mobile"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="mobile" value="no" id="mobileno" <?php if(\dash\request::get('mobile') == 'no' ){?> checked <?php } ?>>
      <label for="mobileno"><?php echo T_("Have not mobile"); ?></label>
    </div>
  </div>

    <div class="c">
    <div class="radio3">
      <input type="radio" name="mobile" value="non" id="mobilenon" <?php if(\dash\request::get('mobile') == 'non'  ){?> checked <?php } ?>>
      <label for="mobilenon"><?php echo T_("Non"); ?></label>
    </div>
  </div>
</div>
<?php } //endfunction ?>


<?php function iFilterdisplayname() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="displayname" value="yes" id="displaynameyes" <?php if(\dash\request::get('displayname') == 'yes'  ){?> checked <?php } ?>>
      <label for="displaynameyes"><?php echo T_("Have displayname"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="displayname" value="no" id="displaynameno" <?php if(\dash\request::get('displayname') == 'no' ){?> checked <?php } ?>>
      <label for="displaynameno"><?php echo T_("Have not displayname"); ?></label>
    </div>
  </div>

    <div class="c">
    <div class="radio3">
      <input type="radio" name="displayname" value="non" id="displaynamenon" <?php if(\dash\request::get('displayname') == 'non'  ){?> checked <?php } ?>>
      <label for="displaynamenon"><?php echo T_("Non"); ?></label>
    </div>
  </div>
</div>
<?php } //endfunction ?>


<?php function iFilteravatar() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="avatar" value="yes" id="avataryes" <?php if(\dash\request::get('avatar') == 'yes'  ){?> checked <?php } ?>>
      <label for="avataryes"><?php echo T_("Have avatar"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="avatar" value="no" id="avatarno" <?php if(\dash\request::get('avatar') == 'no' ){?> checked <?php } ?>>
      <label for="avatarno"><?php echo T_("Have not avatar"); ?></label>
    </div>
  </div>

    <div class="c">
    <div class="radio3">
      <input type="radio" name="avatar" value="non" id="avatarnon" <?php if(\dash\request::get('avatar') == 'non'  ){?> checked <?php } ?>>
      <label for="avatarnon"><?php echo T_("Non"); ?></label>
    </div>
  </div>
</div>
<?php } //endfunction ?>




<?php function iFilterUsername() {?>
<div class="f">
  <div class="c">
    <div class="radio3">
      <input type="radio" name="username" value="yes" id="usernameyes" <?php if(\dash\request::get('username') == 'yes'  ){?> checked <?php } ?>>
      <label for="usernameyes"><?php echo T_("Have username"); ?></label>
    </div>
  </div>

  <div class="c">
    <div class="radio3">
      <input type="radio" name="username" value="no" id="usernameno" <?php if(\dash\request::get('username') == 'no' ){?> checked <?php } ?>>
      <label for="usernameno"><?php echo T_("Have not username"); ?></label>
    </div>
  </div>

    <div class="c">
    <div class="radio3">
      <input type="radio" name="username" value="non" id="usernamenon" <?php if(\dash\request::get('username') == 'non'  ){?> checked <?php } ?>>
      <label for="usernamenon"><?php echo T_("Non"); ?></label>
    </div>
  </div>
</div>
<?php } //endfunction ?>














<?php function pageStepsList() {?>


  <div class="f">

   <div class="c s6">
    <a class="dcard <?php if(\dash\request::get('status') == 'active' || !\dash\request::get('status')) {echo 'active';}  ?>" href='<?php echo \dash\url::this(); ?>?status=active' data-shortkey="49ctrlshift">
     <div class="statistic green">
      <div class="value"><i class="sf-user"></i></div>
      <div class="label"><?php echo T_("Active"); ?> <kbd class=" hide mT5">Shift+1</kbd></div>
     </div>
    </a>
   </div>


   <div class="c s6">
    <a class="dcard  <?php if(\dash\request::get('status') == 'awaiting') {echo 'active';}  ?>" href='<?php echo \dash\url::this(); ?>?status=awaiting' data-shortkey="50ctrlshift">
     <div class="statistic blue">
      <div class="value"><i class="sf-person-stalker"></i></div>
      <div class="label"><?php echo T_("Awaiting"); ?> <kbd class=" hide mT5">Shift+1</kbd></div>
     </div>
    </a>
   </div>


    <div class="c s6">
      <a class="dcard  <?php if(\dash\request::get('status') == 'deactive') {echo 'active';}  ?>" href='<?php echo \dash\url::this(); ?>?status=deactive' data-shortkey="51ctrlshift">
       <div class="statistic">
        <div class="value"><i class="sf-user-close-security"></i></div>
        <div class="label"><?php echo T_("Deactive"); ?> <kbd class=" hide mT5">Shift+1</kbd></div>
       </div>
      </a>
    </div>

    <div class="c s6">
      <a class="dcard  <?php if(\dash\request::get('status') == 'removed') {echo 'active';}  ?>" href='<?php echo \dash\url::this(); ?>?status=removed' data-shortkey="52ctrlshift">
       <div class="statistic">
        <div class="value"><i class="sf-trash-can"></i></div>
        <div class="label"><?php echo T_("Removed"); ?> <kbd class=" hide mT5">Shift+1</kbd></div>
       </div>
      </a>
    </div>


    <div class="c s6">
      <a class="dcard  <?php if(\dash\request::get('status') == 'filter') {echo 'active';}  ?>" href='<?php echo \dash\url::this(); ?>?status=filter' data-shortkey="53ctrlshift">
       <div class="statistic">
        <div class="value"><i class="sf-group-full-security"></i></div>
        <div class="label"><?php echo T_("Filter"); ?> <kbd class=" hide mT5">Shift+1</kbd></div>
       </div>
      </a>
    </div>


     <div class="c s6">
      <a class="dcard  <?php if(\dash\request::get('status') == 'unreachable') {echo 'active';}  ?>" href='<?php echo \dash\url::this(); ?>?status=unreachable' data-shortkey="54ctrlshift">
       <div class="statistic">
        <div class="value"><i class="sf-exclamation-circle"></i></div>
        <div class="label"><?php echo T_("Unreachable"); ?> <kbd class=" hide mT5">Shift+1</kbd></div>
       </div>
      </a>
    </div>


     <div class="c s6">
      <a class="dcard  <?php if(\dash\request::get('status') == 'all') {echo 'active';}  ?>" href='<?php echo \dash\url::this(); ?>?status=all' data-shortkey="54ctrlshift">
       <div class="statistic">
        <div class="value"><i class="sf-group-full"></i></div>
        <div class="label"><?php echo T_("All"); ?> <kbd class=" hide mT5">Shift+1</kbd></div>
       </div>
      </a>
    </div>




  </div>
<?php } //endfunction ?>