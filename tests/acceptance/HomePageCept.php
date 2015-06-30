<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Verify that Home page is fully loaded');

// local homepage url
$homepage = "/PSV-WP/";
$I->amOnpage($homepage);
$I->see('about us');
$I->see('customers');
$I->see('contact us');
$I->seeCurrentUrlEquals($homepage);
$I->see('Home', 'a');
$I->see('Software engineering', 'a');
$I->see('Company', 'a');
$I->see('Career', 'a');
$I->see('Blog', 'a');
$I->click(['link' => 'Home']);
$I->seeCurrentUrlEquals($homepage);
$I->see('', '.logo');
$I->click('.logo');
$I->seeCurrentUrlEquals($homepage);