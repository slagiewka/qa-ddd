<?php
$I = new ApiTester($scenario);
$I->wantTo('get question answers while using invalid ID format and get an error');
$I->sendGET('/questions/invalid/answers');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
$I->seeResponseIsJson();
$I->seeResponseEquals('{"code":400,"message":"Invalid UUID string: invalid"}');
