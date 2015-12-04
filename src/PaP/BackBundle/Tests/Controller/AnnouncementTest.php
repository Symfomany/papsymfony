<?php
namespace PaP\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


/**
 * Class AnnouncementControllerTest
 * @package PaP\FrontBundle\Tests\Controller
 */
class AnnouncementControllerTest extends WebTestCase
{
    /**
     * @var container
     */
    protected $container;

    /**
     * @var null $client
     */
    private $client = null;


    /**
     * constructor
     */
    public function __construct()
    {
        $kernel = new \AppKernel("test", true);
        $kernel->boot();
        $this->_container = $kernel->getContainer();
        parent::__construct();
    }

    /**
     * Setup
     */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/back'); //access back
        $crawler = $client->followRedirect();
        $this->assertRegExp('/\/login$/', $client->getRequest()->getUri());

        $this->assertTrue($crawler->filter('html:contains("Username")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Password")')->count() > 0);
        $form = $crawler->selectButton('Sign In')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'toto';
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertRegExp('/\/login$/', $client->getRequest()->getUri());

        $form = $crawler->selectButton('Sign In')->form();
        $client->submit($form);
        $crawler = $client->followRedirect();


        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertRegExp('/\/back/', $client->getRequest()->getUri());
        dump($client->getRequest()->getUri());

    }



    public function testLogout(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign In')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertRegExp('/\/back/', $client->getRequest()->getUri());

        $crawler = $client->followRedirect();
        $this->assertRegExp('/\/back/', $client->getRequest()->getUri());
        $client->request('GET', '/back');
        $crawler = $client->followRedirect();



        $this->assertTrue($crawler->filter('html:contains("Dashboard")')->count() > 0);

//        $link = $crawler
//            ->filter('a.logout')
//            ->eq(1)
//            ->link();
//        $client->click($link);
//        $crawler = $client->followRedirect();
//        $this->assertRegExp('/\/login$/', $client->getRequest()->getUri());


    }
}
