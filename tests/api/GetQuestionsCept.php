<?php 
$I = new ApiTester($scenario);
$I->wantTo('Get all questions');
$I->sendGET('/questions');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseEquals('[{"content":"What is up New York?","id":"1f357818-38e1-43e4-89ea-c90ed901d90a","createdAt":1512183663},{"content":"What is the purpose of functional tests?","id":"26afabba-f72b-42cb-a745-22faab2df67f","createdAt":1512222479},{"content":"Who was the first King of Poland?","id":"d8ea734c-afb8-4ba1-9159-1d4aad12fc67","createdAt":1512145071}]');
