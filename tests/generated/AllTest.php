<?php
/**
 *  Router dispatcher generated by crodas/Dispatcher
 *
 *  https://github.com/crodas/Dispatcher
 *
 *  This is a generated file, do not modify it.
 */
namespace AllTest;

class NotFoundException extends \Exception
{
}

class RouteNotFoundException extends \Exception
{
}

interface FilterCache
{
    public function has($key);
    public function set($key, $value, $ttl);
    public function get($key);
}

class Request
{
    protected $var = array();
    protected $changes = array();
    protected $watch   = false;

    public function watchChanges()
    {
        $this->watch   = true;
        $this->changes = array();
        return true;
    }

    public function getChanges()
    {
        $this->watch = false;
        return $this->changes;
    }

    protected function handleNotFound()
    {
        $req = $this;
        

        return false;
    }

    public function notFound()
    {
        if ($this->handleNotFound() !== false) {
            /** 
             * Was it handled? Yes!
             */
            exit;
        }

        throw new NotFoundException;
    }

    public function setIfEmpty($name, $value)
    {
        if (empty($this->var[$name])) {
            $this->var[$name] = $value;
            if ($this->watch) {
                $this->changes[] = $name;
            }
        }
        return $this;
    }

    public function set($name, $value)
    {
        $this->var[$name] = $value;
        if ($this->watch) {
            $this->changes[] = $name;
        }
        return $this;
    }

    public function get($name)
    {
        if (array_key_exists($name, $this->var)) {
            return $this->var[$name];
        }
        return NULL;
    }
}

class Route
{
    protected $cache;

    public function setCache(FilterCache $cache)
    {
        $this->cache = $cache;
    }

    // doCachedFilter {{{
    /**
     *  Cache layer for Filters.
     *
     *  If a filter is cachable and a cache object is setup this method will
     *  cache the output of a filter (and all their modifications to a request).
     *
     *  This function is designed to help with those expensive filters which 
     *  for instance talks to databases.
     */
    protected function doCachedFilter($callback, Request $req, $key, $value, $ttl)
    {
        if (empty($this->cache)) {
            // no cache layer, we're just a proxy, call to the original callback
            if (is_string($callback)) {
                $return = $callback($req, $key, $value);
            } else {
                $return = $callback[0]->{$callback[1]}($req, $key, $value);
            }
            return $return;
        }

        $objid = "{$key}\n{$value}";
        if ($v=$this->cache->get($objid)) {
            $req->set('filter:cached:' . $key, true);
            $object = unserialize($v);
            foreach ($object['set'] as $key => $value) {
                $req->set($key, $value);
            }
            return $object['return'];
        }

        // not yet cached yet so we call the filter as normal
        // but we save all their changes it does on Request object
        $req->watchChanges();
        if (is_string($callback)) {
            $return = $callback($req, $key, $value);
        } else {
            $return = $callback[0]->{$callback[1]}($req, $key, $value);
        }
        $keys = $req->setIfEmpty($key, $value)->getChanges();
        $set  = array();
        foreach ($keys as $key) {
            $set[$key] = $req->get($key);
        }

        $this->cache->set($objid, serialize(compact('return', 'set')), 3600);

        
        return $return;
    }
    // }}}

    public function fromRequest(Request $req = NULL)
    {
        if (empty($req)) {
            $req = new Request;
        }
        return $this->doRoute($req, $_SERVER);
    }

    public function doRoute(Request $req, $server)
    {
        $uri    = $server['REQUEST_URI'];
        $uri    = ($p = strpos($uri, '?')) ? substr($uri, 0, $p) : $uri;
        $parts  = array_values(array_filter(explode("/", $uri)));
        $length = count($parts);

        if (empty($server['REQUEST_METHOD'])) {
            $server['REQUEST_METHOD'] = 'GET';
        }

        switch ($server["REQUEST_METHOD"]) {
        case 'GET':
            switch ($length) {
            case 2:
                // Routes for /foobar/12345/ - 2 {{{
                if ($parts[0] === 'foobar' && $parts[1] === '12345') {
                    if (empty($file_b40be1df)) {
                        $file_b40be1df = 1;
                        require_once __DIR__ . "//../input/method.php";
                    }
                    if (empty($obj_filt_e02f213c)) {
                        $obj_filt_e02f213c = new \SomeMethodController;
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    if ($allow) {
                        $allow &= $obj_filt_91adc016->_all_filter($req, array (
                            ));
                    }
                
                    // do route
                    if ($allow) {
                        $req->setIfEmpty('__handler__', array($obj_filt_e02f213c, 'get'));
                        $return = $obj_filt_e02f213c->get($req);
                
                        // post postRoute (if any)
                        if (empty($file_e55749ee)) {
                            $file_e55749ee = 1;
                            require_once __DIR__ . "//../input/filter.php";
                        }
                        if (empty($obj_filt_91adc016)) {
                            $obj_filt_91adc016 = new \SomeSillyClass;
                        }
                        $return = $obj_filt_91adc016->_all_filter_post($req, array (
                            ), $return);
                
                
                
                        return $return;
                    }
                }
                // }}} end of /foobar/12345/
                break;
            }
            break;
        case 'POST':
            switch ($length) {
            case 2:
                // Routes for /foobar/12345/ - 2 {{{
                if ($parts[0] === 'foobar' && $parts[1] === '12345') {
                    if (empty($file_b40be1df)) {
                        $file_b40be1df = 1;
                        require_once __DIR__ . "//../input/method.php";
                    }
                    if (empty($obj_filt_e02f213c)) {
                        $obj_filt_e02f213c = new \SomeMethodController;
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    if ($allow) {
                        $allow &= $obj_filt_91adc016->_all_filter($req, array (
                            ));
                    }
                
                    // do route
                    if ($allow) {
                        $req->setIfEmpty('__handler__', array($obj_filt_e02f213c, 'modify'));
                        $return = $obj_filt_e02f213c->modify($req);
                
                        // post postRoute (if any)
                        if (empty($file_e55749ee)) {
                            $file_e55749ee = 1;
                            require_once __DIR__ . "//../input/filter.php";
                        }
                        if (empty($obj_filt_91adc016)) {
                            $obj_filt_91adc016 = new \SomeSillyClass;
                        }
                        $return = $obj_filt_91adc016->_all_filter_post($req, array (
                            ), $return);
                
                
                
                        return $return;
                    }
                }
                // }}} end of /foobar/12345/
                break;
            case 3:
                // Routes for /foobar/12345//something - 3 {{{
                if ($parts[0] === 'foobar' && $parts[1] === '12345' && $parts[2] === 'something') {
                    if (empty($file_b40be1df)) {
                        $file_b40be1df = 1;
                        require_once __DIR__ . "//../input/method.php";
                    }
                    if (empty($obj_filt_e02f213c)) {
                        $obj_filt_e02f213c = new \SomeMethodController;
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    if ($allow) {
                        $allow &= $obj_filt_91adc016->_all_filter($req, array (
                            ));
                    }
                
                    // do route
                    if ($allow) {
                        $req->setIfEmpty('__handler__', array($obj_filt_e02f213c, 'modify_something'));
                        $return = $obj_filt_e02f213c->modify_something($req);
                
                        // post postRoute (if any)
                        if (empty($file_e55749ee)) {
                            $file_e55749ee = 1;
                            require_once __DIR__ . "//../input/filter.php";
                        }
                        if (empty($obj_filt_91adc016)) {
                            $obj_filt_91adc016 = new \SomeSillyClass;
                        }
                        $return = $obj_filt_91adc016->_all_filter_post($req, array (
                            ), $return);
                
                
                
                        return $return;
                    }
                }
                // }}} end of /foobar/12345//something
                break;
            case 1:
                // Routes for /prefix/ - 1 {{{
                if ($parts[0] === 'prefix') {
                    if (empty($file_ce8f643f)) {
                        $file_ce8f643f = 1;
                        require_once __DIR__ . "//../input/class.php";
                    }
                    if (empty($obj_filt_2d89b930)) {
                        $obj_filt_2d89b930 = new \SomeClass;
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    if ($allow) {
                        $allow &= $obj_filt_91adc016->_all_filter($req, array (
                            ));
                    }
                    if (empty($file_e0cf7353)) {
                        $file_e0cf7353 = 1;
                        require_once __DIR__ . "//../input/route_filters.php";
                    }
                    if ($allow) {
                        $allow &= \CheckSession_another($req, NULL);
                    }
                    if (empty($file_e0cf7353)) {
                        $file_e0cf7353 = 1;
                        require_once __DIR__ . "//../input/route_filters.php";
                    }
                    if ($allow) {
                        $allow &= \CheckSession($req, NULL);
                    }
                
                    // do route
                    if ($allow) {
                        $req->setIfEmpty('__handler__', array($obj_filt_2d89b930, 'save'));
                        $return = $obj_filt_2d89b930->save($req);
                
                        // post postRoute (if any)
                        if (empty($file_e55749ee)) {
                            $file_e55749ee = 1;
                            require_once __DIR__ . "//../input/filter.php";
                        }
                        if (empty($obj_filt_91adc016)) {
                            $obj_filt_91adc016 = new \SomeSillyClass;
                        }
                        $return = $obj_filt_91adc016->_all_filter_post($req, array (
                            ), $return);
                
                
                
                        return $return;
                    }
                }
                // }}} end of /prefix/
                break;
            }
            break;
        case 'DELETE':
            switch ($length) {
            case 2:
                // Routes for /foobar/12345/ - 2 {{{
                if ($parts[0] === 'foobar' && $parts[1] === '12345') {
                    if (empty($file_b40be1df)) {
                        $file_b40be1df = 1;
                        require_once __DIR__ . "//../input/method.php";
                    }
                    if (empty($obj_filt_e02f213c)) {
                        $obj_filt_e02f213c = new \SomeMethodController;
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    if ($allow) {
                        $allow &= $obj_filt_91adc016->_all_filter($req, array (
                            ));
                    }
                
                    // do route
                    if ($allow) {
                        $req->setIfEmpty('__handler__', array($obj_filt_e02f213c, 'modify'));
                        $return = $obj_filt_e02f213c->modify($req);
                
                        // post postRoute (if any)
                        if (empty($file_e55749ee)) {
                            $file_e55749ee = 1;
                            require_once __DIR__ . "//../input/filter.php";
                        }
                        if (empty($obj_filt_91adc016)) {
                            $obj_filt_91adc016 = new \SomeSillyClass;
                        }
                        $return = $obj_filt_91adc016->_all_filter_post($req, array (
                            ), $return);
                
                
                
                        return $return;
                    }
                }
                // }}} end of /foobar/12345/
                break;
            case 3:
                // Routes for /foobar/12345//something - 3 {{{
                if ($parts[0] === 'foobar' && $parts[1] === '12345' && $parts[2] === 'something') {
                    if (empty($file_b40be1df)) {
                        $file_b40be1df = 1;
                        require_once __DIR__ . "//../input/method.php";
                    }
                    if (empty($obj_filt_e02f213c)) {
                        $obj_filt_e02f213c = new \SomeMethodController;
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    if ($allow) {
                        $allow &= $obj_filt_91adc016->_all_filter($req, array (
                            ));
                    }
                
                    // do route
                    if ($allow) {
                        $req->setIfEmpty('__handler__', array($obj_filt_e02f213c, 'modify_something'));
                        $return = $obj_filt_e02f213c->modify_something($req);
                
                        // post postRoute (if any)
                        if (empty($file_e55749ee)) {
                            $file_e55749ee = 1;
                            require_once __DIR__ . "//../input/filter.php";
                        }
                        if (empty($obj_filt_91adc016)) {
                            $obj_filt_91adc016 = new \SomeSillyClass;
                        }
                        $return = $obj_filt_91adc016->_all_filter_post($req, array (
                            ), $return);
                
                
                
                        return $return;
                    }
                }
                // }}} end of /foobar/12345//something
                break;
            }
            break;
        }
        
        switch ($length) {
        case 2:
            if ($parts[0] === 'foo') { // 1
                // Routes for /foo/bar - 2 {{{
                if ($parts[0] === 'foo' && $parts[1] === 'bar') {
                    if (empty($file_7bb32286)) {
                        $file_7bb32286 = 1;
                        require_once __DIR__ . "//../input/bug01.php";
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    if ($allow) {
                        $allow &= $obj_filt_91adc016->_all_filter($req, array (
                            ));
                    }
                
                    // do route
                    if ($allow) {
                        $req->setIfEmpty('__handler__', '\\bug01\\barfoo');
                        $return = \bug01\barfoo($req);
                
                        // post postRoute (if any)
                        if (empty($file_e55749ee)) {
                            $file_e55749ee = 1;
                            require_once __DIR__ . "//../input/filter.php";
                        }
                        if (empty($obj_filt_91adc016)) {
                            $obj_filt_91adc016 = new \SomeSillyClass;
                        }
                        $return = $obj_filt_91adc016->_all_filter_post($req, array (
                            ), $return);
                
                
                
                        return $return;
                    }
                }
                // }}} end of /foo/bar

                // Routes for /foo/{id} - 21 {{{
                if ($parts[0] === 'foo') {
                    $req->setIfEmpty('id', $parts[1]);
                    if (empty($file_7bb32286)) {
                        $file_7bb32286 = 1;
                        require_once __DIR__ . "//../input/bug01.php";
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    if ($allow) {
                        $allow &= $obj_filt_91adc016->_all_filter($req, array (
                            ));
                    }
                
                    // do route
                    if ($allow) {
                        $req->setIfEmpty('__handler__', '\\bug01\\foobar');
                        $return = \bug01\foobar($req);
                
                        // post postRoute (if any)
                        if (empty($file_e55749ee)) {
                            $file_e55749ee = 1;
                            require_once __DIR__ . "//../input/filter.php";
                        }
                        if (empty($obj_filt_91adc016)) {
                            $obj_filt_91adc016 = new \SomeSillyClass;
                        }
                        $return = $obj_filt_91adc016->_all_filter_post($req, array (
                            ), $return);
                
                
                
                        return $return;
                    }
                }
                // }}} end of /foo/{id}
            }
            if ($parts[0] === 'function') { // 1
                // Routes for /function/reverse - 2 {{{
                if ($parts[0] === 'function' && $parts[1] === 'reverse') {
                    if (empty($file_2053a8ae)) {
                        $file_2053a8ae = 1;
                        require_once __DIR__ . "//../input/functions.php";
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    if ($allow) {
                        $allow &= $obj_filt_91adc016->_all_filter($req, array (
                            ));
                    }
                
                    // do route
                    if ($allow) {
                        $req->setIfEmpty('__handler__', '\\some_function');
                        $return = \some_function($req);
                
                        // post postRoute (if any)
                        if (empty($file_e55749ee)) {
                            $file_e55749ee = 1;
                            require_once __DIR__ . "//../input/filter.php";
                        }
                        if (empty($obj_filt_91adc016)) {
                            $obj_filt_91adc016 = new \SomeSillyClass;
                        }
                        $return = $obj_filt_91adc016->_all_filter_post($req, array (
                            ), $return);
                
                
                
                        return $return;
                    }
                }
                // }}} end of /function/reverse

                if (empty($file_e55749ee)) {
                    $file_e55749ee = 1;
                    require_once __DIR__ . "//../input/filter.php";
                }
                if (empty($obj_filt_91adc016)) {
                    $obj_filt_91adc016 = new \SomeSillyClass;
                }
                // Routes for /function/{reverse} - 21 {{{
                if ($parts[0] === 'function' && (!empty($filter_75470a30_1) || ($filter_75470a30_1=$obj_filt_91adc016->filter_reverse($req, 'reverse', $parts[1])))) {
                    $req->setIfEmpty('reverse', $parts[1]);
                    if (empty($file_2053a8ae)) {
                        $file_2053a8ae = 1;
                        require_once __DIR__ . "//../input/functions.php";
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    if ($allow) {
                        $allow &= $obj_filt_91adc016->_all_filter($req, array (
                            ));
                    }
                
                    // do route
                    if ($allow) {
                        $req->setIfEmpty('__handler__', '\\some_function');
                        $return = \some_function($req);
                
                        // post postRoute (if any)
                        if (empty($file_e55749ee)) {
                            $file_e55749ee = 1;
                            require_once __DIR__ . "//../input/filter.php";
                        }
                        if (empty($obj_filt_91adc016)) {
                            $obj_filt_91adc016 = new \SomeSillyClass;
                        }
                        $return = $obj_filt_91adc016->_all_filter_post($req, array (
                            ), $return);
                
                
                
                        return $return;
                    }
                }
                // }}} end of /function/{reverse}
            }
            // Routes for /prefix//some - 2 {{{
            if ($parts[0] === 'prefix' && $parts[1] === 'some') {
                if (empty($file_ce8f643f)) {
                    $file_ce8f643f = 1;
                    require_once __DIR__ . "//../input/class.php";
                }
                if (empty($obj_filt_2d89b930)) {
                    $obj_filt_2d89b930 = new \SomeClass;
                }
            
                //run preRoute filters (if any)
                $allow = true;
                if (empty($file_e55749ee)) {
                    $file_e55749ee = 1;
                    require_once __DIR__ . "//../input/filter.php";
                }
                if (empty($obj_filt_91adc016)) {
                    $obj_filt_91adc016 = new \SomeSillyClass;
                }
                if ($allow) {
                    $allow &= $obj_filt_91adc016->_all_filter($req, array (
                        ));
                }
                if (empty($file_e0cf7353)) {
                    $file_e0cf7353 = 1;
                    require_once __DIR__ . "//../input/route_filters.php";
                }
                if ($allow) {
                    $allow &= \CheckSession_another($req, NULL);
                }
            
                // do route
                if ($allow) {
                    $req->setIfEmpty('__handler__', array($obj_filt_2d89b930, 'index'));
                    $return = $obj_filt_2d89b930->index($req);
            
                    // post postRoute (if any)
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    $return = $obj_filt_91adc016->_all_filter_post($req, array (
                        ), $return);
            
            
            
                    return $return;
                }
            }
            // }}} end of /prefix//some

            if (empty($file_e55749ee)) {
                $file_e55749ee = 1;
                require_once __DIR__ . "//../input/filter.php";
            }
            if (empty($obj_filt_91adc016)) {
                $obj_filt_91adc016 = new \SomeSillyClass;
            }
            // Routes for /ifempty/{something:algo-alias} - 21 {{{
            if ($parts[0] === 'ifempty' && (!empty($filter_1ded59a9_1) || ($filter_1ded59a9_1=$this->doCachedFilter(array($obj_filt_91adc016, 'filter_set'), $req, 'algo-alias', $parts[1], 1)))) {
                $req->setIfEmpty('algo-alias', $parts[1]);
                if (empty($file_2053a8ae)) {
                    $file_2053a8ae = 1;
                    require_once __DIR__ . "//../input/functions.php";
                }
            
                //run preRoute filters (if any)
                $allow = true;
                if (empty($file_e55749ee)) {
                    $file_e55749ee = 1;
                    require_once __DIR__ . "//../input/filter.php";
                }
                if (empty($obj_filt_91adc016)) {
                    $obj_filt_91adc016 = new \SomeSillyClass;
                }
                if ($allow) {
                    $allow &= $obj_filt_91adc016->_all_filter($req, array (
                        ));
                }
            
                // do route
                if ($allow) {
                    $req->setIfEmpty('__handler__', '\\some_function');
                    $return = \some_function($req);
            
                    // post postRoute (if any)
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    $return = $obj_filt_91adc016->_all_filter_post($req, array (
                        ), $return);
            
            
            
                    return $return;
                }
            }
            // }}} end of /ifempty/{something:algo-alias}
            break;
        case 1:
            // Routes for /deadly-simple - 1 {{{
            if ($parts[0] === 'deadly-simple') {
                if (empty($file_2053a8ae)) {
                    $file_2053a8ae = 1;
                    require_once __DIR__ . "//../input/functions.php";
                }
            
                //run preRoute filters (if any)
                $allow = true;
                if (empty($file_e55749ee)) {
                    $file_e55749ee = 1;
                    require_once __DIR__ . "//../input/filter.php";
                }
                if (empty($obj_filt_91adc016)) {
                    $obj_filt_91adc016 = new \SomeSillyClass;
                }
                if ($allow) {
                    $allow &= $obj_filt_91adc016->_all_filter($req, array (
                        ));
                }
            
                // do route
                if ($allow) {
                    $req->setIfEmpty('__handler__', '\\simple');
                    $return = \simple($req);
            
                    // post postRoute (if any)
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    $return = $obj_filt_91adc016->_all_filter_post($req, array (
                        ), $return);
            
            
            
                    return $return;
                }
            }
            // }}} end of /deadly-simple

            // Routes for /zzzsfasd_prefix_{id} - 30 {{{
            if (preg_match('/^zzzsfasd_prefix_(.+)/', $parts[0], $matches_0) > 0) {
                $req->setIfEmpty('id', $matches_0[1]);
                if (empty($file_2053a8ae)) {
                    $file_2053a8ae = 1;
                    require_once __DIR__ . "//../input/functions.php";
                }
            
                //run preRoute filters (if any)
                $allow = true;
                if (empty($file_e55749ee)) {
                    $file_e55749ee = 1;
                    require_once __DIR__ . "//../input/filter.php";
                }
                if (empty($obj_filt_91adc016)) {
                    $obj_filt_91adc016 = new \SomeSillyClass;
                }
                if ($allow) {
                    $allow &= $obj_filt_91adc016->_all_filter($req, array (
                        ));
                }
            
                // do route
                if ($allow) {
                    $req->setIfEmpty('__handler__', '\\soo');
                    $return = \soo($req);
            
                    // post postRoute (if any)
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    $return = $obj_filt_91adc016->_all_filter_post($req, array (
                        ), $return);
            
            
            
                    return $return;
                }
            }
            // }}} end of /zzzsfasd_prefix_{id}

            if (empty($file_2053a8ae)) {
                $file_2053a8ae = 1;
                require_once __DIR__ . "//../input/functions.php";
            }
            // Routes for /{__id__} - 1048575 {{{
            if ((!empty($filter_99149840_0) || ($filter_99149840_0=\__filter__($req, '__id__', $parts[0])))) {
                $req->setIfEmpty('__id__', $parts[0]);
                if (empty($file_2053a8ae)) {
                    $file_2053a8ae = 1;
                    require_once __DIR__ . "//../input/functions.php";
                }
            
                //run preRoute filters (if any)
                $allow = true;
                if (empty($file_e55749ee)) {
                    $file_e55749ee = 1;
                    require_once __DIR__ . "//../input/filter.php";
                }
                if (empty($obj_filt_91adc016)) {
                    $obj_filt_91adc016 = new \SomeSillyClass;
                }
                if ($allow) {
                    $allow &= $obj_filt_91adc016->_all_filter($req, array (
                        ));
                }
            
                // do route
                if ($allow) {
                    $req->setIfEmpty('__handler__', '\\empty_level_1');
                    $return = \empty_level_1($req);
            
                    // post postRoute (if any)
                    if (empty($file_e55749ee)) {
                        $file_e55749ee = 1;
                        require_once __DIR__ . "//../input/filter.php";
                    }
                    if (empty($obj_filt_91adc016)) {
                        $obj_filt_91adc016 = new \SomeSillyClass;
                    }
                    $return = $obj_filt_91adc016->_all_filter_post($req, array (
                        ), $return);
            
            
            
                    return $return;
                }
            }
            // }}} end of /{__id__}
            break;
        case 0:
            // Routes for / - 0 {{{
            if (empty($file_2053a8ae)) {
                $file_2053a8ae = 1;
                require_once __DIR__ . "//../input/functions.php";
            }
            
            //run preRoute filters (if any)
            $allow = true;
            if (empty($file_e55749ee)) {
                $file_e55749ee = 1;
                require_once __DIR__ . "//../input/filter.php";
            }
            if (empty($obj_filt_91adc016)) {
                $obj_filt_91adc016 = new \SomeSillyClass;
            }
            if ($allow) {
                $allow &= $obj_filt_91adc016->_all_filter($req, array (
                    ));
            }
            
            // do route
            if ($allow) {
                $req->setIfEmpty('__handler__', '\\empty_level_2');
                $return = \empty_level_2($req);
            
                // post postRoute (if any)
                if (empty($file_e55749ee)) {
                    $file_e55749ee = 1;
                    require_once __DIR__ . "//../input/filter.php";
                }
                if (empty($obj_filt_91adc016)) {
                    $obj_filt_91adc016 = new \SomeSillyClass;
                }
                $return = $obj_filt_91adc016->_all_filter_post($req, array (
                    ), $return);
            
            
            
                return $return;
            }
            // }}} end of /
            break;
        }

        

        throw new NotFoundException;
    }

    public static function getRoute($name, $args = array())
    {
        if (!is_array($args)) {
            $args = func_get_args();
            array_shift($args);
        }

        $count = count($args);
        switch ($name) {
        case 'route_with_id':
            if ($count == 1 && (!empty($args["__id__"]) || !empty($args[0]))) {
                return "/" . (!empty($args["__id__"]) ? $args["__id__"] : $args[0]) . "";
            }

            throw new RouteNotFoundException("Invalid arguments for route route_with_id, possible routes:\n/{__id__} (1 arguments) 
");

        }

        throw new RouteNotFoundException("There is not route name $name");
    }
}
