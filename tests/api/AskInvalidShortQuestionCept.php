<?php
$I = new ApiTester($scenario);
$I->wantTo('ask a question with too short content');
$answer = 'Exactly 19 characte';
$I->sendPOST('/questions', ['content' => $answer]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
$I->seeResponseEquals('{"errors":{"content":["This value is too short. It should have 20 characters or more."]}}');
