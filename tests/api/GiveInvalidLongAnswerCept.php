<?php
$I = new ApiTester($scenario);
$I->wantTo('answer a question with too long content');
$uuid = '26afabba-f72b-42cb-a745-22faab2df67f';
$answer = <<<EOF
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and one characterFive thousand and one characterFive thousand and one character
Five thousand and o
EOF;

$I->sendPOST(sprintf('/questions/%s/answers', $uuid), ['content' => $answer]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
$I->seeResponseEquals('{"errors":{"content":["This value is too long. It should have 5000 characters or less."]}}');
