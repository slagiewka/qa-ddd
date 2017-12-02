<?php 
$I = new ApiTester($scenario);
$I->wantTo('answer a non-existing question and get an error');
$questionUuid = \Ramsey\Uuid\Uuid::uuid4();
$I->sendPOST(sprintf('/questions/%s/answers', $questionUuid), ['content' => 'Sample answer for non-existing question.']);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::NOT_FOUND);
$I->seeResponseIsJson();
$I->seeResponseContains('"code":404');
