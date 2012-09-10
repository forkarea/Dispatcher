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

class Request
{
    protected $var;

    public function setIfEmpty($name, $value)
    {
        if (empty($this->var[$name])) {
            $this->var[$name] = $value;
        }
        return $this;
    }

    public function set($name, $value)
    {
        $this->var[$name] = $value;
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
    public function fromRequest(Request $req = NULL)
    {
        if (empty($req)) {
            $req = new Request;
        }
        return $this->doRoute($req, $_SERVER);
    }

    public function doRoute(Request $req, $server)
    {
        $parts  = array_values(array_filter(explode("/", $server['REQUEST_URI'])));
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
                    // do route
                    return \Controller($req);
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
                if ($parts[0] === 'xxx' && (!empty($filter_6727d712_1) || ($filter_6727d712_1=$obj_filt_23cd7755->simple_filter($req, 'foobar', $parts[1])))) {
                    $req->setIfEmpty('foobar', $parts[1]);
                    if (empty($file_92cd6d5b)) {
                       $file_92cd6d5b = 1;
                       require_once __DIR__ . "/../QuickTest.php";
                    }
                    // do route
                    return \Controller($req);
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
                // do route
                return \TestingMultiple($req);
            }
            // end of /foo/bar/xxx
            
            if (empty($file_92cd6d5b)) {
               $file_92cd6d5b = 1;
               require_once __DIR__ . "/../QuickTest.php";
            }
            // Routes for /foo/bar/{bar}
            if ($parts[0] === 'foo' && $parts[1] === 'bar' && (!empty($filter_6d764d8a_2) || ($filter_6d764d8a_2=\filter_2($req, 'bar', $parts[2])))) {
                $req->setIfEmpty('bar', $parts[2]);
                if (empty($file_92cd6d5b)) {
                   $file_92cd6d5b = 1;
                   require_once __DIR__ . "/../QuickTest.php";
                }
                // do route
                return \TestingMultiple($req);
            }
            // end of /foo/bar/{bar}
            
            if (empty($file_92cd6d5b)) {
               $file_92cd6d5b = 1;
               require_once __DIR__ . "/../QuickTest.php";
            }
            // Routes for /foo/bar/{foo}
            if ($parts[0] === 'foo' && $parts[1] === 'bar' && (!empty($filter_b5c42409_2) || ($filter_b5c42409_2=\filter_1($req, 'foo', $parts[2])))) {
                $req->setIfEmpty('foo', $parts[2]);
                if (empty($file_92cd6d5b)) {
                   $file_92cd6d5b = 1;
                   require_once __DIR__ . "/../QuickTest.php";
                }
                // do route
                return \TestingMultiple($req);
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
                // do route
                return $obj_filt_23cd7755->Bar($req);
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
                // do route
                return $obj_filt_23cd7755->TestingComplexUri($req);
            }
            // end of /foo/{foobar}.{ext:extension}
            break;
        }

        throw new NotFoundException;
    }
}