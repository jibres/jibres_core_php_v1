<div class="jibresBanner">
 <div class="fit zero love">
 	<img class="block" src="<?php echo \dash\url::cdn(); ?>/img/bg/jibres-bug-1.jpg" alt='<?php echo \dash\face::title();?>'>
 </div>


 <div class="fit">
 		<h2><?php echo T_("Vulnerability Disclosure Philosophy"); ?></h2>
 		<ul class="list">
 			<li><?php echo "<b>Respect privacy.</b> Make a good faith effort not to access or destroy another users data."; ?></li>
 			<li><?php echo "<b>Be patient.</b> Make a good faith effort to clarify and support their reports upon request."; ?></li>
 			<li><?php echo "<b>Do no harm.</b> Act for the common good through the prompt reporting of all found vulnerabilities. Never willfully exploit others without their permission."; ?></li>
 		</ul>
 </div>

<div class="fit">
	<p><?php echo "A software bug that would allow an attacker to perform an action in violation of an expressed security policy. A bug that enables escalated access or privilege is a vulnerability. Design flaws and failures to adhere to security best practices may qualify as vulnerabilities. Weaknesses exploited by viruses, malicious code, and social engineering are not considered vulnerabilities"; ?></p>

	<p class="mB0"><?php echo T_("If you believe you have found a vulnerability, please submit a Report here. The Report should include a detailed description of your discovery with clear, concise reproducible steps or a working proof-of-concept. If you don't explain the vulnerability in detail, there may be significant delays in the disclosure process, which is undesirable for everyone. We are use CVSS v.3 calculator on Jibres."); ?> <a href="https://www.first.org/cvss/calculator/3.0"><?php echo T_("Learn more about CVSS v3 rating"); ?></a></p>
</div>

<div class="fit">
	<h3><?php echo T_("Before you start"); ?></h3>
	<ul class="list">
		<li><?php echo T_("Never attempt non-technical attacks such as social engineering, phishing, or physical attacks against our employees, users, or infrastructure!"); ?></li>
		<li><?php echo T_("When in doubt, contact us at info [at] jibres.com."); ?></li>
		<li><?php echo T_("By participating in Jibres Bug program, you acknowledge that you have read and agree to Jibres Terms of Service."); ?></li>
		<li><?php echo T_("Your participation in the Program will not violate any law applicable to you, or disrupt or compromise any data that is not your own."); ?></li>
		<li><?php echo T_("Only test for vulnerabilities on sites you know to be operated by Jibres and are in-scope. Some sites hosted on subdomains of Jibres.com are operated by third parties and should not be tested."); ?></li>
		<li><?php echo T_("Jibres reserves the right to terminate or discontinue the Program at its discretion."); ?></li>
		<li><?php echo T_("Do not publicly disclose your submission until Jibres has evaluated the impact."); ?></li>
	</ul>
</div>

<div class="fit">
	<h3><?php echo T_("Performing your research"); ?></h3>
	<p><?php echo T_("Do not impact other users with your testing. If you are attempting to find an authorization bypass, you must use accounts you own."); ?></p>
	<p><?php echo T_("The following are <b>never</b> allowed and are ineligible for reward. We may suspend your Jibres account and ban your IP address for"); ?></p>

	<ul class="list mB50-f">
		<li><?php echo T_("Performing distributed denial of service (DDoS) or other volumetric attacks."); ?></li>
		<li><?php echo T_("Spamming content"); ?></li>
		<li><?php echo T_("Large-scale vulnerability scanners, scrapers, or automated tools which produce excessive amounts of traffic."); ?></li>
		<li><?php echo T_("Note: We do allow the use of automated tools so long as they do not produce excessive amounts of traffic. For example, running one <code>nmap</code> scan against one host is allowed, but sending 10,000 requests in a minutes using Burp Suite Intruder is excessive."); ?></li>
	</ul>

	<p><?php echo T_("Researching denial-of-service attacks is allowed and eligible for rewards only if you follow these rules"); ?></p>
	<ul class="list">
		<li><?php echo T_("Research <b>must</b> be performed in you own account."); ?></li>
		<li><?php echo T_("Stop <b>immediately</b> if you believe you have affected the availability of our services. Don't worry about demonstrating the full impact of your vulnerability, Jibres security team will be able to determine the impact."); ?></li>
	</ul>
</div>

<div class="fit">
	<h2><?php echo T_("Severity Guidelines"); ?></h2>
	<p><?php echo T_("All bounty submissions are rated by Jibres using a purposefully simple scale. Each vulnerability is unique but the following is a rough guideline we use internally for rating and rewarding submissions."); ?></p>

	<div class="txtB"><?php echo T_("Critical"); ?></div>
	<p><?php echo T_("Critical severity issues present a direct and immediate risk to a broad array of our users or to Jibres itself. They often affect relatively low-level/foundational components in one of our application stacks or infrastructure."); ?></p>

	<div class="txtB"><?php echo T_("High"); ?></div>
	<p><?php echo T_("High severity issues allow an attacker to read or modify highly sensitive data that they are not authorized to access. They are generally more narrow in scope than critical issues, though they may still grant an attacker extensive access."); ?></p>

	<div class="txtB"><?php echo T_("Medium"); ?></div>
	<p><?php echo T_("Medium severity issues allow an attacker to read or modify limited amounts of data that they are not authorized to access. They generally grant access to less sensitive information than high severity issues."); ?></p>

	<div class="txtB"><?php echo T_("Low"); ?></div>
	<p class="mB0"><?php echo T_("Low severity issues allow an attacker to access extremely limited amounts of data. They may violate an expectation for how something is intended to work, but it allows nearly no escalation of privilege or ability to trigger unintended behavior by an attacker."); ?></p>
</div>



 <div class="fit">
 		<h2><?php echo T_("Submit Vulnerability Report"); ?></h2>
 		<p class="mB25"><?php echo T_("All technology contains bugs. If you've found a security vulnerability, we'd like to help out. By submitting a vulnerability to a program on Jibres. The proof of concept is the most important part of your report submission. Clear, reproducible steps will help us validate this issue as quickly as possible.") ?></p>


     <form method="post" data-clear autocomplete="off">
<?php \dash\utility\hive::html(); ?>

      <label for="iu1"><?php echo T_("Your nick name"); ?></label>
      <div class="input">
       <input type="text" name="iu1" id="iu1" placeholder='<?php echo T_("Whatever you want"); ?>' maxlength='40'>
      </div>

      <label for="mobile"><?php echo T_("Your mobile number"); ?></label>
      <div class="input">
       <input type="tel" name="mobile" id="mobile" placeholder='' maxlength="17" autocomplete="off">
      </div>

      <label for="email"><?php echo T_("Your Email address"); ?></label>
      <div class="input">
       <input type="email" name="email" id="email" placeholder='' maxlength='40'>
      </div>

      <label for="title"><?php echo T_("Bug Title"); ?> *</label>
      <div class="input">
       <input type="text" name="title" id="title" placeholder='<?php echo T_("A clear and concise title includes the type of vulnerability and the impacted asset."); ?>' maxlength='40'>
      </div>

      <div>
       <label for="content"><?php echo T_("Description"); ?> *</label>
       <textarea class="txt" name="content" id="contenct" placeholder='<?php echo T_("What is the vulnerability? In clear steps, how do you reproduce it?"); ?>' rows="10" minlength="5" maxlength="1000" data-resizable></textarea>
      </div>

      <button type="submit" name="submit-contact" class="btn block success mT25"><?php echo T_("Send"); ?></button>
     </form>



 </div>

</div>
<canvas id="matrix"></canvas>
<script src='<?php echo \dash\url::cdn(); ?>/js/page/matrix.js'></script>