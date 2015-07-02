<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Edit the CareerPage');

// local homepage url
$homepage = "/PSV-WP/";
$I->amOnpage($homepage . "wp-admin");
$I->fillField('Username', 'admin');
$I->fillField('Password', '072534');
$I->click('Log In');
$I->seeCurrentUrlEquals($homepage . "wp-admin/");
$I->see('Pages');
$I->click('Pages');
$I->click(['link' => 'Career']);
$I->click('Add Point');
$I->fillField(['name' => 'main_points[point][]'], 'codeception is very usefull');
$I->click(['id' => 'publish']);
$I->see('Page Updated', 'p');
$I->click('View page');
$I->see('codeception is very usefull');
$I->click('Edit Page');
$I->click('Remove Point');
$I->click(['id' => 'publish']);
$I->see('Page Updated', 'p');
$I->click('View page');
$I->dontSee('codeception is very usefull');