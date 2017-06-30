<?php

namespace minimal;

/**
 * Very simple router class
 */
class router {
    
    /**
     * Var holding the path info
     * @var array
     */
    public $pathInfo = [];
    
    /**
     * Var holding routes
     * @var array $routes
     */
    public $routes = []; 
    
    /**
     * Var hlding error message
     */
    public $error = '';
    
    /**
     * Set a route
     * @param array $route ('match', 'class', 'method')
     * @param string $key key of setRoute, special is notFound
     */
    public function setRoute ($route, $key = null) {
        if ($key) {
            $this->routes[$key] = $route;
        } else {
            $this->routes[] = $route;
        }
    }

    /**
     * Sets $this->pathInfo from $_SERVER['REQUEST_URI']
     */
    public function parse () {       
        $this->pathInfo = parse_url($_SERVER['REQUEST_URI']);
    }
    
    /**
     * Match set routes
     * @param array $routes
     * @return mixed
     */
    public function match () {
        $this->parse();        
        $matches = array();
        
        foreach ($this->routes as $route) {   
            if (preg_match($route['match'], $this->pathInfo['path'] , $matches)) {
                $res = $this->call($route);
                return $res;
            } 
        }
        
        $this->error = 'No such route';
        $this->notFound();
    }
    
    /**
     * Check for a not found route or call default built-in
     * @return void
     */
    public function notFound() {
        if (isset($this->routes['notFound'])) {
            $this->call($this->routes['notFound']);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "<h1>Page was not found</h1>";
            if ($this->error) {
                echo $this->error;
            }
            return;
        }
    }
    
    /**
     * Call a found 'match' with 'class' and 'method'
     * @param array $call
     * @return mixed
     */
    public function call ($call) {
        if (!isset($call['method']) || !isset($call['class'])) {
            $this->error = "Error: Correct match of route but 'method' or 'class' is not set";
            $this->notFound();
            return;
        }
        if (!method_exists($call['class'], $call['method'])) {
            $this->error = "Error: Correct match of route but method $call[method] does not exists on class $call[class]";
            $this->notFound();
            return;
        }
        
        $class = $call['class'];
        $method = $call['method'];
        $object = new $class;
        
        return $object->$method();
        
    }
}
