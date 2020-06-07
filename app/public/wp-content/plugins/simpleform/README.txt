=== SimpleForm - The simplest way to add a contact form ===

Contributors: simpleform
Donate link: https://wpsform.com/
Tags: contact form, form builder, simple form, form, contact, wordpress contact form, custom contact form, simple contact form, email form, web form, message form, smtp
Requires at least: 4.7
Tested up to: 5.4
Requires PHP: 5.6
Stable tag: 1.7
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A simple and effective contact form. Ready to use thanks to the SMTP setup options.

== Description ==

SimpleForm is a very simple to manage plugin for creating a basic contact form for your website. Here’s why use it:

= Easy to use =

This plugin is very easy to set up thanks to a graceful and intuitive admin interface. You can quickly create a contact form by using our pre-built page or copying a shortcode where you want it to appear.

= Fully customizable =

It allows you to customize everything you want. You can decide which fields to display and what kind of user can see them. You can decide which fields are required and which are not. You can change or hide the field labels, choose the labels placement and how required fields are marked, set a minimum or maximum length for text fields, use placeholders and decide what message to display when an error occurs. You can add customized text above and below the form, you can choose a template based on your tastes or you are free to create and use a personal template for your contact form, you can add your own customized JavaScript code or CSS stylesheet.

= Ready to use =

It comes with the SMTP option for outgoing email in order to be immediately ready to use. This feature makes it less likely that email sent out from your website being marked as spam and lowers the risk of email getting lost somewhere.

= Clean design =

We love clean and minimalist design, and for this reason we provide a contact form that is both simple and appealing.

= Designed thinking about user experience =

It is lightweight and responsive plugin. SimpleForm does not interfere with your site performance. The submission via Ajax, on backend too, allows a seamless user experience without page refreshes. You can show users a success message or redirect them elsewhere after they complete the form. You can also send a confirmation email to thank who contact you.

https://www.youtube.com/watch?v=EbZDvaLnejo&rel=0

**What SimpleForm is not for now:**

There is still much to be done! For now, you cannot add new fields or create multiple forms. Anti-spam options are limited to question/response fields and honeypot fields.

For complete information, please visit the [SimpleForm website](https://wpsform.com/).

== Installation ==

Activating the SimpleForm plugin is just like any other plugin.

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for ‘SimpleForm'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select simpleform.zip from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download simpleform.zip
2. Extract the simpleform directory to your computer
3. Upload the simpleform directory to the /wp-content/plugins/ directory
4. Activate the plugin in the Plugin dashboard

= And once activated ? =

You will find the new menu ‘Contacts’ to administration dashboard. Take the time to configure SimpleForm and open the 'Settings' page listed below the new menu just added, make the changes desired, then click the 'Save changes' button at the bottom. Now, you're able to add contact form to your website.

== Frequently Asked Questions ==

= Who should use SimpleForm? =

Anyone who needs only what is strictly necessary. SimpleForm is designed for who is looking for a minimalist, friendly and fully controllable contact form.

= Which form fields can be used? =

The standard fields that come with SimpleForm are a name field, a lastname field, an email address field, a phone number field, a subject field, a message field and a consent checkbox field.

= Does SimpleForm include spam protection? =

Of course, it includes by default two honeypot fields, an invisible spam protection to trick spambots into revealing themselves, and also allows you to enable an optional math captcha field which requires human interaction. Google reCAPTCHA and Akismet are not yet supported.

= Does SimpleForm meet the GDPR conditions? = 

Yes, if you’re collecting personal data you can enable a required checkbox for requesting the user explicit consent.

= Why am I not receive messages when users submit form? =

You need to enable a SMTP server. You can install a dedicated plugin that takes care of outgoing email or you can enable our SMTP option in the settings page. If you have already done, verify the correct SMTP server configuration and always keep the notification email option enabled. 

= Where can I check the submissions of my form? =

SimpleForm doesn’t store submitted messages into the WordPress database by default. You can easily add this feature with [SimpleForm Contact Form Submissions](https://wordpress.org/plugins/simpleform-contact-form-submissions/) addon. Without it, only last message is being temporarily stored. Therefore, it is recommended to verify the correct SMTP server configuration in case of use, and always keep the notification email enabled if you want to be sure to receive messages.

= Is SimpleForm translation ready? =

Yes, SimpleForm is ready to be translated in other languages. If you’re a polyglot, help out by translating it into your own language!

= Can I change text direction? =

Yes, you can change text direction from left to right to right to left.

= Where can I get support? =

We provide free support on the WordPress.org plugin repository. Please log into your account. Click on 'Support' and in the 'Search this forum' field type a keyword about the issue you're experiencing. Read topics that are similar to your issue to see if the topic has been resolved previously. If your issue remains after reading past topics, please create a new topic and fill out the form. Before use the support channel, please have a look at our [FAQ section](https://wpsform.com/faq/) as it may help you to find the answer immediately.

== Screenshots ==

1. Submissions page
2. Edit form page
3. Settings page
4. Messages tab
5. Emails tab
6. SMTP server configuration
7. Notification email settings
8. Confirmation email settings
9. Default form template
10. Bootstrap form template
11. Form failed validation

== Changelog ==

= 1.7 (1 June 2020) =
* Fixed: No text will be displayed above the form if nothing is entered in the form description option
* Fixed: Incorrect displaying of error messages when field minimum length option is used
* Fixed: Undefined index errors
* Fixed: Typo errors
* Changed: Minor issues in code
* Added: Option for labels position
* Added: Option for using a word to mark required fields
* Added: Option for right-to-left text direction
* Added: Option for disable html5 form validation
* Added: Option for using a customized JavaScript code

= 1.6.1 (10 May 2020) =
* Fixed: Installation error during new site creation on WordPress Multisite Network
* Fixed: Dynamic SQL Query statements
* Fixed: Minor issues in code and localization
* Added: Pre-built pages for contact form and thank you message
* Added: Pages in draft status will be shown in selecting the confirmation message page

= 1.6 (14 April 2020) =
* Fixed: Screen options button opening error
* Fixed: Minor issues in code
* Added: Option for add a minimum length to text fields
* Added: Option for add a maximum length to text fields

= 1.5.1 (6 April 2020) =
* Fixed: Unexpected error during plugin activation
* Fixed: Display of errors when form submission is not executed via AJAX

= 1.5 (1 April 2020) =
* Fixed: Minor issues in code
* Added: Field for Lastname
* Added: Field for Phone

= 1.4 (14 March 2020) =
* Fixed: Name validation error when name field is not required
* Fixed: Dynamic SQL Query issues
* Added: Option for hiding asterisk in required fields
* Added: Option for hiding labels
* Added: Option for placeholders

= 1.3.2 (29 February 2020) =
* Fixed: Sanitization of a variable not properly used inside JavaScript script
* Added: New Bootstrap contact form template

= 1.3.1 (21 February 2020) =
* Fixed: HTML5 validation error when form submission is executed via AJAX
* Fixed: Captcha field styling issues
* Changed: JavaScript code optimization
* Changed: readme.txt file content

= 1.3 (11 February 2020) =
* Added: HTML5 form validation
* Added: Option for using a basic Bootstrap form template
* Added: Option for disabling the default stylesheet
* Added: Bootstrap markup in contact form template
* Changed: Form template code for quick and easy customization
* Changed: PHP regular expressions to validate form fields
* Changed: JavaScript code for input validation
* Fixed: Admin notices in submissions page
* Fixed: Typo errors

= 1.2 (15 January 2020) =
* Added: Option for using a customized form template
* Added: Compatibility with WordPress Multisite Network
* Added: Compatibility with addon for submitted messages storing
* Fixed: public scripts and styles issues

= 1.1 (21 December 2019) =
* Added: Option for adding text above the form
* Added: Option for adding text below the form
* Fixed: Form fields styling issues
* Fixed: Typo errors

= 1.0.1 (9 December 2019) =
* Changed: readme.txt file content
* Fixed: Form fields styling issues
* Fixed: Italian translation errors

= 1.0 (1 December 2019) =
* Initial release

== Upgrade Notice ==

= 1.0 =
Just released into the WP plugin repository.

== SimpleForm Demo ==

Find out how SimpleForm works, try our [Demo](https://wpsform.com/demo/).

== What feature do you wish SimpleForm had? ==

SimpleForm already contains many options for being a basic contact form, but there are many other features it lacks. Go to the [support forum](https://wordpress.org/support/plugin/simpleform/) and create a new topic with your ideas! We’ll do our best to include the missing features in next releases.

== Translations ==
 
* English
* Italian

= Integrations =

* <a href="https://wordpress.org/plugins/simpleform-contact-form-submissions/">SimpleForm Contact Form Submissions</a> - Database for SimpleForm. You are no longer need to worry about losing important messages, since each new form submission will be stored in your WordPress database!