<?php 
$I = new ApiTester($scenario);
$uuid = '26afabba-f72b-42cb-a745-22faab2df67f';
$answer = 'No one can actually tell';
$I->wantTo('answer a given question with UUID 26afabba-f72b-42cb-a745-22faab2df67f');
$I->sendGET(sprintf('/questions/%s/answers', $uuid));
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseEquals('[]');
$I->sendPOST(
    sprintf('/questions/%s/answers', $uuid),
    ['content' => $answer]
);
$answerResponse = json_decode($I->grabResponse());
$I->sendGET(sprintf('/questions/%s/answers', $uuid));
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains(sprintf('"id":"%s"', $answerResponse->id));
$I->seeResponseContains(sprintf('"content":"%s"', $answer));
