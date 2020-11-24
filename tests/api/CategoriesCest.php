<?php

namespace Gewaer\Tests\api;

use ApiTester;
use Phalcon\Security\Random;

class CategoriesCest
{


    /**
     * List of all news.
     *
     * @param ApiTester $I
     * @return void
     */
    public function listCategories(ApiTester $I): void
    {
        $userData = $I->apiLogin();
        $I->haveHttpHeader('Authorization', $userData->token);
        $I->sendGet('/v1/' . 'categories');
        $I->seeResponseIsSuccessful();
        $I->seeResponseIsJson();
        // $response = $I->grabResponse();
        // $data = json_decode($response, true);

        // $I->assertTrue($I);
    }

    /**
     * Insert a news.
     *
     * @param ApiTester $I
     * @return void
     */
    public function CreateCategory(ApiTester $I): void
    {
        $userData = $I->apiLogin();
        $random = new Random();
        $testCategory = 'test_category__' . $random->base58();

        $I->haveHttpHeader('Authorization', $userData->token);
        $I->sendPost('/v1/' . 'categories', [
            'category_name' => $testCategory,
        ]);
        $I->seeResponseIsSuccessful();
        // $response = $I->grabResponse();
        // $data = json_decode($response, true);

        // $I->assertTrue($data['msg'] == 'User Device Associated');
    }

    /**
     * Get news detail.
     *
     * @param ApiTester $I
     * @return void
     */
    public function getCategoriesDetail(ApiTester $I): void
    {
        $userData = $I->apiLogin();
        $random = new Random(0, 10);

        $I->haveHttpHeader('Authorization', $userData->token);
        $I->sendGet('/v1/' . 'categories/1');
        $I->seeResponseIsSuccessful();
        // $response = $I->grabResponse();
        // $data = json_decode($response, true);

        // $I->assertTrue($data['msg'] == 'User Device Associated');
    }

    /**
     * Get news detail.
     *
     * @param ApiTester $I
     * @return void
     */
    public function editCategory(ApiTester $I): void
    {
        $userData = $I->apiLogin();
        $random = new Random(0, 10);
        $testCategory = 'test_category__' . $random->base58();

        $I->haveHttpHeader('Authorization', $userData->token);
        $I->sendPut('/v1/' . 'categories/1', [
            'category_name' => $testCategory,
        ]);
        $I->seeResponseIsSuccessful();
        // $response = $I->grabResponse();
        // $data = json_decode($response, true);

        // $I->assertTrue($data['msg'] == 'User Device Associated');
    }


    /**
     * Get news detail.
     *
     * @param ApiTester $I
     * @return void
     */
    public function removeCategory(ApiTester $I): void
    {
        $userData = $I->apiLogin();

        $I->haveHttpHeader('Authorization', $userData->token);
        $I->sendDelete('/v1/' . 'categories/1');
        $I->seeResponseIsSuccessful();
        // $response = $I->grabResponse();
        // $data = json_decode($response, true);

        // $I->assertTrue($data['msg'] == 'User Device Associated');
    }
}
