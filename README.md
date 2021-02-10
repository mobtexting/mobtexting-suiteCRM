# MOBtexting SMS API Module Plugin For Suite CRM #

## Step 0 - Make sure this is for you ##

First [download the install kit](https://github.com/mobtexting/mobtexting-suiteCRM/archive/mainmaster.zip) and test if this code works for you.

## Step 1 - Creating the zip package ##

select all the files and create an archive.
When viewing the archive contents, `manifest.php` and the other folders need to be directly visible (no other folders in between). Do NOT archive the `root` folder itself.Module installer reference [visit steps](https://docs.suitecrm.com/developer/module-installer/) 

## Suite CRM Steps: ##
	
1) Suite CRM is available as both Open Source so [download](https://suitecrm.com/download/) it first and install.

2) After installed, Navigate to SuiteCRM `Module Loader` located in SuiteCRM Admin Panel.

  	<img src="/images/image.jpg" >
3) Upload 'MOBtexting` addon zip file and hit Install button to install addon in the system. It will take a couple minutes to install.

	<img src="/images/image1.jpg">
	<img src="/images/image2.jpg">


4) Navigate to `Admin` panel full down we can see `MOBtexting SMS Configuration` open and config `MOBtexting API` setting after save it.

	<img src="/images/image7.jpg">
	<img src="/images/image8.png">

	
5) Now you can see Module’s ['Accounts','Contacts','Cases','Leads','Meetings'] ListView with sms icon click and send message.

6) This is `Contact Template Configuration` for whenever create new contact this template message will send automatic.
	<img src="/images/image5.jpg">
  
   Like `Lead Template Configuration`
   	<img src="/images/image6.jpg">
    
# Security #
  If you discover any security related issues, please email (support@mobtexting.com) instead of using the issue tracker.

# Contributing #
  Please see [CONTRIBUTING](https://github.com/mobtexting/message-php/blob/master/CONTRIBUTING.md) for details.

# License #
 The MIT License (MIT). Please see License File for more information.


