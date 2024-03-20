<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testNew()
    {
        $client = static::createClient();

        $data = [
            'email' => 'test@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];

        $client->request('POST', '/users', [], [], [], json_encode($data));

        $this->assertResponseIsSuccessful();

        $this->assertJson($client->getResponse()->getContent());
        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertSame('User created successfully', $responseData['message']);
    }

    public function testNewWithInvalidData()
    {
        $client = static::createClient();

        // Invalid data: missing 'email' field
        $invalidData = [
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];

        $client->request('POST', '/users', [], [], [], json_encode($invalidData));

        // Assert that the response status code is 400 (Bad Request)
        $this->assertSame(400, $client->getResponse()->getStatusCode());

        // Assert that the response contains JSON with the expected error message
        $this->assertJson($client->getResponse()->getContent());
        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('error', $responseData);
        $this->assertSame('Invalid data provided', $responseData['error']);
    }
}