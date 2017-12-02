<?php
$I = new ApiTester($scenario);
$I->wantTo('answer a question with too short content');
$uuid = '26afabba-f72b-42cb-a745-22faab2df67f';
$answer = 'Exactly 19 characte';
$I->sendPOST(sprintf('/questions/%s/answers', $uuid), ['content' => $answer]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
$I->seeResponseEquals('{"errors":{"content":["This value is too short. It should have 20 characters or more."]}}');
