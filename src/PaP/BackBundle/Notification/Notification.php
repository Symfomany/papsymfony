<?php
namespace PaP\BackBundle\Notification;
use SocketIO\Emitter;


/**
 * Handle Notification
 * Class Notfication
 * @package PaP\BackBundle\Notification
 */
class Notfication{

    /**
     * @var \Redis
     */
    protected $redis;


    /**
     * @var \Redis
     */
    protected $emitter;


    /**
     * @param \Redis $redis
     */
    public function __construct(){

        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1', '6379');
        $this->emitter = new Emitter($this->redis);
        $this->user = new Emitter($this->redis);
    }


    /**
     * Emmit a notify
     * @param array $datas
     * @param string $channel
     */
    public function emmity($datas = array(),$channel = "notification"){

        $now = new \DateTime('now');
        $this->emitter->emit($channel, [
            'datas' => $datas,
            'date' => $now->format('Y-m-d H:i:s'),
            'author' => $this->getUser()->getUsername()
        ]);
    }











}


















