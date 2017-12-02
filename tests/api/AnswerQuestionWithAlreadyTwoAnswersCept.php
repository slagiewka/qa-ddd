<?php 
$I = new ApiTester($scenario);
$I->wantTo('answer a question that already has two answers and get an error');
$questionUuid = 'd8ea734c-afb8-4ba1-9159-1d4aad12fc67';
$I->sendPOST(sprintf('/questions/%s/answers', $questionUuid), ['content' => 'Sample answer, does not matter.']);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
$I->seeResponseIsJson();
$I->seeResponseEquals('{"errors":{"question":["Answering is possible only for questions with less than 2 answers."]}}');
