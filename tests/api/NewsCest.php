<?php

namespace Gewaer\Tests\api;

use ApiTester;
use Phalcon\Security\Random;

class NewsCest
{


    /**
     * List of all news.
     *
     * @param ApiTester $I
     * @return void
     */
    public function listNews(ApiTester $I): void
    {
        $userData = $I->apiLogin();
        $I->haveHttpHeader('Authorization', $userData->token);
        $I->sendGet('/v1/' . 'news');
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
    public function CreateNews(ApiTester $I): void
    {
        $userData = $I->apiLogin();
        $random = new Random();
        $testTitle = 'test_title__' . $random->base58();
        $testContent = 'test_content__' . $random->base58();

        $I->haveHttpHeader('Authorization', $userData->token);
        $I->sendPost('/v1/' . 'news', [
            'title' => $testTitle,
            'content' => $testContent,
            'author_id' => 9,
            'categories' => [1, 2, 7, 8]
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
    public function getNewsDetail(ApiTester $I): void
    {
        $userData = $I->apiLogin();
        $random = new Random(0, 10);

        $I->haveHttpHeader('Authorization', $userData->token);
        $I->sendGet('/v1/' . 'news/1');
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
    public function editNews(ApiTester $I): void
    {
        $userData = $I->apiLogin();
        $random = new Random(0, 10);
        $testTitle = 'test_title__' . $random->base58();
        $testContent = 'test_content__' . $random->base58();

        $I->haveHttpHeader('Authorization', $userData->token);
        $I->sendPut('/v1/' . 'news/1', [
            'title' => $testTitle,
            'content' => $testContent,
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
    public function removeNews(ApiTester $I): void
    {
        $userData = $I->apiLogin();

        $I->haveHttpHeader('Authorization', $userData->token);
        $I->sendDelete('/v1/' . 'news/1');
        $I->seeResponseIsSuccessful();
        // $response = $I->grabResponse();
        // $data = json_decode($response, true);

        // $I->assertTrue($data['msg'] == 'User Device Associated');
    }
}
