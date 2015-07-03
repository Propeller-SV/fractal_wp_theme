<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Check contact form is working');

// local homepage url
$homepage = "/PSV-WP/";
$I->amOnpage($homepage);
$I->see('Contact Us');
$I->fillField(['name' => 'cf-name'], 'User 1');
$I->fillField(['name' => 'cf-email'], '123@example.com');
$I->fillField(['name' => 'cf-phone'], '380505555555');
$I->fillField(['name' => 'cf-message'], 'Here should be a message');
$I->click(['name' => 'cf-submitted']);
$I->see('Thanks for contacting us, expect a response soon.');
// $I->acceptPopup;
