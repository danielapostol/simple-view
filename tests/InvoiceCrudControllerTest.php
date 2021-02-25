<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InvoiceCrudControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function checkIfInvoiceControllerExistsAndHasProperHeading(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin');
        $client->followRedirect();


        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Invoices');

    }
}
