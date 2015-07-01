<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Edit the HomePage');

// local homepage url
$homepage = "/PSV-WP/";
$I->amOnpage($homepage . "wp-admin");
$I->fillField('Username', 'admin');
$I->fillField('Password', '072534');
$I->click('Log In');
$I->seeCurrentUrlEquals($homepage . "wp-admin/");
$I->see('Pages');
$I->click('Pages');
$I->click(['link' => 'Home']);
$I->click('Add Field');
$I->fillField(['name' => 'gallery[image_url][]'], 'http://localhost/PSV-WP/wp-content/uploads/2015/05/layer-1.png');
$I->fillField(['name' => 'gallery[image_desc][]'], 'http://apple.com');
$I->click(['id' => 'publish']);
$I->see('Page Updated', 'p');
$I->click('View page');
