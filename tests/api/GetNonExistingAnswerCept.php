<?php
$I = new ApiTester($scenario);
$I->wantTo('get single answer of non-existing UUID.');
$uuid = Ramsey\Uuid\Uuid::uuid4();
$I->sendGET(sprintf('/answers/%s', $uuid->toString()));
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::NOT_FOUND);
$I->seeResponseIsJson();
$I->seeResponseContains('"code":404');
