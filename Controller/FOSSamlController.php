<?php

namespace ipcb\FOSSamlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FOSSamlController extends Controller
{
    public function unauthorizedAction()
    {
        return $this->render('FOSSamlBundle::unauthorized.html.twig',array('type'=>'Acesso Negado'));
    }
    
    public function logoutAction()
    {
        return $this->render('FOSSamlBundle::unauthorized.html.twig',array('type'=>'Acesso Negado'));
        
        //$user = $this->get('security.context')->getToken()->getUser();
        //var_dump($user);
        
        //$this->get('request')->getSession()->invalidate();
        
        //var_dump('controller logout');
        
    }
}