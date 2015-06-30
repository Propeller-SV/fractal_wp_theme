<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Verify that Career page is fully loaded');

// local homepage url
$homepage = "/PSV-WP/";
$I->amOnpage($homepage);
$I->see('Career');
$I->click(['link' => 'Career']);
$I->seeCurrentUrlEquals($homepage . 'career/' );
$I->see('', '.career');
$I->see('Contact us');