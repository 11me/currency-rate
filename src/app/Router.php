<?php

class Router
{

    private $routes;

    public function __construct()
    {

        $path_to_routes = ROOT.'/routes.php';
        $this->routes = include($path_to_routes);

    }

    // Get the request URI
    private function getURI()
    {
        if (!empty($_SERVER["REQUEST_URI"]))
        {
            return trim($_SERVER["REQUEST_URI"], "/");
        }
    }


    public function start()
    {
        $uri = $this->getURI();

        foreach($this->routes as $uriPattern => $path)
        {
            // Compare the uri pattern and uri
            // from routes: request => Controller/action

            if (preg_match("~$uriPattern~", $uri))
            {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $controllerActionArray = explode("/", $internalRoute);

                $controllerName = ucfirst(array_shift($controllerActionArray)) .'Controller';
                $actionName = array_shift($controllerActionArray);

                $requestParams = $controllerActionArray;

                $controllerFileName = ROOT . "/app/Controllers/" . $controllerName . ".php";

                if (file_exists($controllerFileName))
                {
                    include_once($controllerFileName);
                }

                // Create instance of controller
                $controllerInstance = new $controllerName;

                // Call action of controller instance
                $result = call_user_func_array(array($controllerInstance, $actionName), $requestParams);

                if ($result != null)
                {
                    break;
                }

            }
        }
    }

}
