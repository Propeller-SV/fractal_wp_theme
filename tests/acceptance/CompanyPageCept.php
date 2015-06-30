<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Verify that Company page is fully loaded');

// local homepage url
$homepage = "/PSV-WP/";
$I->amOnpage($homepage);
$I->see('Company');
$I->click(['link' => 'Company']);
$I->seeCurrentUrlEquals($homepage . 'company/' );
$I->see('', '.about-us');
$I->see('', '.team');
$I->see('Contact us');
