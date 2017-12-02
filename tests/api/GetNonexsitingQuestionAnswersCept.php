<?php
$I = new ApiTester($scenario);
$I->wantTo('Get answers for non-existing question');
$nonExistingUuid = Ramsey\Uuid\Uuid::uuid4()->toString();
$I->sendGET(sprintf('/questions/%s', $nonExistingUuid));
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::NOT_FOUND);
$I->seeResponseContains('"code":404');
