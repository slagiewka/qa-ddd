<?php 
$I = new ApiTester($scenario);
$question = 'Who was the first king of Poland?';
$I->wantTo('Ask a question');
$I->sendPOST('/questions', ['content' => $question]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$questionResponse = json_decode($I->grabResponse());
$I->sendGET(sprintf('/questions/%s', $questionResponse->id));
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains(sprintf('"id":"%s"', $questionResponse->id));
$I->seeResponseContains(sprintf('"content":"%s"', $question));
