<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Verify that Blog page is fully loaded');

// local homepage url
$homepage = "/PSV-WP/";
$I->amOnpage($homepage);
$I->see('Blog');
$I->click(['link' => 'Blog']);
$I->seeCurrentUrlEquals($homepage . 'blog/' );
$I->see('Archives');
$I->see('Recent Posts');
$I->see('Subscribe');
$I->see('Popular Posts');
$I->see('Continue Read');
$I->click('Continue Read');
$I->see('You may also like');
$I->see('Contact Us');
