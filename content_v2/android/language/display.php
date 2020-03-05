
<style>
 body{background-color: #f9e7e0;}
 #android_chooseLang.cn{width:82%!important;max-width: 400px!important;min-width: 260px!important;}
 #android_chooseLang header{padding: 20vh 0 30px;}
 #android_chooseLang h1 {font-weight: 900;color:#000;font-size:20px;}
 #android_chooseLang h2 {font-weight: 300;color:#999;font-size:20px;}
 #android_chooseLang .langItem {background-color:#fff;border:3px solid transparent;padding:12px;border-radius:1rem;display:block;overflow: hidden;transition: 0.3s}
 #android_chooseLang .langItem:hover {background-color:#f7f7f7;}
 #android_chooseLang .langItem:focus {background-color:#f1f1f1;}
 #android_chooseLang .langItem:active {background-color:#efefef;}
 #android_chooseLang .langItem.device{border-color:#82b984 }
 #android_chooseLang .langItem p{font-weight:700;color: #444;font-size: 16px;}
 #android_chooseLang .langItem p.hello{margin-bottom:5px;line-height: 30px;}
 #android_chooseLang .langItem p.iam{margin-bottom:10px;line-height: 25px;height:50px;font-size:15px;}
 #android_chooseLang .langItem .lang{color:#f7ab8d;font-size:14px;line-height: 20px;}
</style>

<div class="cn" id="android_chooseLang">
 <header>
  <h1><?php echo T_('Choose'); ?></h1>
  <h2><?php echo T_('your language'); ?></h2>
 </header>

 <div class="f">
  <div class="c6 pRa5">
   <a href="jibres://language/en" class="ltr langItem<?php if(\dash\request::get('device') === 'en') echo ' device'; ?>">
    <p class="hello">Hello!</p>
    <p  class="iam">I'm Jibres</p>
    <div class="lang">English</div>
   </a>
  </div>

  <div class="c6 pLa5">
   <a href="jibres://language/fa" class="rtl langItem<?php if(\dash\request::get('device') === 'fa') echo ' device'; ?>">
    <p class="hello">سلام!</p>
    <p class="iam">من جیبرس هستم</p>
    <div class="lang">فارسی</div>
   </a>
  </div>
 </div>
</div>
