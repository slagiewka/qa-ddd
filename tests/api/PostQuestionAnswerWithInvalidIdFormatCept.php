<?php
$I = new ApiTester($scenario);
$I->wantTo('post question answer while using invalid ID format and get an error');
$I->sendPOST('/questions/invalid/answers', ['content' => 'Test content.']);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
$I->seeResponseIsJson();
$I->seeResponseEquals('{"code":400,"message":"Invalid UUID string: invalid"}');
