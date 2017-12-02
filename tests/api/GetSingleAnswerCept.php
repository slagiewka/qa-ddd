<?php
$I = new ApiTester($scenario);
$I->wantTo('get single answer of UUID 6ccf3511-537b-4cbd-81e8-27663a75cf8d.');
$I->sendGET('/answers/6ccf3511-537b-4cbd-81e8-27663a75cf8d');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseEquals('{"content":"How would I know that?","id":"6ccf3511-537b-4cbd-81e8-27663a75cf8d","questionId":"1f357818-38e1-43e4-89ea-c90ed901d90a","createdAt":1512183846}');
