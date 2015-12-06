<?php
namespace PaP\BackBundle\Listener;


use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use PaP\BackBundle\Document\Notifications;
use PaP\BackBundle\Entity\Announcement;
use SocketIO\Emitter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


/**
 * Class AnnouncementListener
 * @package PaP\BackBundle\Listener
 */
class AnnouncementListener{

    /**
     * @var
     */
    protected $dm;

    /**
     * @var
     */
    protected $security;

    /**
     * @var
     */
    protected $context;

    /**
     * @param DocumentManager $dm
     */
    public function __construct(DocumentManager $dm, TokenStorage $context){
        $this->dm = $dm;

        $this->context = $context;
        $this->security = $context;

    }


    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Announcement) {
            return;
        }

       $this->flushNotification($entity, "Création");

    }


    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();

        if (!$entity instanceof Announcement) {
            return;
        }

        $this->flushNotification($entity, "Mise à jour");
    }


    /**
     * @param LifecycleEventArgs $args
     */
    public function preRemove(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();

        if (!$entity instanceof Announcement) {
            return;
        }

        $this->flushNotification($entity, "Suppression", "danger");
    }

    /**
     * Flush in notification
     */
    protected function flushNotification(Announcement $entity, $title="Nouvelle Action", $criticity="success"){
        $notification = $this->dm->getRepository('BackBundle:Notifications') ->findOneByAid($entity->getId());

        if(!$notification){
            $notification =  new Notifications();
        }

        $notification->setAid($entity->getId());
        $notification->setTitle($title);
        $notification->setObject($entity->getTitle());
        $notification->setCriticity($criticity);
        $notification->setAuthor($entity->getUser());

        $this->dm->persist($notification);
        $this->dm->flush();

        $redis = new \Redis();
        $redis->connect('127.0.0.1', '6379');
        $emitter = new Emitter($redis);

        $now = new \DateTime('now');

        $emitter->emit('notification', [
            'title' => $title,
            'date' => $now->format('Y-m-d H:i:s'),
            'author' => $entity->getUser()->getPseudo(),
            'objet' => $entity->getTitle(),
            'criticity' => $criticity,
        ]);


    }


    /**
     * Get a user
     * @return mixed
     */
    public function getUser()
    {
        return $this->context->getToken()->getUser();
    }
}
