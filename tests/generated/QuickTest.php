<?php
/**
 *  Router dispatcher generated by crodas/Dispatcher
 *
 *  https://github.com/crodas/Dispatcher
 *
 *  This is a generated file, do not modify it.
 */
namespace QuickTest;

class NotFoundException extends \Exception 
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
                // Routes for /foo/function
                if ($parts[0] === 'foo' && $parts[1] === 'function') {
                    if (empty($file_92cd6d5b)) {
                       $file_92cd6d5b = 1;
                       require_once __DIR__ . "/../QuickTest.php";
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                
                    // do route
                    if ($allow) {
                        $return = \Controller($req);
                
                        // post postRoute (if any)
                
                        return $return;
                    }
                }
                // end of /foo/function
                
                if (empty($file_92cd6d5b)) {
                   $file_92cd6d5b = 1;
                   require_once __DIR__ . "/../QuickTest.php";
                }
                if (empty($obj_filt_23cd7755)) {
                    $obj_filt_23cd7755 = new \Foo;
                }
                // Routes for /xxx/{foobar}
                if ($parts[0] === 'xxx' && (!empty($filter_8843d7f9_1) || ($filter_8843d7f9_1=$obj_filt_23cd7755->simple_filter($req, 'foobar', $parts[1])))) {
                    $req->setIfEmpty('foobar', $parts[1]);
                    if (empty($file_92cd6d5b)) {
                       $file_92cd6d5b = 1;
                       require_once __DIR__ . "/../QuickTest.php";
                    }
                
                    //run preRoute filters (if any)
                    $allow = true;
                
                    // do route
                    if ($allow) {
                        $return = \Controller($req);
                
                        // post postRoute (if any)
                
                        return $return;
                    }
                }
                // end of /xxx/{foobar}
                break;
            }
            break;
        }
        
        switch ($length) {
        case 3:
            // Routes for /foo/bar/xxx
            if ($parts[0] === 'foo' && $parts[1] === 'bar' && $parts[2] === 'xxx') {
                if (empty($file_92cd6d5b)) {
                   $file_92cd6d5b = 1;
                   require_once __DIR__ . "/../QuickTest.php";
                }
            
                //run preRoute filters (if any)
                $allow = true;
            
                // do route
                if ($allow) {
                    $return = \TestingMultiple($req);
            
                    // post postRoute (if any)
            
                    return $return;
                }
            }
            // end of /foo/bar/xxx
            
            if (empty($file_92cd6d5b)) {
               $file_92cd6d5b = 1;
               require_once __DIR__ . "/../QuickTest.php";
            }
            // Routes for /foo/bar/{bar}
            if ($parts[0] === 'foo' && $parts[1] === 'bar' && (!empty($filter_62cdb702_2) || ($filter_62cdb702_2=\filter_2($req, 'bar', $parts[2])))) {
                $req->setIfEmpty('bar', $parts[2]);
                if (empty($file_92cd6d5b)) {
                   $file_92cd6d5b = 1;
                   require_once __DIR__ . "/../QuickTest.php";
                }
            
                //run preRoute filters (if any)
                $allow = true;
            
                // do route
                if ($allow) {
                    $return = \TestingMultiple($req);
            
                    // post postRoute (if any)
            
                    return $return;
                }
            }
            // end of /foo/bar/{bar}
            
            if (empty($file_92cd6d5b)) {
               $file_92cd6d5b = 1;
               require_once __DIR__ . "/../QuickTest.php";
            }
            // Routes for /foo/bar/{foo}
            if ($parts[0] === 'foo' && $parts[1] === 'bar' && (!empty($filter_0beec7b5_2) || ($filter_0beec7b5_2=\filter_1($req, 'foo', $parts[2])))) {
                $req->setIfEmpty('foo', $parts[2]);
                if (empty($file_92cd6d5b)) {
                   $file_92cd6d5b = 1;
                   require_once __DIR__ . "/../QuickTest.php";
                }
            
                //run preRoute filters (if any)
                $allow = true;
            
                // do route
                if ($allow) {
                    $return = \TestingMultiple($req);
            
                    // post postRoute (if any)
            
                    return $return;
                }
            }
            // end of /foo/bar/{foo}
            break;
        case 2:
            // Routes for /foo/method
            if ($parts[0] === 'foo' && $parts[1] === 'method') {
                if (empty($file_92cd6d5b)) {
                   $file_92cd6d5b = 1;
                   require_once __DIR__ . "/../QuickTest.php";
                }
                if (empty($obj_filt_23cd7755)) {
                    $obj_filt_23cd7755 = new \Foo;
                }
            
                //run preRoute filters (if any)
                $allow = true;
            
                // do route
                if ($allow) {
                    $return = $obj_filt_23cd7755->Bar($req);
            
                    // post postRoute (if any)
            
                    return $return;
                }
            }
            // end of /foo/method
            
            if (empty($file_92cd6d5b)) {
               $file_92cd6d5b = 1;
               require_once __DIR__ . "/../QuickTest.php";
            }
            if (empty($obj_filt_23cd7755)) {
                $obj_filt_23cd7755 = new \Foo;
            }
            if (empty($file_92cd6d5b)) {
               $file_92cd6d5b = 1;
               require_once __DIR__ . "/../QuickTest.php";
            }
            if (empty($obj_filt_23cd7755)) {
                $obj_filt_23cd7755 = new \Foo;
            }
            // Routes for /foo/{foobar}.{ext:extension}
            if ($parts[0] === 'foo' && preg_match('/(.+)\\.(.+)/', $parts[1], $matches_1) > 0 && $obj_filt_23cd7755->simple_filter($req, 'foobar', $matches_1[1]) && $obj_filt_23cd7755->ext_filter($req, 'extension', $matches_1[2])) {
                $req->setIfEmpty('foobar', $matches_1[1]);
                $req->setIfEmpty('extension', $matches_1[2]);
                if (empty($file_92cd6d5b)) {
                   $file_92cd6d5b = 1;
                   require_once __DIR__ . "/../QuickTest.php";
                }
                if (empty($obj_filt_23cd7755)) {
                    $obj_filt_23cd7755 = new \Foo;
                }
            
                //run preRoute filters (if any)
                $allow = true;
            
                // do route
                if ($allow) {
                    $return = $obj_filt_23cd7755->TestingComplexUri($req);
            
                    // post postRoute (if any)
            
                    return $return;
                }
            }
            // end of /foo/{foobar}.{ext:extension}
            break;
        }

        throw new NotFoundException;
    }
}
