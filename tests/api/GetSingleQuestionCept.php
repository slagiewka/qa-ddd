<?php
$I = new ApiTester($scenario);
$I->wantTo('Get single question with UUID d8ea734c-afb8-4ba1-9159-1d4aad12fc67');
$I->sendGET('/questions/d8ea734c-afb8-4ba1-9159-1d4aad12fc67');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseEquals('{"content":"Who was the first King of Poland?","id":"d8ea734c-afb8-4ba1-9159-1d4aad12fc67","createdAt":1512145071,"answers":[{"content":"First King of Poland was Mieszko I of Poland.","id":"4a0508d2-4b6b-4bbb-a08c-40d5d7855ce8","createdAt":1512146844},{"content":"No idea, have you tried Google?","id":"72bff6d1-fc9a-443a-9cf5-3ae9ff8fc60d","createdAt":1512145466}]}');
