<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $this->layout()->setVariable('activePage', 'home');
        return new ViewModel();
    }
    
    public function contactUsAction()
    {
        $this->layout()->setVariable('activePage', 'contact-us');
        return new ViewModel();
    }
    
    public function aboutUsAction()
    {
        $this->layout()->setVariable('activePage', 'about-us');
        return new ViewModel();
    }

    public function birthdaysAction()
    {
        $this->layout()->setVariable('activePage', 'birthdays');
        return new ViewModel();
    }

    public function classesAction()
    {
        $this->layout()->setVariable('activePage', 'classes');
        return new ViewModel();
    }
    public function superGoalieAction()
    {
        $this->layout()->setVariable('activePage', 'super-goalie');
        return new ViewModel();
    }
    public function facilitiesAction()
    {
        $this->layout()->setVariable('activePage', 'facilities');
        return new ViewModel();
    }
}
