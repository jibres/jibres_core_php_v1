<?php
class twigTransTerms
{
 private function transtext()
 {

	//-----------------------------------------------------------content_i/layout.html
	echo T_("Manage");                                                                // Line 592

	//--------------------------------------------------content_i/category/layout.html
	echo T_("Parent");                                                                // Line 101
	echo T_("Without parent");                                                        // Line 103
	echo T_("Title");                                                                 // Line 91
	echo T_("Please select one itme");                                                // Line 350
	echo T_("Use in incoming record?");                                               // Line 40
	echo T_("Add");                                                                   // Line 48
	echo T_("Save");                                                                  // Line 39

	//--------------------------------------------content_i/category/home/display.html
	echo T_("Search");                                                                // Line 105
	echo T_("Use in incoming");                                                       // Line 59
	echo T_("Status");                                                                // Line 71
	echo T_("Date created");                                                          // Line 65
	echo T_("Edit on");                                                               // Line 98
	echo T_("Clear filters");                                                         // Line 231
	echo T_("Result not found!");                                                     // Line 230
	echo T_("Search with new keywords.");                                             // Line 230
	echo T_("Hi!");                                                                   // Line 237

	//-------------------------------------------------------content_i/jib/layout.html
	echo T_("Description");                                                           // Line 564
	echo T_("bank");                                                                  // Line 6
	echo T_("Is default?");                                                           // Line 45

	//-------------------------------------------------content_i/jib/home/display.html
	echo T_("Bank");                                                                  // Line 103
	echo T_("Default jib");                                                           // Line 70

	//------------------------------------------------------content_i/bank/layout.html
	echo T_("Country");                                                               // Line 138
	echo T_("Choose your country");                                                   // Line 142
	echo T_("Please choose bank");                                                    // Line 32
	echo T_("Account number");                                                        // Line 79
	echo T_("Shaba");                                                                 // Line 80
	echo T_("Card");                                                                  // Line 86
	echo T_("Branch");                                                                // Line 62
	echo T_("Branch code");                                                           // Line 88
	echo T_("Owner");                                                                 // Line 108
	echo T_("IBAN");                                                                  // Line 84
	echo T_("SWIFT");                                                                 // Line 115
	echo T_("Name on card");                                                          // Line 60
	echo T_("Expire");                                                                // Line 78
	echo T_("CVV2");                                                                  // Line 83
	echo T_("subtitle");                                                              // Line 162
	echo T_("Non");                                                                   // Line 177
	echo T_("cat");                                                                   // Line 174

	//------------------------------------------------content_i/bank/home/display.html
	echo T_("Detail");                                                                // Line 491
	echo T_("Swift");                                                                 // Line 85

	//------------------------------------------------content_i/chequebook/layout.html
	echo T_("First serial");                                                          // Line 61
	echo T_("Page count");                                                            // Line 63
	echo T_("Cheque number");                                                         // Line 95

	//------------------------------------------content_i/chequebook/home/display.html
	echo T_("Number");                                                                // Line 62
	echo T_("Datetime");                                                              // Line 64

	//----------------------------------------------------content_i/cheque/layout.html
	echo T_("Cheque book");                                                           // Line 27
	echo T_("Get date");                                                              // Line 44
	echo T_("Date of cheque");                                                        // Line 54
	echo T_("Vajh");                                                                  // Line 70
	echo T_("Babat");                                                                 // Line 87
	echo T_("Thirdparty");                                                            // Line 63
	echo T_("Amount");                                                                // Line 87
	echo T_("Type");                                                                  // Line 125
	echo T_("In");                                                                    // Line 124
	echo T_("Out");                                                                   // Line 128

	//----------------------------------------------content_i/cheque/home/display.html
	echo T_("Date");                                                                  // Line 522
	echo T_("branch");                                                                // Line 62
	echo T_("vajh");                                                                  // Line 63
	echo T_("owner");                                                                 // Line 64
	echo T_("babat");                                                                 // Line 65
	echo T_("thirdparty");                                                            // Line 66
	echo T_("amount");                                                                // Line 67
	echo T_("number");                                                                // Line 68
	echo T_("type");                                                                  // Line 69
	echo T_("getdate");                                                               // Line 70

	//-----------------------------------------------------content_i/inout/layout.html
	echo T_("Price ");                                                                // Line 12
	echo T_("Is plus?");                                                              // Line 25
	echo T_("Time");                                                                  // Line 528
	echo T_("Jib");                                                                   // Line 71
	echo T_("Please choose one item");                                                // Line 73
	echo T_("Category");                                                              // Line 105
	echo T_("Add new category");                                                      // Line 22
	echo T_("Discount");                                                              // Line 61

	//-----------------------------------------------content_i/inout/home/display.html
	echo T_("Plus");                                                                  // Line 81
	echo T_("Minus");                                                                 // Line 82

	//-----------------------------------------------------content_i/home/display.html
	echo T_("Cheque");                                                                // Line 397
	echo T_("In out");                                                                // Line 82

	//-----------------------------------------------------------content_c/layout.html
	echo T_("Dashboard");                                                             // Line 7
	echo T_("My Stores");                                                             // Line 8
	echo T_("Add new store");                                                         // Line 31
	echo T_("Billing");                                                               // Line 441

	//----------------------------------------------------content_c/store/display.html
	echo T_("Code");                                                                  // Line 84
	echo T_("Store title");                                                           // Line 45
	echo T_("Plan");                                                                  // Line 75
	echo T_("Start Plan");                                                            // Line 17
	echo T_("End Plan");                                                              // Line 18
	echo T_("Day left");                                                              // Line 19
	echo T_("Product");                                                               // Line 58
	echo T_("Third Party");                                                           // Line 22
	echo T_("Factor");                                                                // Line 510
	echo T_("Created on");                                                            // Line 25
	echo T_("Last modify");                                                           // Line 26
	echo T_("Creator");                                                               // Line 27

	//------------------------------------------------content_c/store/add/display.html
	echo T_("You are reach your store limit!");                                       // Line 10
	echo T_("If you want to add a new store, you must say to us via ticket, then we check and increase your max store limit.");// Line 11
	echo T_("Submit a ticket");                                                       // Line 14
	echo T_("Easily set up your store");                                              // Line 21
	echo T_("Try Jibres free for 14 days.");                                          // Line 22
	echo T_("Then if you want, pick a plan!");                                        // Line 22
	echo T_("subdomain select");                                                      // Line 29
	echo T_("Create my store now");                                                   // Line 33
	echo T_("Your store title");                                                      // Line 47
	echo T_("This is your store full name used for title");                           // Line 47
	echo T_("Store short name");                                                      // Line 53
	echo T_("Used for url of store as subdomain");                                    // Line 53
	echo T_("Free subdomain address for your store");                                 // Line 55
	echo T_("Set it carefully, you can not change it later");                         // Line 55

	//-----------------------------------------------------content_c/home/display.html
	echo T_("Your Stores");                                                           // Line 19
	echo T_("List of all stores");                                                    // Line 21
	echo T_("Add store as free trial");                                               // Line 34
	echo T_("You have not created your own store yet!");                              // Line 37
	echo T_("Try Jibres free trial for 14 days");                                     // Line 37
	echo T_("As supplier");                                                           // Line 50
	echo T_("You are sell to this stores");                                           // Line 50
	echo T_("Store");                                                                 // Line 152
	echo T_("Sell count");                                                            // Line 56
	echo T_("Total sell price");                                                      // Line 57
	echo T_("Average sell price");                                                    // Line 58
	echo T_("You are not sell something to any stores yet!");                         // Line 73
	echo T_("Start from");                                                            // Line 92
	echo T_("Current plan");                                                          // Line 93
	echo T_("days left");                                                             // Line 56
	echo T_("Expired");                                                               // Line 59
	echo T_("Staff");                                                                 // Line 414
	echo T_("As customer");                                                           // Line 147
	echo T_("You are buy from this stores");                                          // Line 147
	echo T_("Buy count");                                                             // Line 153
	echo T_("Total buy price");                                                       // Line 154
	echo T_("Average buy price");                                                     // Line 155
	echo T_("You are not buy something from stores yet!");                            // Line 170

	//---------------------public_html/static/siftal/fonts/siftal/icons-reference.html

	//--------------------------------------public_html/static/siftal/js/siftal.min.js

	//-----------------------public_html/static/siftal/js/highcharts/highcharts.min.js

	//-----------------------------------public_html/static/siftal/js/highlight.min.js

	//--------------------------------------public_html/static/siftal/js/error_page.js

	//------------------------------------------public_html/static/js/particles.min.js

	//------------------public_html/static/js/gulp/src/storePanel/JsBarcode.all.min.js

	//-----------------------------------public_html/static/js/gulp/dist/storePanel.js

	//----------------------public_html/static/js/gulp/dist/storePanel.uncompressed.js

	//-------------------------------------------------public_html/static/js/script.js

	//---------------------------------------------public_html/static/js/storePanel.js

	//---------------------------------------------------content/benefits/display.html
	echo T_("Soon");                                                                  // Line 262

	//----------------------------------------------------content/template/footer.html
	echo T_("Home");                                                                  // Line 5
	echo T_("About");                                                                 // Line 6
	echo T_("Press and Media");                                                       // Line 7
	echo T_("Careers");                                                               // Line 8
	echo T_("Social Responsibility");                                                 // Line 25
	echo T_("FAQ");                                                                   // Line 31
	echo T_("Jibres");                                                                // Line 15
	echo T_("Benefits");                                                              // Line 16
	echo T_("Pricing");                                                               // Line 12
	echo T_("Changelog");                                                             // Line 18
	echo T_("Learn More");                                                            // Line 22
	echo T_("Terms of Service");                                                      // Line 23
	echo T_("Privacy Policy");                                                        // Line 24
	echo T_("Support");                                                               // Line 29
	echo T_("Contact");                                                               // Line 13
	echo T_("Logo");                                                                  // Line 32
	echo T_("Enamad");                                                                // Line 53
	echo T_("Samandehi");                                                             // Line 55
	echo T_("Proudly Made in IRAN");                                                  // Line 60

	//---------------------------------------------------content/template/dafault.html
	echo T_("View your current location and navigate to parent of it");               // Line 9
	echo T_("Some right reserved!");                                                  // Line 28

	//----------------------------------------------------content/template/header.html
	echo T_("Beta");                                                                  // Line 7
	echo T_("Store Panel");                                                           // Line 28
	echo T_("Admin Panel");                                                           // Line 18
	echo T_("Enter");                                                                 // Line 30

	//--------------------------------------------------------content/main/layout.html
	echo T_("Next →");                                                                // Line 33
	echo T_("← Back");                                                                // Line 33
	echo T_("Skip");                                                                  // Line 33
	echo T_("Done");                                                                  // Line 33

	//-------------------------------------------------content/enterprise/display.html
	echo T_("Big companies simply don’t work like small companies, and they don’t use Jibres the same way either. That’s why there’s Enterprise.");// Line 6

	//---------------------------------------content/socialresponsibility/display.html
	echo T_("Social responsibility refers to our role in maintaining, caring about and helping our society, while having set as its goal a responsibility-centered enterprise along with wealth production.");// Line 6
	echo T_("The issue of the social responsibility of organizations and corporations towards the society is from among the important issues being focused on in recent years.");// Line 8
	echo T_("The social responsibility of organizations relates to the organization's responsibility towards society, human beings and the environment in which they are active.");// Line 8
	echo T_("Based on the mentioned definitions of social responsibility, Jibres considers itself committed to society. Accordingly, besides attempting to offer creative and effective services, Jibres has invariably had social responsibility as one of its most important missions and, God willing, will continue to do so.");// Line 10
	echo T_("Environmentalist");                                                      // Line 12
	echo T_("In spite of technological advancements, paper usage is unfortunately preferred to modern ways. One of Jibres's objectives is trying to change this habit and contribute to the elimination of paper from the routine life and, therefore, to save the environment.");// Line 13
	echo T_("Philanthropist Activities");                                             // Line 15
	echo T_("One of the most valuable resources of charity organizations is the voluntary and active participation of the individuals who, without any expectations, provide them with their skillfulness and capital.");// Line 16
	echo T_("Jibres as well, with regard to its contribution to philanthropist activities, will honorably provide them with its services free of charge. To make use of these services, send your identity documents along with your request to Jibres's support center.");// Line 17
	echo T_("Recruiting Motivated Staff");                                            // Line 19
	echo T_("An outstanding characteristic of any organization is its specialized and highly motivated staff, playing a vital role in growth and development.");// Line 20
	echo T_("By the same token, we are always looking for creative and motivated Iranian youths in order to make the best and be effective in cooperation with them.");// Line 20
	echo T_("Join us and grow in a different location.");                             // Line 20
	echo T_("Customer Care and Complete Satisfaction");                               // Line 23
	echo T_("Attracting people's participation as well as having their valuable presence has always been a great honor for Jibres and to appreciate your support, in return, Jibres presents services to promote customer satisfaction.");// Line 24
	echo T_("These services are presented in different time intervals and are aimed at costomer care mission and appreciation of your valuable presence.");// Line 24

	//----------------------------------------------------content/contact/display.html
	echo T_("Thank you for choosing us.");                                            // Line 8
	echo T_("We do our best to improve jibres's quality. So, knowing your valuable comments about bugs and problems and more importantly your precious offers will help us in this way.");// Line 8
	echo T_("Name");                                                                  // Line 13
	echo T_("Full Name");                                                             // Line 15
	echo T_("Mobile");                                                                // Line 161
	echo T_("Please enter valid mobile number. `:val` is incorrect");                 // Line 19
	echo T_("Email");                                                                 // Line 254
	echo T_("Your Message");                                                          // Line 27
	echo T_("Send");                                                                  // Line 30
	echo T_("How to contact us");                                                     // Line 38
	echo T_("jibres");                                                                // Line 42
	echo T_("Ermile, Floor2, Yas Building");                                          // Line 45
	echo T_("1st alley, Haft-e-tir St");                                              // Line 52
	echo T_("Qom");                                                                   // Line 51
	echo T_("Iran");                                                                  // Line 50
	echo T_("Floor2, Yas Building");                                                  // Line 53
	echo T_("Our location on map");                                                   // Line 62

	//-------------------------------------------------content/pricing/priceTable.html
	echo T_("Free Plan");                                                             // Line 6
	echo T_("Free");                                                                  // Line 136
	echo T_("All the basics for personal use.");                                      // Line 218
	echo T_("Also <span class='txtB'>sell on social networks</span> with easy online payment.");// Line 8
	echo T_("Beta Version");                                                          // Line 9
	echo T_("Integrated Sales");                                                      // Line 54
	echo T_("Free Invoicing");                                                        // Line 55
	echo T_("Online Accounting");                                                     // Line 56
	echo T_("Signup");                                                                // Line 21
	echo T_("Starter Plan");                                                          // Line 25
	echo T_("Starter");                                                               // Line 70
	echo T_("Special choice for starting a new business.");                           // Line 27
	echo T_("vCard Website");                                                         // Line 96
	echo T_("Staff Accounts");                                                        // Line 97
	echo T_("Increase Basic Limits");                                                 // Line 98
	echo T_("Monthly");                                                               // Line 33
	echo T_("Toman");                                                                 // Line 107
	echo T_("Annually");                                                              // Line 205
	echo T_("First Year");                                                            // Line 205
	echo T_("Simple Plan");                                                           // Line 54
	echo T_("Simple");                                                                // Line 143
	echo T_("For who want try to change!");                                           // Line 56
	echo T_("Enjoy modern era.");                                                     // Line 56
	echo T_("Advance Reports");                                                       // Line 153
	echo T_("All Invoice Types");                                                     // Line 154
	echo T_("Product Intro Website");                                                 // Line 155
	echo T_("Without Limit");                                                         // Line 156
	echo T_("Standard Plan");                                                         // Line 84
	echo T_("Standard");                                                              // Line 151
	echo T_("For someones ready to use Jibres as hero.");                             // Line 86
	echo T_("<span class='bold'>Everything you need</span> for a growing business."); // Line 86
	echo T_("Online Store");                                                          // Line 211
	echo T_("News website");                                                          // Line 212
	echo T_("Shop with Your Domain");                                                 // Line 213
	echo T_("Full Permission Control");                                               // Line 214
	echo T_("Search Engine Optimized");                                               // Line 215
	echo T_("Start your free trial");                                                 // Line 112

	//----------------------------------------------------content/pricing/display.html
	echo T_("only team admin");                                                       // Line 10
	echo T_("Unlimited");                                                             // Line 119
	echo T_("Price");                                                                 // Line 60
	echo T_("Pay monthly");                                                           // Line 163
	echo T_("FREE");                                                                  // Line 46
	echo T_("Pay yearly");                                                            // Line 169
	echo T_("Two month free");                                                        // Line 60
	echo T_("More than 50 percent off");                                              // Line 76
	echo T_("Data max limit");                                                        // Line 91
	echo T_("Max product");                                                           // Line 94
	echo T_("Max third party");                                                       // Line 101
	echo T_("Max invoice each day");                                                  // Line 108
	echo T_("Max item in each invoice");                                              // Line 115
	echo T_("Basic Features");                                                        // Line 124
	echo T_("Each SMS cost");                                                         // Line 128
	echo T_("Optional");                                                              // Line 128
	echo T_("Sale on social networks");                                               // Line 157
	echo T_("Starter Features");                                                      // Line 173
	echo T_("Simple Features");                                                       // Line 199
	echo T_("Advance Settings");                                                      // Line 223
	echo T_("Standard Features");                                                     // Line 232
	echo T_("Online Shop with Your Domain");                                          // Line 249
	echo T_("Ready to use Jibres Enterprise?");                                       // Line 280
	echo T_("Get started with our Enterprise plan.");                                 // Line 281
	echo T_("Get in Touch");                                                          // Line 284
	echo T_("Billing & Invoicing");                                                   // Line 33
	echo T_("Is there a setup fee?");                                                 // Line 36
	echo T_("No. There are no setup fees on any of our plans!");                      // Line 37
	echo T_("Can I cancel my account at any time?");                                  // Line 41
	echo T_("Yes. If you ever decide that Jibres isn’t the best platform for your business, simply cancel your account.");// Line 42
	echo T_("How long are your contracts?");                                          // Line 46
	echo T_("All Jibres plans are month to month. simple.");                          // Line 47
	echo T_("Can I change my plan later on?");                                        // Line 50
	echo T_("Absolutely! You can upgrade or downgrade your plan at any time.");       // Line 51
	echo T_("When is my billing date?");                                              // Line 54
	echo T_("The date you first select a paid plan will be the recurring billing date. For example: If you sign up for the first time on July 15, all future charges will be billed on the 15th of every month.");// Line 55
	echo T_("General questions");                                                     // Line 8
	echo T_("How does Jibres work?");                                                 // Line 11
	echo T_("The easiest way to learn how to use Jibres is enter to it, which takes less than 3 minutes to setup your team.");// Line 12
	echo T_("What is your privacy and security policy?");                             // Line 15
	echo T_("View Jibres's privacy and security policy at");                          // Line 16
	echo T_("Where can I find your Terms of Service (TOS)?");                         // Line 19
	echo T_("You can find them at");                                                  // Line 20
	echo T_("What are your bandwidth fees?");                                         // Line 23
	echo T_("There are none. All Jibres plans include unlimited bandwidth for free.");// Line 24
	echo T_("Do I need a web host?");                                                 // Line 27
	echo T_("No! Jibres includes secure, unlimited hosting on all plans with free bandwith.");// Line 28
	echo T_("30 day satisfaction guarantee");                                         // Line 360
	echo T_("no questions asked!");                                                   // Line 361
	echo T_("We stand behind our service and we mean it!");                           // Line 362
	echo T_("Despite our offer 14 days free trial to start use Jibres,");             // Line 362
	echo T_("if at any time within the first 30 days period you are not happy with Jibres, you can request money back and we will refund it.");// Line 362
	echo T_("30 day Guarantee");                                                      // Line 367

	//------------------------------------------------------content/about/display.html
	echo T_("Advancement of technology and development of Web-based business Cause Need new tools to resolve the daily needs and that’s the goal of making Jibres.");// Line 48
	echo T_("Jibres have a set of simple and practical tools on a regular basis for modern businesses.");// Line 48

	//-------------------------------------------------------content/home/display.html
	echo T_("Invoice Software");                                                      // Line 30
	echo T_("Easy Invoicing Software");                                               // Line 31
	echo T_("Online Invoicing Software");                                             // Line 32
	echo T_("Free Invoicing Software");                                               // Line 33
	echo T_("Accounting Software");                                                   // Line 35
	echo T_("Online Accounting Software");                                            // Line 36
	echo T_("Sales");                                                                 // Line 38
	echo T_("Sales Software");                                                        // Line 39
	echo T_("Integrated Sales and Online Accounting");                                // Line 54
	echo T_("Simplest forever");                                                      // Line 65
	echo T_("Keep it simple");                                                        // Line 65
	echo T_("Simplicity is the ultimate sophistication");                             // Line 66
	echo T_("No one can fullfill your e-commerce needs like us");                     // Line 67
	echo T_("Of course Made with love 😍");                                            // Line 76
	echo T_("Jibres has created for futuristic entrepreneurs");                       // Line 76
	echo T_("Item");                                                                  // Line 80
	echo T_("Products");                                                              // Line 10
	echo T_("Qty");                                                                   // Line 119
	echo T_("Sold on Jibres");                                                        // Line 93
	echo T_("Roadmap");                                                               // Line 105
	echo T_("Amazing Financial Platform");                                            // Line 106
	echo T_("With Jibres we take less time of our customers and this means modern customer orientation");// Line 136
	echo T_("Majid Sadeghi, Sales Supervisor at SuperSaeed");                         // Line 137

	//------------------------------------------------------content/terms/display.html
	echo T_("Utilizing Jibres's services means the acceptance of and commitment to observing all the tenors of this agreement.");// Line 6
	echo T_("It is worth mentioning that due to the insecurity of cyberspace, you should never post your vital information on either Jibres or any other services!");// Line 9
	echo T_("User's personal information is strictly confidential in our service. Jibres preserves the information as encoded and will not under any conditions transfer it to another person.");// Line 10
	echo T_("In case there is a request for receiving user's information by the competent authorities, according to the country the user lives in, Jibres will cooperate with them only upon receiving the judicial order issued by the country submitting the request.");// Line 11
	echo T_("Jibres will not offer any guarantee as to the quality of the products or services presented by the stores and will not accept any responsibility in this regard!");// Line 12
	echo T_("Users should assume responsibility for any harm, both material and immaterial, caused by direct, indirect or penal factors and due to their utilization of this service; and, Jibres bears no responsibility accordingly.");// Line 13
	echo T_("Jibres accepts no responsibility, under any conditions, for the harms caused by users' mutual trust in each other or by the disclosure of information by users.");// Line 14
	echo T_("Jibres will do its best to protect both the users' information and the service; however, regarding the lack of certainty within the cyberspace, it will not assume any responsibility for the loss of the information entered on the service.");// Line 15
	echo T_("We will publicize our information and news only via Jibres's formal website. Accordingly, those who publicize any attributed news and claims, within social media and networks, must assume the responsibility and Jibres will not assume any responsibility.");// Line 16
	echo T_("Jibres will bear no responsibility for whatsoever messages sent to users, including those indicating winning a lottery, and all our information dissemination will be through the ways of Jibres's contact with users.");// Line 17
	echo T_("Any misuse of Jibres's trade name is prohibited and will be suable by making a complaint to the legal competent authorities.");// Line 18
	echo T_("Furthermore, this agreement, under the name Terms and Conditions, will be available and observable, in all pages of the website. Users will be responsible for a lack of information on the most recent changes.");// Line 19
	echo T_("It should be mentioned that in case there would be any modifications in the above-mentioned tenors, an updated version will be available for the public, and as well, all the users will be informed.");// Line 22

	//----------------------------------------------------content/privacy/display.html
	echo T_("What is Privacy?");                                                      // Line 6
	echo T_("Privacy means that any individual is entitled to choose the information related to them, and selectively, share it with others.");// Line 7
	echo T_("privacy is so important for mental peace as well as a peaceful personality that some experts have considered invasion of privacy disrespectful to human dignity.");// Line 8
	echo T_("Controversies over the Invasion of Privacy");                            // Line 10
	echo T_("Within e-commerce, privacy has always been from among the most controversial topics and continues to be.");// Line 11
	echo T_("Accordingly, formulating privacy policies is regarded as one of the crucial concerns of technology companies.");// Line 11
	echo T_("Meanwhile, widespread controversies have been provoked over invasion of privacy in e-commerce so that, occasionally, the regulations have to be revised to eliminate the existing weaknesses.");// Line 11
	echo T_("Privacy from Our Point of View");                                        // Line 13
	echo T_("Let us be straightforward! Cyberspace is not a safe location for personal information.");// Line 14
	echo T_("For that reason, Jibres makes no request for important information of yours and allow to save some general information including age, gender, education, interests, etc is only for private use of your team or company.");// Line 15
	echo T_("It is worth mentioning that recording the aforementioned points is totally voluntary.");// Line 15
	echo T_("However, taking the nature of cyberspace into account, we should remember that offering an absolute assurance might not be possible.");// Line 16
	echo T_("Assuring privacy and security, with that ideal concept we bear in mind, does not exist; and if somebody gives you an assurance of securing your privacy, he has certainly abused your trust.");// Line 16
	echo T_("Upon buying any digital or the so-called smart device, you have invaded your own privacy yourself.");// Line 17
	echo T_("If you want your privacy not to be invaded, you should depart from technology and say goodbye to any digital and smart device.");// Line 17
	echo T_("In fact, we have employed all updated technologies of the world to provide you with the maximum security.");// Line 17
	echo T_("As the final remark, we wish to assure you that our main concern is to secure your privacy and protect your information against impermissible access.");// Line 19

	//---------------------------------------------------content/help/faq/display.html

	//-------------------------------------------------------content/help/display.html

	//-------------------------------------------------------content/logo/display.html

	//--------------------------------------------------content/changelog/display.html
	echo T_("We are Developers, please wait!");                                       // Line 18
	echo T_("Version 1 of Jibres will be released.");                                 // Line 24
	echo T_("add support of digital scale barcode and get weight of product automatically.");// Line 30
	echo T_("We reach 1B+ Toman sold on Jibres.");                                    // Line 36
	echo T_("We reach 100M+ Toman sold on Jibres.");                                  // Line 42
	echo T_("We reach 10000 factor records.");                                        // Line 48
	echo T_("First factor of first store is generated.");                             // Line 54
	echo T_("Our first store on web is created and start add product to store.");     // Line 60
	echo T_("Beta version is released.");                                             // Line 66
	echo T_("Alfa version is released.");                                             // Line 72
	echo T_("We restart plans to run Jibres at Ermile.");                             // Line 78
	echo T_("The name of project selected as Jibres and <a href='https://Jibres.ir' target='_blank'>Jibres.ir</a> and <a href='https://Jibres.com'>Jibres.com</a> domains are registered.");// Line 84
	echo T_("Create git repository and first commit is pushed.");                     // Line 90
	echo T_("Database is completely designed and implementated.");                    // Line 96
	echo T_("02:00 AM");                                                              // Line 101
	echo T_("Start database analysis of Jibres.");                                    // Line 102
	echo T_("We were born to do Best!");                                              // Line 108
	echo T_("Be patient...");                                                         // Line 114

	//-----------------------------------------------------------content_a/layout.html
	echo T_("Products Summary");                                                      // Line 55
	echo T_("Add new Product");                                                       // Line 74
	echo T_("Categories of Product");                                                 // Line 15
	echo T_("Product Units");                                                         // Line 16
	echo T_("Third Parties");                                                         // Line 24
	echo T_("Customers");                                                             // Line 27
	echo T_("Suppliers");                                                             // Line 49
	echo T_("Staffs");                                                                // Line 38
	echo T_("register new sale factor");                                              // Line 38
	echo T_("List of sales");                                                         // Line 40
	echo T_("List of purchases");                                                     // Line 41
	echo T_("List of all factors");                                                   // Line 42
	echo T_("Reports");                                                               // Line 48
	echo T_("Daily report");                                                          // Line 20
	echo T_("Monthly report");                                                        // Line 20
	echo T_("Setting");                                                               // Line 58
	echo T_("Store plans");                                                           // Line 61
	echo T_("Factor settings");                                                       // Line 62
	echo T_("Shift transformation");                                                  // Line 68
	echo T_("You are active user");                                                   // Line 74

	//---------------------------------------------content_a/report/daily/display.html
	echo T_("Sum");                                                                   // Line 85

	//-------------------------------------------------content_a/report/daily/chart.js
	echo T_("Sum price");                                                             // Line 103

	//---------------------------------------------content_a/report/month/display.html

	//-------------------------------------------------content_a/report/month/chart.js

	//----------------------------------------------content_a/report/home/display.html
	echo T_("Report daily");                                                          // Line 17
	echo T_("Report Month");                                                          // Line 28

	//---------------------------------------------content_a/setting/fund/display.html
	echo T_("Add new fund");                                                          // Line 19
	echo T_("Edit");                                                                  // Line 122
	echo T_("Disable");                                                               // Line 33
	echo T_("Enable");                                                                // Line 35
	echo T_("Is default fund?");                                                      // Line 50
	echo T_("Is sale online from this fund?");                                        // Line 59
	echo T_("Sale from this fund?");                                                  // Line 68
	echo T_("Fund name");                                                             // Line 75
	echo T_("Fund title");                                                            // Line 102
	echo T_("Enter a valid name from 3 to 40 character");                             // Line 138
	echo T_("Action");                                                                // Line 107
	echo T_("Pos");                                                                   // Line 405
	echo T_("Select pos");                                                            // Line 159
	echo T_("City");                                                                  // Line 157
	echo T_("Select city");                                                           // Line 159
	echo T_("Post code");                                                             // Line 172
	echo T_("Phone");                                                                 // Line 246
	echo T_("Fax");                                                                   // Line 236
	echo T_("Address");                                                               // Line 472

	//---------------------------------------------------content_a/setting/layout.html
	echo T_("Public");                                                                // Line 19
	echo T_("Maximum value");                                                         // Line 50
	echo T_("Inventory");                                                             // Line 61
	echo T_("Fund");                                                                  // Line 72
	echo T_("POS");                                                                   // Line 93
	echo T_("Without traffic");                                                       // Line 109
	echo T_("Last traffic");                                                          // Line 111
	echo T_("General Detail");                                                        // Line 117
	echo T_("Store Plan");                                                            // Line 118
	echo T_("Insert");                                                                // Line 42
	echo T_("Save All");                                                              // Line 46
	echo T_("allowed extentions jpg, png (gif for bussiness plans). Max 500Kb");      // Line 23
	echo T_("Team short name");                                                       // Line 168
	echo T_("Used for url of board");                                                 // Line 168
	echo T_("Slug of team for board url");                                            // Line 170
	echo T_("Website");                                                               // Line 179
	echo T_("Link your logo on board for visitors");                                  // Line 177
	echo T_("For show in factors");                                                   // Line 207
	echo T_("Used for description of board and show in social media links");          // Line 201
	echo T_("Choose your plan");                                                      // Line 132
	echo T_("Everything you need for a growing business.");                           // Line 224
	echo T_("Yearly");                                                                // Line 36
	echo T_("Everything in Free plus automatic report via Telegram.");                // Line 236
	echo T_("Full");                                                                  // Line 240
	echo T_("For big companies that need fix price per month.");                      // Line 240
	echo T_("Force show in specefic language");                                       // Line 249
	echo T_("Please select one language");                                            // Line 251
	echo T_("Persian");                                                               // Line 252
	echo T_("English");                                                               // Line 253
	echo T_("Report Header");                                                         // Line 263
	echo T_("Report Footer");                                                         // Line 271
	echo T_("Active print factor");                                                   // Line 282
	echo T_("Fish print");                                                            // Line 338
	echo T_("Short");                                                                 // Line 302
	echo T_("A4");                                                                    // Line 342
	echo T_("A5");                                                                    // Line 346
	echo T_("Default print_size");                                                    // Line 327
	echo T_("No default");                                                            // Line 394
	echo T_("Cash");                                                                  // Line 96
	echo T_("Check");                                                                 // Line 379
	echo T_("Default pay");                                                           // Line 391

	//------------------------------------------content_a/setting/maximum/display.html
	echo T_("Maximum buyprice");                                                      // Line 34
	echo T_("Maximum price");                                                         // Line 44
	echo T_("Maximum discount");                                                      // Line 54
	echo T_("Maximum product count in factor");                                       // Line 63

	//----------------------------------------------content_a/setting/pos/display.html
	echo T_("Add new pos to you store");                                              // Line 26
	echo T_("Pos issuer bank");                                                       // Line 28
	echo T_("Add pos");                                                               // Line 46
	echo T_("Default");                                                               // Line 64
	echo T_("Is default");                                                            // Line 114
	echo T_("PcPos");                                                                 // Line 76
	echo T_("Set as default");                                                        // Line 90
	echo T_("Remove");                                                                // Line 22
	echo T_("Enable irankish PC POS");                                                // Line 115
	echo T_("Serial");                                                                // Line 121
	echo T_("Terminal");                                                              // Line 126
	echo T_("Receiver");                                                              // Line 131
	echo T_("Enable asanpardakht PC POS");                                            // Line 146
	echo T_("IP");                                                                    // Line 153
	echo T_("Port");                                                                  // Line 161

	//------------------------------------------content_a/setting/general/display.html
	echo T_("Closed");                                                                // Line 46

	//---------------------------------------------content_a/setting/home/display.html
	echo T_("Hi");                                                                    // Line 6

	//----------------------------------------content_a/setting/inventory/display.html
	echo T_("Add new inventory");                                                     // Line 19
	echo T_("Is default inventory?");                                                 // Line 52
	echo T_("Is sale online from this inventory?");                                   // Line 61
	echo T_("Sale from this inventory?");                                             // Line 70
	echo T_("Inventory name");                                                        // Line 79
	echo T_("Inventory Name");                                                        // Line 104
	echo T_("Is default inventory");                                                  // Line 117
	echo T_("Sale from this inventory");                                              // Line 118
	echo T_("Sale online");                                                           // Line 119

	//---------------------------------------------content_a/setting/plan/display.html
	echo T_("By choose new plan, we generate your invoice until now and next invoice is created one month later exactly at this time and you can pay it from billing.");// Line 12
	echo T_("Cancel plan change process");                                            // Line 15
	echo T_("Your plan have some days!");                                             // Line 11
	echo T_("Are you sure to change your plan?");                                     // Line 13
	echo T_("Trial");                                                                 // Line 34
	echo T_("Forever");                                                               // Line 50
	echo T_("14 days free trial");                                                    // Line 39
	echo T_("Totaly Free");                                                           // Line 51
	echo T_("Current Plan");                                                          // Line 48
	echo T_("Renew");                                                                 // Line 221
	echo T_("Upgrade");                                                               // Line 13
	echo T_("Choose plan");                                                           // Line 226
	echo T_("Expire on");                                                             // Line 52
	echo T_("History");                                                               // Line 69
	echo T_("Start");                                                                 // Line 76
	echo T_("End");                                                                   // Line 77
	echo T_("Period");                                                                // Line 80

	//----------------------------------------content_a/setting/plan/choosePeriod.html
	echo T_("Back");                                                                  // Line 8

	//------------------------------------------content_a/setting/plan/choosePlan.html

	//-----------------------------------content_a/setting/plan/currentPlanDetail.html
	echo T_("Continuation");                                                          // Line 21
	echo T_("Change plan");                                                           // Line 28
	echo T_("Plan expire date");                                                      // Line 106
	echo T_("Require");                                                               // Line 90
	echo T_("Promo code");                                                            // Line 124
	echo T_("If you have promo code, enter it to give some discount!");               // Line 124
	echo T_("Choose your plan period");                                               // Line 159
	echo T_("two month is free");                                                     // Line 169

	//-------------------------------------------content_a/setting/factor/display.html
	echo T_("Print status");                                                          // Line 8
	echo T_("Pay setting");                                                           // Line 15
	echo T_("Header");                                                                // Line 33
	echo T_("Used when printing factor");                                             // Line 36
	echo T_("Factor header");                                                         // Line 34
	echo T_("Footer");                                                                // Line 36
	echo T_("Factor footer");                                                         // Line 37

	//------------------------------------------------------content_a/buy/display.html
	echo T_("You can add new empty tab if current tab is filled!");                   // Line 6
	echo T_("Factor Price Detail");                                                   // Line 30
	echo T_("Total payable");                                                         // Line 133
	echo T_("Count of items");                                                        // Line 33
	echo T_("Sum of counts");                                                         // Line 92
	echo T_("Invoice amount");                                                        // Line 124
	echo T_("Discount percent");                                                      // Line 78
	echo T_("Press f7 or click to toggle discount");                                  // Line 37
	echo T_("Total discount");                                                        // Line 37
	echo T_("Save Factor & Continue");                                                // Line 54
	echo T_("Save & Print");                                                          // Line 71
	echo T_("Save & Next");                                                           // Line 68
	echo T_("Row");                                                                   // Line 57
	echo T_("Count");                                                                 // Line 59
	echo T_("Buy price");                                                             // Line 99
	echo T_("Total");                                                                 // Line 62
	echo T_("Choose supplier");                                                       // Line 107
	echo T_("Search in list to add product");                                         // Line 159
	echo T_("Last scanned barcode");                                                  // Line 185

	//------------------------------------------------------content_a/pay/display.html
	echo T_("Print Status is active");                                                // Line 23
	echo T_("Payment detail");                                                        // Line 40
	echo T_("Choose card reader");                                                    // Line 57
	echo T_("Save Pay & continue");                                                   // Line 76

	//-----------------------------------------------------content_a/sale/display.html
	echo T_("Choose customer");                                                       // Line 110
	echo T_("Quickly add customer");                                                  // Line 116
	echo T_("Like");                                                                  // Line 256
	echo T_("Gender");                                                                // Line 196
	echo T_("Mr");                                                                    // Line 198
	echo T_("Mrs");                                                                   // Line 199
	echo T_("Customer Name");                                                         // Line 149

	//--------------------------------------------------content_a/chap/size-a4/a4.html
	echo T_("Buyer Detail");                                                          // Line 42
	echo T_("Tel");                                                                   // Line 23
	echo T_("Sale Invoice");                                                          // Line 65
	echo T_("Your total discount and profits");                                       // Line 128

	//-----------------------------------------------------content_a/chap/display.html
	echo T_("Another print formats");                                                 // Line 8
	echo T_("Please choose one format to print factor");                              // Line 21

	//----------------------------------------content_a/chap/size-receipt/receipt.html
	echo T_("Customer Detail");                                                       // Line 42

	//-----------------------------------content_a/chap/size-receipt/receipt-long.html

	//----------------------------------content_a/chap/size-receipt/receipt-short.html

	//------------------------------------------------content_a/thirdparty/layout.html
	echo T_("Type of thirdparty");                                                    // Line 81
	echo T_("Customer");                                                              // Line 117
	echo T_("Supplier");                                                              // Line 117
	echo T_("Tag");                                                                   // Line 445
	echo T_("Add tag manually to link thirdparty togethers");                         // Line 455
	echo T_("Tag keywords...");                                                       // Line 456
	echo T_("Save tag");                                                              // Line 462
	echo T_("Salesman Name");                                                         // Line 115
	echo T_("Last name");                                                             // Line 146
	echo T_("National code");                                                         // Line 169
	echo T_("10 digit national code");                                                // Line 171
	echo T_("Father name");                                                           // Line 179
	echo T_("Birthday");                                                              // Line 185
	echo T_("Birth city");                                                            // Line 210
	echo T_("Passport id");                                                           // Line 223
	echo T_("No problem with email marketing");                                       // Line 264
	echo T_("No problem with sms marketing");                                         // Line 272
	echo T_("Customer is tax exempt");                                                // Line 280
	echo T_("Click to choose new image as avatar");                                   // Line 288
	echo T_("Avatar");                                                                // Line 289
	echo T_("Nationality");                                                           // Line 299
	echo T_("Choose your nationality");                                               // Line 303
	echo T_("National card photo");                                                   // Line 318
	echo T_("ID card image");                                                         // Line 328
	echo T_("Passport card image");                                                   // Line 338
	echo T_("Marital");                                                               // Line 348
	echo T_("Single");                                                                // Line 351
	echo T_("Married");                                                               // Line 352
	echo T_("Company name");                                                          // Line 368
	echo T_("Enter company name");                                                    // Line 370
	echo T_("Visitor name");                                                          // Line 387
	echo T_("Identify code");                                                         // Line 396
	echo T_("Customer code");                                                         // Line 403
	echo T_("Desctiption");                                                           // Line 411
	echo T_("Glance");                                                                // Line 482
	echo T_("Profile");                                                               // Line 432
	echo T_("Logs");                                                                  // Line 450
	echo T_("Notes");                                                                 // Line 465
	echo T_("General");                                                               // Line 584
	echo T_("Identify");                                                              // Line 475
	echo T_("avatar");                                                                // Line 478
	echo T_("Company Detail");                                                        // Line 481
	echo T_("Transaction");                                                           // Line 498
	echo T_("Charge account");                                                        // Line 502
	echo T_("Uncharge account");                                                      // Line 506
	echo T_("Credit");                                                                // Line 60
	echo T_("Has bought");                                                            // Line 517
	echo T_("Sold");                                                                  // Line 288

	//---------------------------------------content_a/thirdparty/comment/display.html
	echo T_("Add note");                                                              // Line 28
	echo T_("Write your note about user.");                                           // Line 30
	echo T_("Something like calls, favorites, hobbits, special approach or something else.");// Line 30
	echo T_("Add new note");                                                          // Line 31

	//------------------------------content_a/thirdparty/minustransaction/display.html
	echo T_("Decrease from budget");                                                  // Line 50
	echo T_("Minus amount of budget");                                                // Line 53
	echo T_("Title of transaction");                                                  // Line 67
	echo T_("Enter a valid title");                                                   // Line 67
	echo T_("Price of transaction");                                                  // Line 76
	echo T_("Enter a valid price");                                                   // Line 76
	echo T_("Pay type");                                                              // Line 90
	echo T_("Please select one item");                                                // Line 92
	echo T_("Card to card");                                                          // Line 95
	echo T_("Gift");                                                                  // Line 97
	echo T_("Enter bank name");                                                       // Line 104
	echo T_("Enter a valid bank");                                                    // Line 104
	echo T_("Track id");                                                              // Line 104
	echo T_("Enter track id");                                                        // Line 108
	echo T_("Description of transaction to show in website");                         // Line 117

	//---------------------------------------content_a/thirdparty/billing/display.html
	echo T_("Thirdparty credit");                                                     // Line 28
	echo T_("Financial balance");                                                     // Line 32
	echo T_("Max credit");                                                            // Line 38
	echo T_("Remain credit");                                                         // Line 43

	//----------------------------------------content_a/thirdparty/manage/display.html
	echo T_("Permission");                                                            // Line 66
	echo T_("No permission");                                                         // Line 68
	echo T_("Active");                                                                // Line 75
	echo T_("Deactive");                                                              // Line 80
	echo T_("Suspended");                                                             // Line 85
	echo T_("Filter");                                                                // Line 90
	echo T_("Delete");                                                                // Line 95
	echo T_("Leave");                                                                 // Line 100
	echo T_("Delete account");                                                        // Line 113

	//----------------------------------------content_a/thirdparty/credit/display.html
	echo T_("Increase or decrease thirdparty credit");                                // Line 26
	echo T_("thirdparties can take unit with this credit until max value of set for each thirdparty.");// Line 27
	echo T_("Here you can increase or decrease max value of thirdparty credit.");     // Line 27
	echo T_("New Credit");                                                            // Line 45
	echo T_("New credit of thirdparty");                                              // Line 47

	//-------------------------------------------content_a/thirdparty/add/display.html
	echo T_("Add new customer");                                                      // Line 33
	echo T_("Add new staff");                                                         // Line 52
	echo T_("Salesman detail");                                                       // Line 68
	echo T_("Add new supplier");                                                      // Line 72
	echo T_("Please choose type of third party you want to add.");                    // Line 85

	//----------------------------------------content_a/thirdparty/avatar/display.html

	//---------------------------------------content_a/thirdparty/general/display.html
	echo T_("Contact detail");                                                        // Line 40

	//-------------------------------content_a/thirdparty/plustransaction/display.html
	echo T_("Increase amount of budget");                                             // Line 53

	//------------------------------------------content_a/thirdparty/home/display.html
	echo T_("Member");                                                                // Line 66
	echo T_("Customer total order");                                                  // Line 71
	echo T_("Customer total spend");                                                  // Line 81
	echo T_("Customer credit");                                                       // Line 77
	echo T_("Supplier total purchased order");                                        // Line 102
	echo T_("Supplier total purchased");                                              // Line 112
	echo T_("Staff total sales");                                                     // Line 89
	echo T_("Staff total buy order");                                                 // Line 93
	echo T_("Staff count buy order");                                                 // Line 94
	echo T_("Staff total sales order");                                               // Line 95
	echo T_("Balance");                                                               // Line 98
	echo T_("Last activity");                                                         // Line 14
	echo T_("Without name");                                                          // Line 117
	echo T_("Without mobile");                                                        // Line 128
	echo T_("Try to start with add new member!");                                     // Line 205
	echo T_("All thirdparty");                                                        // Line 228

	//----------------------------------------content_a/thirdparty/glance/display.html
	echo T_("Joined to store at");                                                    // Line 13
	echo T_("Budget");                                                                // Line 50
	echo T_("Customer last spend");                                                   // Line 91
	echo T_("Staff total sale order");                                                // Line 123
	echo T_("Staff total sale");                                                      // Line 133
	echo T_("Staff last sale");                                                       // Line 143

	//---------------------------------------content_a/thirdparty/company/display.html
	echo T_("Economic code");                                                         // Line 53
	echo T_("Enter economic code");                                                   // Line 55
	echo T_("Company national id");                                                   // Line 61
	echo T_("Enter company national id");                                             // Line 63
	echo T_("Company register number");                                               // Line 70
	echo T_("Enter register number");                                                 // Line 72
	echo T_("Company Telephone number");                                              // Line 79
	echo T_("Enter tel number");                                                      // Line 81

	//---------------------------------------content_a/thirdparty/profile/display.html

	//-----------------------------------content_a/thirdparty/transaction/display.html
	echo T_("Search in transactions");                                                // Line 66
	echo T_("Budget After");                                                          // Line 83
	echo T_("No transaction found");                                                  // Line 133

	//----------------------------------------content_a/thirdparty/export/display.html
	echo T_("Please choose type of third party you want to export.");                 // Line 7
	echo T_("Please wait to complete export process");                                // Line 57
	echo T_("Thirdparties");                                                          // Line 60

	//-----------------------------------------------------content_a/home/display.html
	echo T_("Sale Invoicing");                                                        // Line 85
	echo T_("Buy Invocing");                                                          // Line 95
	echo T_("Sales count group by hour");                                             // Line 144

	//---------------------------------------------------------content_a/home/chart.js
	echo T_("Sum factor price and count of it group by hours");                       // Line 20

	//-------------------------------------------content_a/product/import/display.html
	echo T_("Choose your CSV");                                                       // Line 10
	echo T_("Please wait to complete import progress");                               // Line 14
	echo T_("Import");                                                                // Line 14

	//---------------------------------------------content_a/product/desc/display.html

	//---------------------------------------------------content_a/product/layout.html
	echo T_("Stock");                                                                 // Line 81
	echo T_("Name of product");                                                       // Line 54
	echo T_("Enter a valid name");                                                    // Line 54
	echo T_("Set short and best title for your product");                             // Line 62
	echo T_("Slug");                                                                  // Line 71
	echo T_("Manufacturer");                                                          // Line 78
	echo T_("Product manufacturer");                                                  // Line 81
	echo T_("Cat");                                                                   // Line 94
	echo T_("Organize by category");                                                  // Line 96
	echo T_("Unit");                                                                  // Line 108
	echo T_("like Qty, kg, etc");                                                     // Line 110
	echo T_("For quick access");                                                      // Line 125
	echo T_("Short code");                                                            // Line 133
	echo T_("Barcode");                                                               // Line 141
	echo T_("Scan Barcode here...");                                                  // Line 143
	echo T_("Barcode2");                                                              // Line 150
	echo T_("Scan Barcode2 here...");                                                 // Line 152
	echo T_("Code on scale");                                                         // Line 159
	echo T_("Enter product code on scale");                                           // Line 161
	echo T_("Sale Price");                                                            // Line 185
	echo T_("Price for sale without discount");                                       // Line 187
	echo T_("Impure Interest Rate");                                                  // Line 188
	echo T_("Final Price");                                                           // Line 33
	echo T_("Final Pure Price");                                                      // Line 197
	echo T_("Pure Interest Rates");                                                   // Line 198
	echo T_("Discount on sale");                                                      // Line 211
	echo T_("Discount Percent");                                                      // Line 140
	echo T_("Vat");                                                                   // Line 221
	echo T_("This product is vat base");                                              // Line 221
	echo T_("Initial Balance");                                                       // Line 229
	echo T_("Min stock");                                                             // Line 237
	echo T_("Max stock");                                                             // Line 246
	echo T_("Status of product");                                                     // Line 253
	echo T_("Avalible");                                                              // Line 257
	echo T_("Normal status of product");                                              // Line 257
	echo T_("maybe come in future and be available");                                 // Line 262
	echo T_("Unavailable");                                                           // Line 267
	echo T_("temporary does not exist in store");                                     // Line 267
	echo T_("Discountinued");                                                         // Line 272
	echo T_("does not exist for now and on the future");                              // Line 272
	echo T_("Unset");                                                                 // Line 277
	echo T_("Unknown status for product");                                            // Line 277
	echo T_("Service");                                                               // Line 306
	echo T_("This product is service base and not a real goods");                     // Line 306
	echo T_("Sale Online");                                                           // Line 315
	echo T_("This product is saleonline base");                                       // Line 315
	echo T_("Sale in store");                                                         // Line 325
	echo T_("This product is salestore base");                                        // Line 325
	echo T_("Count in carton");                                                       // Line 333
	echo T_("Count of product in carton");                                            // Line 335
	echo T_("Site");                                                                  // Line 500
	echo T_("Report");                                                                // Line 520
	echo T_("Price change");                                                          // Line 535
	echo T_("Gallery");                                                               // Line 49
	echo T_("Property");                                                              // Line 569

	//------------------------------------------content_a/product/gallery/display.html
	echo T_("Add to gallery");                                                        // Line 31
	echo T_("To add image gallery drop file here or click here");                     // Line 32
	echo T_("Maximum file size");                                                     // Line 38
	echo T_("Click to download");                                                     // Line 72
	echo T_("Video");                                                                 // Line 62
	echo T_("MP3");                                                                   // Line 68
	echo T_("PDF");                                                                   // Line 70
	echo T_("Without preview");                                                       // Line 72

	//-----------------------------------------content_a/product/pricehistory/chart.js
	echo T_("Price change in time line");                                             // Line 26

	//-------------------------------------------content_a/product/manage/display.html
	echo T_("Delete product");                                                        // Line 20

	//------------------------------------------content_a/product/summary/display.html
	echo T_("You are not add product yet!");                                          // Line 27
	echo T_("Add some new product");                                                  // Line 27
	echo T_("Add new products");                                                      // Line 36
	echo T_("List of products");                                                      // Line 45
	echo T_("Import products");                                                       // Line 54
	echo T_("Export");                                                                // Line 11
	echo T_("Price Variation");                                                       // Line 80
	echo T_("Check list of products");                                                // Line 96
	echo T_("Product Count");                                                         // Line 99
	echo T_("Product with barcode");                                                  // Line 109
	echo T_("Product with barcode2");                                                 // Line 119
	echo T_("Min");                                                                   // Line 162
	echo T_("Max");                                                                   // Line 171
	echo T_("Average");                                                               // Line 180
	echo T_("Buy Price");                                                             // Line 191

	//----------------------------------------------content_a/product/summary/chart.js
	echo T_("Count product group by price");                                          // Line 26
	echo T_("Count product group by unit");                                           // Line 125
	echo T_("Count product group by category");                                       // Line 206

	//---------------------------------------------content_a/product/home/display.html
	echo T_("Duplicate title");                                                       // Line 8
	echo T_("Have barcode");                                                          // Line 9
	echo T_("Have not barcode");                                                      // Line 10
	echo T_("Just code");                                                             // Line 11
	echo T_("No barcode & code");                                                     // Line 12
	echo T_("Whithout buyprice");                                                     // Line 13
	echo T_("Whithout price");                                                        // Line 14
	echo T_("Whithout min stock");                                                    // Line 15
	echo T_("Whithout max stock");                                                    // Line 16
	echo T_("Whithout discount");                                                     // Line 17
	echo T_("Negative profit");                                                       // Line 18
	echo T_("Search in products");                                                    // Line 61
	echo T_("Buy");                                                                   // Line 279
	echo T_("Final price");                                                           // Line 79
	echo T_("Gross profit");                                                          // Line 80
	echo T_("Last modified");                                                         // Line 82
	echo T_("stock count is less than zero!");                                        // Line 91
	echo T_("Discount more than 50 percent!");                                        // Line 97
	echo T_("Final price is under buy price");                                        // Line 98
	echo T_("Add new product");                                                       // Line 128
	echo T_("Try to start with add new product!");                                    // Line 136

	//-------------------------------------------content_a/product/glance/display.html
	echo T_("Added to store at");                                                     // Line 12
	echo T_("Last update");                                                           // Line 13
	echo T_("Date of Last buy");                                                      // Line 57
	echo T_("Date of last sale");                                                     // Line 67
	echo T_("Date of minimum sale price");                                            // Line 78
	echo T_("Date of maximum sale price");                                            // Line 88
	echo T_("Sale price");                                                            // Line 109
	echo T_("Off price");                                                             // Line 119
	echo T_("%");                                                                     // Line 141

	//--------------------------------------------content_a/product/units/display.html
	echo T_("Edit unit");                                                             // Line 20
	echo T_("Add new unit");                                                          // Line 22
	echo T_("By update name of this unit all product will be update to new value.");  // Line 33
	echo T_("Click to check list of this product");                                   // Line 31
	echo T_("No product in this unit");                                               // Line 35
	echo T_("You can delete it now!");                                                // Line 34
	echo T_("Cancel");                                                                // Line 44
	echo T_("Is default unit?");                                                      // Line 63
	echo T_("Sometimes employees sell some product with decimal unit and if you are force this unit to give integer value, we are not allow them to enter invalid value");// Line 72
	echo T_("Only accept integer value?");                                            // Line 76
	echo T_("Max sale from this unit");                                               // Line 84
	echo T_("For example 100");                                                       // Line 83
	echo T_("Unit name");                                                             // Line 97
	echo T_("Force integer value");                                                   // Line 109
	echo T_("Count product");                                                         // Line 106
	echo T_("Without Unit");                                                          // Line 120
	echo T_("Click to check products in this category");                              // Line 119

	//---------------------------------------------content_a/product/cats/display.html
	echo T_("Edit category");                                                         // Line 20
	echo T_("By update name of this category all product will be update to new value.");// Line 31
	echo T_("No product in this category");                                           // Line 33
	echo T_("Is default category?");                                                  // Line 61
	echo T_("Decimal or Integer");                                                    // Line 71
	echo T_("Decimal");                                                               // Line 72
	echo T_("Integer");                                                               // Line 73
	echo T_("Max sale from this cat");                                                // Line 81
	echo T_("Category name");                                                         // Line 94
	echo T_("Without Category");                                                      // Line 117

	//-------------------------------------------content_a/product/export/display.html
	echo T_("Please wait to complete export progress");                               // Line 11

	//-------------------------------------------content_a/product/factor/display.html

	//--------------------------------------------content_a/product/stock/display.html

	//----------------------------------------------content_a/factor/home/display.html
	echo T_("No factor founded.");                                                    // Line 55
	echo T_("Search with new keywords or barcode.");                                  // Line 55
	echo T_("Add new sale");                                                          // Line 86
	echo T_("Add new buy");                                                           // Line 87
	echo T_("You are not have factor yet! add new one.");                             // Line 62
	echo T_("Search in factors list");                                                // Line 101
	echo T_("You are not register any factor yet!");                                  // Line 85
	echo T_("Advance result");                                                        // Line 100
	echo T_("Items");                                                                 // Line 118
	echo T_("Invoice Date");                                                          // Line 123
	echo T_("Operation");                                                             // Line 127
	echo T_("Whithout name");                                                         // Line 142
	echo T_("Quick");                                                                 // Line 147
	echo T_("View");                                                                  // Line 166
	echo T_("More");                                                                  // Line 181
	echo T_("Sale");                                                                  // Line 268
	echo T_("Prefactor");                                                             // Line 306
	echo T_("Lending");                                                               // Line 318
	echo T_("Backbuy");                                                               // Line 213
	echo T_("Backfactor");                                                            // Line 214
	echo T_("Waste");                                                                 // Line 215
	echo T_("Try to start with add new sale!");                                       // Line 238
	echo T_("Try to start with add new buy!");                                        // Line 239
	echo T_("All");                                                                   // Line 258
	echo T_("Other");                                                                 // Line 290
	echo T_("Back buy");                                                              // Line 310
	echo T_("Back factor");                                                           // Line 314
	echo T_("waste");                                                                 // Line 322
	echo T_("Filter by product");                                                     // Line 372
	echo T_("Filter by customer");                                                    // Line 377
	echo T_("Filter by weekday");                                                     // Line 382
	echo T_("Filter by date");                                                        // Line 387
	echo T_("Filter by time");                                                        // Line 392
	echo T_("Filter by start and end date");                                          // Line 397
	echo T_("Filter by price");                                                       // Line 402
	echo T_("Filter by item");                                                        // Line 408
	echo T_("Filter by discount");                                                    // Line 413
	echo T_("Filter by count");                                                       // Line 418
	echo T_("Filter by type");                                                        // Line 423
	echo T_("Clear filter");                                                          // Line 431
	echo T_("Apply");                                                                 // Line 432
	echo T_("Please choose product");                                                 // Line 452
	echo T_("saturday");                                                              // Line 462
	echo T_("sunday");                                                                // Line 469
	echo T_("monday");                                                                // Line 477
	echo T_("tuesday");                                                               // Line 486
	echo T_("wednesday");                                                             // Line 494
	echo T_("thursday");                                                              // Line 502
	echo T_("friday");                                                                // Line 510
	echo T_("Special date");                                                          // Line 522
	echo T_("Start date");                                                            // Line 540
	echo T_("End date");                                                              // Line 546
	echo T_("Sum price is greater than ...");                                         // Line 562
	echo T_("Sum price less than ...");                                               // Line 568
	echo T_("Price is equal to ...");                                                 // Line 574
	echo T_("Item is greater than ...");                                              // Line 589
	echo T_("Item less than ...");                                                    // Line 595
	echo T_("Item is equal to ...");                                                  // Line 601
	echo T_("Sum is greater than ...");                                               // Line 614
	echo T_("Sum less than ...");                                                     // Line 620
	echo T_("Sum is equal to ...");                                                   // Line 626
	echo T_("Discount is greater than ...");                                          // Line 640
	echo T_("Discount less than ...");                                                // Line 646
	echo T_("Discount is equal to ...");                                              // Line 652
	echo T_("sale");                                                                  // Line 665
	echo T_("buy");                                                                   // Line 672

	//----------------------------------------------content_a/factor/edit/display.html
	echo T_("Save & print");                                                          // Line 40
	echo T_("Count of rows");                                                         // Line 90
	echo T_("Sum of prices");                                                         // Line 93
	echo T_("Sum of discounts");                                                      // Line 94
	echo T_("Sum of final prices");                                                   // Line 95

	//-----------------------------------------------content_a/permission/display.html
	echo T_("Permission title");                                                      // Line 10
	echo T_("Customized");                                                            // Line 12
	echo T_("Need double check permission for some sensitive permissions");           // Line 30
	echo T_("Do hard check and need to enter again");                                 // Line 31
	echo T_("Count of user in permission");                                           // Line 48
	echo T_("Remove this permission if not need");                                    // Line 52
	echo T_("No user");                                                               // Line 52
	echo T_("Click to show list of user by this permission");                         // Line 54
	echo T_("User");                                                                  // Line 54

	//----------------------------------------content_a/permission/delete/display.html
	echo T_("The permission name should be unique and contain only alphanameric characters and underscores");// Line 14
	echo T_("Name of your permission");                                               // Line 14
	echo T_("Label");                                                                 // Line 17
	echo T_("The permission label is used to represent your permission in user management");// Line 18
	echo T_("Label of your permission");                                              // Line 18

	//---------------------------------------------content_subdomain/home/display.html

 }
}
?>