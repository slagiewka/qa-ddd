<?php
$I = new ApiTester($scenario);
$I->wantTo('ask a question with too long content');
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

$I->sendPOST('/questions', ['content' => $answer]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
$I->seeResponseEquals('{"errors":{"content":["This value is too long. It should have 5000 characters or less."]}}');
