<?php

namespace PaP\BackBundle\Controller;

use PaP\BackBundle\Entity\Announcement;
use SocketIO\Emitter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @todo Make Twig Views more short
 * Class AnnouncementController
 * @package PaP\BackBundle\Controller
 */
class AnnouncementController extends Controller
{
    /**
     * Allows to see all Announcements
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository("BackBundle:Announcement")->getAllByCriteria();

        return $this->render("BackBundle:Announcement:index.html.twig",["offers" => $offers]);
    }

    /**
     *
     * Allows to ajax all Announcements
     *
     */
    public function ajaxAction()
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $notifications = $dm->getRepository("BackBundle:Notifications")->findAll();

        $response = new JsonResponse();
        $response->setData($notifications);

        return $response;
    }

    /**
     *
     * Allows to ajax all Announcements
     *
     */
    public function removeajaxAction($notif)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $notifications = $dm->getRepository("BackBundle:Notifications")->find($notif);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->remove($notifications);
        $dm->flush();

        $redis = new \Redis();
        $redis->connect('127.0.0.1', '6379');
        $emitter = new Emitter($redis);

        // Emit a notification on channel 'notification'
        $emitter->emit('announcement', [
            'action' => 'remove',
        ]);

        return new JsonResponse(array(true));
    }



    /**
     * @param Announcement $offer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Announcement $offer)
    {

        return $this->render("BackBundle:Announcement:show.html.twig",["offer"=>$offer]);
    }

    /**
     * Allows to create and Announcement
     *
     * @TODO: both methods functions
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $handler = $this->handler("Votre annonce a bien été crée", new Announcement());

        return $this->render("BackBundle:Announcement:create.html.twig",["formOffer"=> $handler->getForm()->createView()]);
    }


    /**
     * @param string $message
     * @param $offer
     * @return object
     */
    protected function handler($message = "", $offer){
        $handler = $this->get('announcement_handler');

        if($handler->process($offer))
        {
            return $handler;
        }

        return $handler;
    }

    /**
     * Allows to edit an announcement
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Announcement $offer, Request $request)
    {
        $handler = $this->handler("Votre annonce a bien été editée", $offer);

        return $this->render('BackBundle:Announcement:edit.html.twig', ["formOffer"=> $handler->getForm()->createView()]);

    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $offer = $em->getRepository('BackBundle:Announcement')->find($id);

        if (!$offer) {
            throw $this->createNotFoundException('Unable to find announcement to delete.');
        }
        $em->remove($offer);
        $em->flush();

        if($request->isXmlHttpRequest())
        {
            return new JsonResponse();
        }

        $this->get("session")->getFlashBag()
            ->add("success","Your offer has been deleted");

        return $this->redirect($this->generateUrl("back_announcement_index"));

    }

    /**
     * Activate|Disable an announcement
     * @param Announcement $offer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activateAction(Announcement $offer)
    {
        $this->get('announcement_handler')->activate($offer);

        $this->get("session")->getFlashBag()
            ->add("success","Your offer has been updated");

        return $this->redirect($this->generateUrl("back_announcement_index"));

    }
}
