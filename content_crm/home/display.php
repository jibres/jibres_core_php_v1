

<div class="f mB5">
  <div class="c s6">


    <a class="dcard" href="<?php echo \dash\url::here(); ?>/member?status=all">
     <div class="statistic sm">
      <div class="label mB10"><i class="fs20 mRa5 sf-group-full"></i> <?php echo T_("Total Users"); ?></div>
      <div class="value counter" data-value=<?php echo \dash\data::dashboardDetail_users(); ?>><?php echo \dash\fit::number(\dash\data::dashboardDetail_users()); ?></div>
     </div>
    </a>


  </div>
  <div class="c s6">


    <a class="dcard" href="<?php echo \dash\url::here(); ?>/member">
     <div class="statistic sm green">
      <div class="label mB10"><i class="fs20 mRa5 sf-user-5"></i> <?php echo T_("Active Users"); ?></div>
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_activeUser()); ?></div>
     </div>
    </a>


  </div>
  <div class="c s6">


    <a class="dcard" href="<?php echo \dash\url::here(); ?>/permission">
     <div class="statistic sm red">
      <div class="label mB10"><i class="fs20 mRa5 sf-lock"></i> <?php echo T_("Permissions"); ?></div>
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_permissions()); ?></div>
     </div>
    </a>


  </div>
  <div class="c s6">


    <a class="dcard" href="<?php echo \dash\url::here(); ?>/log">
     <div class="statistic sm">
      <div class="label mB10"><i class="fs20 mRa5 sf-crosshairs"></i> <?php echo T_("Logs"); ?></div>
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_logs()); ?></div>
     </div>
    </a>


  </div>
</div>



  <div class="f hide">
    <div class="c6 s12 mB10 pRa5">
      <div class="chart x3" id="statuschart"></div>
    </div>
    <div class="c6 s12 mB10 pLa5">
      <div class="chart x3" id="genderchart"></div>
    </div>
  </div>

  <div class="chart x2 mB10 hide" id="UsersChart"></div>
  <div class="chart x2 mB10 hide" id="logChart"></div>


  <div class="f align-center">
    <div class="c s12 pRa10">



      <div class="cbox fs11 mB10">
        <h2><?php echo T_("Latest Members"); ?></h2>
        <?php foreach (\dash\data::dashboardDetail_latestMember() as $key => $value) {?>

          <a class="msg f" href="<?php echo \dash\url::here(); ?>/member/glance?id=<?php echo $value['id']; ?>">
            <div><?php if(isset($value['displayname']) && $value['displayname']) { echo $value['displayname']; }else{ echo T_("Unknown");} ?></div>
            <div class="cauto"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
          </a>

        <?php }//endfor ?>

      </div>


    </div>
    <div class="c s12 pRa10 hide">
      <div class="chart mB10" id="userGuage" style="max-width:300px;margin:0 auto 10px"></div>
    </div>
    <div class="c s12">

      <?php if(\dash\data::dashboardDetail_latestLogs()) {?>
      <div class="cbox fs11">
        <h2><?php echo T_("Latest logs"); ?></h2>


          <?php foreach (\dash\data::dashboardDetail_latestLogs() as $key => $value) {?>

          <a class="msg f" href="<?php echo \dash\url::this(); ?>/log">
            <div><?php if(isset($value['displayname']) && $value['displayname']) { echo $value['displayname']; }else{ echo T_("Unknown");} ?></div>
            <div><?php if(isset($value['title']) && $value['title']) { echo $value['title']; }else{ echo \dash\get::index($value, 'caller');} ?></div>
            <div class="cauto"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
          </a>

        <?php }//endfor ?>

      </div>
    <?php } //endif ?>


    </div>
  </div>

  <div class="chart x3 mB10 hide" id="identifyChart"></div>











