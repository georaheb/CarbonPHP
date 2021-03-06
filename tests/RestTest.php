<?php
/**
 * Created by IntelliJ IDEA.
 * User: rmiles
 * Date: 6/26/2018
 * Time: 3:21 PM
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use CarbonPHP\Tables\Carbons as Rest;


/**
 * @runTestsInSeparateProcesses
 */
final class RestTest extends TestCase
{
    public $store;
    public $user_id;


    public function setUp() /* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        define('TEST', true);

        $_SERVER = [
            'DOCUMENT_ROOT' => "C:\\Users\\rmiles\\Documents\\GitHub\\CarbonPHP",
            'REMOTE_ADDR' => '::1',
            'REMOTE_PORT' => '53950',
            'SERVER_SOFTWARE' => 'PHP 7.2.3 Development Server',
            'SERVER_PROTOCOL' => 'HTTP/1.1',
            'SERVER_NAME' => 'localhost',
            'SERVER_PORT' => '88',
            'REQUEST_URI' => '/login/',
            'REQUEST_METHOD' => 'GET',
            'SCRIPT_NAME' => '/index.php',
            'SCRIPT_FILENAME' => 'C:\Users\rmiles\Documents\GitHub\Stats.Coach\index.php',
            'PATH_INFO' => '/login/',
            'PHP_SELF' => '/index.php/login/',
            'HTTP_HOST' => 'localhost:88',
            'HTTP_CONNECTION' => 'keep-alive',
            'HTTP_CACHE_CONTROL' => 'max-age=0',
            'HTTP_UPGRADE_INSECURE_REQUESTS' => '1',
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36',
            'HTTP_ACCEPT' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'HTTP_REFERER' => 'http://localhost:88/',
            'HTTP_ACCEPT_ENCODING' => 'gzip, deflate, br',
            'HTTP_ACCEPT_LANGUAGE' => 'en-US,en;q=0.9',
            'HTTP_COOKIE' => 'PHPSESSID=gn4amaq3el5giekaboa29q27gp; _gid=GA1.1.1938536140.1530039320',
            'REQUEST_TIME_FLOAT' => 1530054388.652,
            'REQUEST_TIME' => 1530054388,
        ];

        include_once __DIR__ . './../index.php';
    }


    private function KeyExistsAndRemove(string $key) : void {
        $store = [];
        Rest::Get($store, $key, []);

        if (!empty($store)) {
            $this->assertTrue(
                Rest::Delete($store, $key, []),
                'Rest api failed to remove the test key ' . $key
            );
        }
    }


    public function testRestApiCanPost(): void
    {
        $this->KeyExistsAndRemove('8544e3d581ba11e8942cd89ef3fc55fa');
        $this->KeyExistsAndRemove('8544e3d581ba11e8942cd89ef3fc55fb');

        $store = [];

        if (!empty($store)) {
            $this->assertTrue(
                Rest::Delete($store, $store['entity_pk'], []),
                'Rest api failed to remove the test key.'
            );
        }

        // Should return a unique hex id
        $this->assertInternalType('string', Rest::Post(['entity_pk' => '8544e3d581ba11e8942cd89ef3fc55fa']));
    }

    /**
     * @depends testRestApiCanPost
     */
    public function testRestApiCanGet(): void
    {

        $store = [];
        $this->assertTrue(Rest::Get($store, '8544e3d581ba11e8942cd89ef3fc55fa', []));

        $this->assertInternalType('array', $store);

        if (!empty($store)) {
            $this->assertArrayHasKey('entity_fk', $store);
        }

        $this->assertTrue(Rest::Get($store, null, ['entity_pk' => '8544e3d581ba11e8942cd89ef3fc55fa']));


        // This route redirects to home, thus ending in false
    }

    /**
     * @depends testRestApiCanGet
     */
    public function testRestApiCanPut(): void
    {
        $this->store = [];

        $this->assertTrue(Rest::Get($this->store, '8544e3d581ba11e8942cd89ef3fc55fa', []));

        $this->assertArrayHasKey('entity_fk', $this->store);

        $this->assertTrue(
            Rest::Put($this->store, $this->store['entity_pk'], [
                'entity_pk' => '8544e3d581ba11e8942cd89ef3fc55fb'
            ]));

        $this->assertEquals('8544e3d581ba11e8942cd89ef3fc55fb', $this->store['entity_pk']);

        $this->assertTrue(Rest::Get($this->store, null, [
            'where' => [
                'entity_pk' => '8544e3d581ba11e8942cd89ef3fc55fb'
            ]
        ]));
    }

    /**
     * @depends testRestApiCanPut
     */
    public function testRestApiCanDelete(): void
    {
        $temp = [];

        $this->assertTrue(Rest::Get($temp, null, [
            'where' => ['entity_pk' => '8544e3d581ba11e8942cd89ef3fc55fb'],
            'pagination' => [ 'limit' => 1 ]
        ]));

        $this->assertTrue(array_key_exists('entity_fk', $temp), 'Failed asserting that ' . print_r($temp) . ' has the key \'entity_fk\'.');

        $this->assertTrue(
            Rest::Delete($temp, $temp['entity_pk'], [])
        );

        $this->assertNull($temp);
    }

}