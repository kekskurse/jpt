<?php
class AllCapsMiddleware extends \Slim\Middleware
{
    public function call()
    {
        #var_dump($_SESSION);
        #var_dump($this->app->request()->getPathInfo());
        #$this->app->hook('slim.before.dispatch', array($this, 'onBeforeDispatch'));
        if(!(isset($_SESSION["login"])&&$_SESSION["login"]==true)&&!(substr($this->app->request()->getPathInfo(),0,6)=="/login"||substr($this->app->request()->getPathInfo(),0,7)=="/public"))
        {
                $this->app->redirect('/login');
        }
        $this->next->call();

    }

   
}