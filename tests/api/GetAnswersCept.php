<?php 
$I = new ApiTester($scenario);
$I->wantTo('get all answers.');
$I->sendGET('/answers');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseEquals('[{"content":"First King of Poland was Mieszko I of Poland.","id":"4a0508d2-4b6b-4bbb-a08c-40d5d7855ce8","questionId":"d8ea734c-afb8-4ba1-9159-1d4aad12fc67","createdAt":1512146844},{"content":"How would I know that?","id":"6ccf3511-537b-4cbd-81e8-27663a75cf8d","questionId":"1f357818-38e1-43e4-89ea-c90ed901d90a","createdAt":1512183846},{"content":"No idea, have you tried Google?","id":"72bff6d1-fc9a-443a-9cf5-3ae9ff8fc60d","questionId":"d8ea734c-afb8-4ba1-9159-1d4aad12fc67","createdAt":1512145466}]');
