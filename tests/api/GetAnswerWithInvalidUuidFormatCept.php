<?php
$I = new ApiTester($scenario);
$I->wantTo('get single answer of invalid UUID.');
$I->sendGET('/answers/invalid');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
$I->seeResponseIsJson();
$I->seeResponseContains('"code":400');
