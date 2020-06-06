=== ACF Form Widget for Elementor ===
Contributors: shabti
Tags: elementor, acf, acf form, frontend editing, acf elementor intergration
Requires at least: 4.6
Tested up to: 5.4.0
Stable tag: Stable
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

An ACF and Elementor extension that allows you to easily display ACF frontend forms for your users in the Elementor Editor so your users can edit content by themselves from the frontend.

== Description ==

An ACF and Elementor extension that allows you to easily display ACF frontend forms for your users in the Elementor Editor so your users can edit content by themselves from the frontend. 

This plugin needs to have both Elementor and Advanced Custom Fields installed and activated. You can create awesome forms in ACF which save custom meta data to pages, posts, users, and more. Then use this widget in Elementor to easily display the form for your users. This way you can pick and choose the data which you need them to be able to edit.  

So, what can this plugin do for you?

== FREE Features ==

1. No Coding Required
Give the end user the best content managment experience without having to open the ACF or Elementor documentations. It’s all ready to go right here. 

2. Edit Posts 
Let your users edit posts from the frontend of their site without having to access the WordPress dashboard. 

3. Add Posts 
Let your users publish new posts from the frontend using the “new post” action

4. Edit User Profile
Allow users to edit their user data easily from the frontend.

5. User Registration Form
Allow new users to register to your site with a built in user registration form! You can even hide the WordPress dashboard from these new users.

6. Hide Admin Area 
Pick and chose which users have acess to the WordPress admin area.

7. Configure Permissions
Choose who sees your form based on user role or by specific users.

8. Modal Popup 
Display the form in a modal window that opens when clicking a button so that it won’t take up any space on your pages.


== PRO Features ==

1. Edit Global Options 
If you have global data – like header and footer data – you can create an options page using ACF and let your users edit from the frontend. (Option to add options pages without coding coming soon)

2. Limit Submits
Prevent all or specific users from submitting the form more than a number of times.

3. User Role Field 
Allow users to choose a role when editing their profile or registering.

4. Send Emails
Set emails to be sent and map the ACF form data to display in the email fields such as the email address, the from address, subject, and message. 

5. Style Tab
Use Elementor to style the form and as well the buttons. (Modal window styling coming soon)

6. Multi Step Forms 
Make your forms more engaging by adding multiple steps.

7. Woocommerce Intergration
Easily add Woocomerce products from the frontend. Add products to the user's cart upon form submission.

8. Stripe Payments (Coming soon) 
Accept payments through Stripe upon form submission. 
 

Purchase your copy here at the official website: [ACF Frontend website](https://www.frontendform.com/)


== Useful Links ==
Appreciate what we're doing? Want to stay updated with new features? Give us a like and follow us on our facebook page: 
[ACF Frontend Facebook page](https://www.facebook.com/acffrontend/)

The Pro version has even more cool features. Check it out at the official website:
[ACF Frontend website](https://www.frontendform.com/)

Need an Elementor and WordPress proffesional for a project? Check out our website:
[Kaplan Web Development website](https://www.kaplanwebdev.com/)

Check out our other plugin, which let's you dynamically query your posts more easily: 
[Advanced Post Queries for Elementor](https://wordpress.org/plugins/advanced-post-queries/)

Check out Elementor Pro. We highly recommend pro for anyone who is looking to get more out of WordPress and Elementor:
[Elementor Pro](https://elementor.com/pricing/)

Now is the time to buy ACF Pro before they take up the prices and no longer provide lifetime licences:
[Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/)

== Installation ==

1. Make sure both Elementor and ACF are installed and activated. This plugin will not do anything without both of them. 
2. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
3. Activate the plugin through the 'Plugins' screen in WordPress
4. Create an ACF field group. It can be either active or not, it doesn't matter. 
5. Jump into the Elementor editor and search for "ACF frontend form" 
6. Choose the desired ACF field group or leave as is for the current post's default field group. You may also choose specific fields.
7. Configure the permisions, display, and form actions as you please.
8. Now you should an acf form on the frontend for editing a post, adding a post, or editing a user.


== Tutorials ==  

= Add and Edit a Real Estate Listing =
https://www.youtube.com/watch?v=iHx7krTqRN0

= Frontend Posting =
https://www.youtube.com/watch?v=lMkZzOVVra8&t=7s

== Frequently Asked Questions ==

= Can I send emails through this form? =

You can use a ACF "action hook" to send emails when this form is registered. See <a href="https://www.advancedcustomfields.com/resources/using-acf_form-to-create-a-new-post/"> here </a> for reference.

If you purchase our pro version, you will be able to configure this from the widget without any code. You will be able to send any number of emails upon form submission. 

= Can I add Featured Image field to the form? =

Yes. Simply open the post tab and turn on "Featured Image". 

If you want more control over the label and field settings, simply add an image field in your ACF field group and set the field name to “_thumbnail_id” with an underscore before each word. 

= Can I let users set post categories through this form? =

Yes. Add a taxonomy field in your ACF field group and set "save terms" and "load terms" to yes. 


== Screenshots ==

1. This is the basic usage. The form displays the post's default ACF field groups. In our case, this post has no ACF field groups so it displays just the title by default. The form is visible by default only to administrators and will edit the current post/page. 
2. In this screenshot, we changed the form title to Business Information, we removed the title field and chose an ACF field group named "FrontEnd Form" to display. 
3. Here we configured the permissions. We left the default administrator role and we added a dynamic option that let's you choose a meta field that gives an id of any given user who should see this. In this case we used "[author]" which allows the author of the post to see it.
4. In the form actions, we left the main form action as "edit post" and we chose to edit a specific post. We left the rest of the option default, but we turned on the delete button so that our users have the option to delete the post if they so wish.

== Changelog ==
 
= 2.3.27 =
* Fixed error with site tagline field

= 2.3.26 =
* Added Happy files integration to ACF file field, image field, and gallery field.
* Added custom "product images" field on frontend for Woocommerce users
* Added custom "product sale price" field on frontend for Woocommerce users
* Added option to edit a post based on a URL query
* Fixed issue with "title structure" option on new submissions
* Fixed issue that was creating two users during the multi step form

= 2.3.23 =
* Added option to exclude field from field groups selection for faster setup
* Added option to add default field groups faster setup

= 2.3.22 
* Fixed product categories field was loading WP categories
* Custom title structure was not saving on initial submission

= 2.3.21 =
* Tweak: Added automatic login option to registration form
* Added custom structure to title field
* Added custom post slug option for posts
* Added custom product price option to number fields
* Added New Product and Edit Product actions in pro. Woocommerce integration phase one.
* Fixed edit user action to be able to choose whether or not to require passwords
* Fixed validation error on default fields
* Fixed Site Title field not saving

= 2.3.20 =
* Fixed ACF tabs not working

= 2.3.19 =
* Fixed multi step previous button, which was activating the field validations
* Fixed confirm password bug not validating properly

= 2.3.17 =
* Fixed multi step tabs not showing properly on vertical align

= 2.3.16 =
* Fixed error of post titls not saving as slug for CPT
* Fixed error of not saving username

= 2.3.15 =
* Fixed error: Custom Post data fields were loading and saving the wrong data

= 2.3.14 = 
* Fixed error in multi form

= 2.3.13 = 
* Added options to default fields
* Removed custom post and user field selection from the widget settings
* Fixed some JS errors

= 2.3.7 = 
* Added Stripe action
* Added a Delete Post Button widget
* Added option to remove border between fields
* Optimized the assets to load only where needed

= 2.3.6 = 
* Fix: There was a bug on the edit user action that we squashed
* Tweak: Added Custom Labels for the built in user fields

= 2.3.5 = 
* Added Tabs Position option: side or top
* Added multi step tabs navigation to preview
* Emails in multi step form were sending in first step even when not specified
* Email user shorcodes fixed

= 2.3.1 = 
* Important: Changed the email shortcodes to be written without a underscore before it. For example: 'post_title' instead of '_post_title'
* Important: Changed the default site option fields to be deactivated by default. Activate them in the options tab if they are needed 
* Fix: multi step forms were not saving new posts properly 
* Tweak: Added validation to username to block illegal characters 
* Tweak: Added option to force strong password and confirm
* Tweak: Repositioned the save draft button and added styling options for it
* Tweak: Added email shortcode support for featured image and post url as well as fields with multiple values
* Tweak: Added option to show custom content or nothing for reached limit
* Coming soon: Stripe
* Coming soon: Woocomerce


= 2.2.15 = 
* Fix: multi step forms not showing some of the default user fields and not submitting to next step

= 2.2.14 = 
* Fix: Multi forms and custom labels were not working together
* Fix: Messages were always on edit screen

= 2.2.13 =  
* Fixed the Elementor select controls in the widget to comply with Elementor 2.9
* Fixed conflict with free Elementor version caused by autocomplete controls by replacing them with text field for inserting post, user, and term ids for Elementor free version only
* Fixed bug in query which was showing all drafts in the draft selection


= 2.2.12 = 
* Tweak: Added custom label options to default post fields so that you don't need to create a whole ACF field just to change the label. Available for post actions in free version and for edit options action in pro. Coming soon for user actions.
* Fix: fixed bug that was saving posts as drafts when save as draft was turned off
* Fix: fixed bug that was preventing saved drafts from showing when adding a post of a custom type

= 2.2.11 = 
* Fixed bug preventing featured images from saving on certain custom post types since 2.2.10
* Removed default ACF options page. Will return as option in 2.3
* Tweak: limited drafts shown in new post form to those submitted by author
* Tweak: fixed the save progress toggle to always show before submit button

= 2.2.10 = 
* Please note: Changed "set as title field" in ACF text field settings to save data from admin dashboard as well as frontend
* Please note: Changed "set as content field" in ACF wysiwig and textarea field settings to save data from admin dashboard as well as frontend
* Please note: Changed "set as excerpt field" in ACF textarea field settings to save data from admin dashboard as well as frontend
* Added a plugin admin page
* Optimized the widget in the Elementor editor by loading posts, users, and terms selections' values with autocomplete
* Added option to let users save a draft on new post action
* Added option to let users edit saved draft on new post action
* Added ACF options to allow you to create custom featured image field and to create read-only text fields
* Added default site option fields to allow users to edit site title, tagline, and logo in pro
* Added popover for email shortcodes in the editor in pro

= 2.2.9 = 
* Added default user fields: First Name, Last Name, and Biography
* Fixed bug in ACF settings when switching field type
* Fixed a bug with the ACF field selections
* Added option to create new post with many steps
* Added styles for steps in pro
* Added styles for ACF icons in pro
* Added more options to multi step in pro
 
= 2.2.8 = 
Changed required mark to show by default
* Fixed bug preventing the form from showing when "all users" is chosen in the permissions tab
* Fixed bug preventing field group names from showing in fields selection

= 2.2.7 = 
* Added hook that hides all default ACF Frontend fields from dynamic tags
Returned option to hide admin area to backend user forms
* Fixed permissions bug preventing form from appearing when first added

= 2.2.6 = 
* Fixed error with ACF image fields

= 2.2.5 = 
* Fixed bug in the logged in users setting in the permissions tab

= 2.2.4 = 
* Added tags setting to post actions
* Added post status setting to edit post action

= 2.2.3 = 
* Added default post categories and tags fields
* Added label display options
* Added styles for modal window, messages, fields, labels, and add more buttons in pro

= 2.2.2 = 
* Fixed error in dynamic selection setting in permissions tab

= 2.2.1 = 
* Added Freemius opt-in so that we can use shared data to make this plugin freaking awesome!
* Added promos for pro features.
* Added user auto-populate options and local ACF avatar




== Upgrade Notice ==





