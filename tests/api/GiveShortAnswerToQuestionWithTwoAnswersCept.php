<?php 
$I = new ApiTester($scenario);
$I->wantTo('shortly answer a question that already has two answers and get two errors');
$questionUuid = 'd8ea734c-afb8-4ba1-9159-1d4aad12fc67';
$I->sendPOST(sprintf('/questions/%s/answers', $questionUuid), ['content' => 'Too short answer.']);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
$I->seeResponseIsJson();
$I->seeResponseEquals('{"errors":{"content":["This value is too short. It should have 20 characters or more."],"question":["Answering is possible only for questions with less than 2 answers."]}}');
