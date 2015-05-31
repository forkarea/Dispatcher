<?php
/**
 *  This file was generated with crodas/SimpleView (https://github.com/crodas/SimpleView)
 *  Do not edit this file.
 *
 */

namespace {


    class base_template_48f91366c839e056a4dcd440512f99e82188c46a
    {
        protected $parent;
        protected $child;
        protected $context;

        public function yield_parent($name, $args)
        {
            $method = "section_" . sha1($name);

            if (is_callable(array($this->parent, $method))) {
                $this->parent->$method(array_merge($this->context, $args));
                return true;
            }

            if ($this->parent) {
                return $this->parent->yield_parent($name, $args);
            }

            return false;
        }

        public function do_yield($name, Array $args = array())
        {
            if ($this->child) {
                // We have a children template, we are their base
                // so let's see if they have implemented by any change
                // this section
                if ($this->child->do_yield($name, $args)) {
                    // yes!
                    return true;
                }
            }

            // Do I have this section defined?
            $method = "section_" . sha1($name);
            if (is_callable(array($this, $method))) {
                // Yes!
                $this->$method(array_merge($this->context, $args));
                return true;
            }

            // No :-(
            return false;
        }

    }

    /** 
     *  Template class generated from callback.tpl.php
     */
    class class_d5b1e9c7792768d5c2401b262ea8a886c76d1f6a extends base_template_48f91366c839e056a4dcd440512f99e82188c46a
    {

        public function hasSection($name)
        {

            return false;
        }


        public function renderSection($name, Array $args = array(), $fail_on_missing = true)
        {
            if (!$this->hasSection($name)) {
                if ($fail_on_missing) {
                    throw new \RuntimeException("Cannot find section {$name}");
                }
                return "";
            }

        }

        public function enhanceException(Exception $e, $section = NULL)
        {
            if (!empty($e->enhanced)) {
                return;
            }

            $message = $e->getMessage() . "( IN " . 'callback.tpl.php';
            if ($section) {
                $message .= " | section: {$section}";
            }
            $message .= ")";

            $object   = new ReflectionObject($e);
            $property = $object->getProperty('message');
            $property->setAccessible(true);
            $property->setValue($e, $message);

            $e->enhanced = true;
        }

        public function render(Array $vars = array(), $return = false)
        {
            try {
                return $this->_render($vars, $return);
            } catch (Exception $e) {
                if ($return) ob_get_clean();
                $this->enhanceException($e);
                throw $e;
            }
        }

        public function _render(Array $vars = array(), $return = false)
        {
            $this->context = $vars;

            extract($vars);
            if ($return) {
                ob_start();
            }

            echo "if (!" . ($filter) . "( ";
            var_export($name);
            echo ", false)) {\n    require ";
            var_export($filePath);
            echo ";\n}\n\n";
            if (!empty($obj)) {
                echo "    if (empty(" . ($obj) . ")) {\n        ";
                echo $obj . " = new " . ($class) . ";\n    }\n";
            }

            if ($return) {
                return ob_get_clean();
            }

        }
    }

    /** 
     *  Template class generated from ComplexUrl.tpl.php
     */
    class class_ae8225d480777bd6e834b5ab827505af67d3fdf8 extends base_template_48f91366c839e056a4dcd440512f99e82188c46a
    {

        public function hasSection($name)
        {

            return false;
        }


        public function renderSection($name, Array $args = array(), $fail_on_missing = true)
        {
            if (!$this->hasSection($name)) {
                if ($fail_on_missing) {
                    throw new \RuntimeException("Cannot find section {$name}");
                }
                return "";
            }

        }

        public function enhanceException(Exception $e, $section = NULL)
        {
            if (!empty($e->enhanced)) {
                return;
            }

            $message = $e->getMessage() . "( IN " . 'ComplexUrl.tpl.php';
            if ($section) {
                $message .= " | section: {$section}";
            }
            $message .= ")";

            $object   = new ReflectionObject($e);
            $property = $object->getProperty('message');
            $property->setAccessible(true);
            $property->setValue($e, $message);

            $e->enhanced = true;
        }

        public function render(Array $vars = array(), $return = false)
        {
            try {
                return $this->_render($vars, $return);
            } catch (Exception $e) {
                if ($return) ob_get_clean();
                $this->enhanceException($e);
                throw $e;
            }
        }

        public function _render(Array $vars = array(), $return = false)
        {
            $this->context = $vars;

            extract($vars);
            if ($return) {
                ob_start();
            }

            echo "//<?php\n\nprotected function complexUrl";
            echo $id . "(\$req, \$parts, \$length, &\$return)\n{\n    \$i = 0;\n    \$args = array();\n";
            foreach($url->getParts() as $part) {

                $this->context['part'] = $part;
                $prep = $part->exprPrepare();
                $this->context['prep'] = $prep;
                $expr = $part->getExpr();
                $this->context['expr'] = $expr;
                if ($part->isRepetitive()) {
                    if ($expr) {
                        echo "                " . ($prep) . "\n                while (\$i < \$length && ";
                        echo $expr . ") {\n";
                        foreach($part->getVariables('') as $name => $var) {

                            $this->context['name'] = $name;
                            $this->context['var'] = $var;
                            if (count($var) == 1) {
                                echo "                            \$args[";
                                var_export($name);
                                echo "][] = \$parts[\$i];\n";
                            }
                            else {
                                echo "                            \$args[";
                                var_export($name);
                                echo "][] = \$matches_0[" . ($var[1]) . "];\n";
                            }
                        }
                        echo "                    ++\$i;\n                }\n";
                    }
                    else {
                        $no_filter = $part;
                        $this->context['no_filter'] = $no_filter;
                    }
                }
                else {
                    if ($expr) {
                        echo "                " . ($prep) . "\n";
                        if (!empty($no_filter)) {
                            echo "                    while (\$i < \$length && !(" . ($expr) . ")) {\n";
                            foreach($no_filter->getVariables('') as $name => $var) {

                                $this->context['name'] = $name;
                                $this->context['var'] = $var;
                                if (count($var) == 1) {
                                    echo "                                \$args[";
                                    var_export($name);
                                    echo "][] = \$parts[\$i];\n";
                                }
                                else {
                                    echo "                                \$args[";
                                    var_export($name);
                                    echo "][] = \$matches_0[" . ($var[1]) . "];\n";
                                }
                            }
                            echo "                        ++\$i;\n                    }\n";
                            $no_filter = null;
                            $this->context['no_filter'] = $no_filter;
                        }
                        echo "                if (\$i >= \$length || !(" . ($expr) . ")) {\n                    return false;\n                }\n";
                        foreach($part->getVariables('') as $name => $var) {

                            $this->context['name'] = $name;
                            $this->context['var'] = $var;
                            if (count($var) == 1) {
                                $var = 'parts[$i]';
                                $this->context['var'] = $var;
                            }
                            else {
                                $var = 'matches_0[' . $var[1] . ']';
                                $this->context['var'] = $var;
                            }
                            echo "                    \$args[";
                            var_export($name);
                            echo "] = \$" . ($var) . ";\n";
                        }
                        echo "                ++\$i;\n";
                    }
                }
                echo "\n";
            }
            echo "\n";
            if (!empty($no_filter)) {
                echo "    while (\$i < \$length) {\n";
                foreach($no_filter->getVariables('') as $name => $var) {

                    $this->context['name'] = $name;
                    $this->context['var'] = $var;
                    echo "        \$args[";
                    var_export($name);
                    echo "][] = \$parts[\$i];\n";
                }
                echo "        ++\$i;\n    }\n";
            }
            echo "\n    \n";
            foreach($url->getFilters('preroute') as $filter) {

                $this->context['filter'] = $filter;
                echo "        " . ($self->callbackPrepare($filter[0])) . "\n        if (";
                echo $self->callback($filter[0], '$req', $filter[1]) . " === false) {\n            return false;\n        }\n";
            }
            echo "    \n";
            foreach($url->getArguments() as $name => $var) {

                $this->context['name'] = $name;
                $this->context['var'] = $var;
                echo "    \$req->set(";
                var_export($name);
                echo ", ";
                var_export($var);
                echo ");\n";
            }
            echo "    \$attributes = \$req->attributes->all();\n    foreach (\$args as \$key => \$value) {\n        if (empty(\$attributes[\$key])) {\n            \$attributes[\$key] = \$value;\n        }\n    }\n    \$req->attributes->add(\$attributes);\n    ";
            echo $self->callbackPrepare($url) . "\n    \$req->attributes->set('__handler__', ";
            echo $self->callbackObject($url) . ");\n    \$return = ";
            echo $self->callback($url, '$req') . ";\n\n";
            foreach($url->getFilters('postroute') as $filter) {

                $this->context['filter'] = $filter;
                echo "        " . ($self->callbackPrepare($filter[0])) . "\n        if ( is_array(\$r=";
                echo $self->callback($filter[0], '$req', $filter[1], '$return') . ") ) {\n            \$return = \$r;\n        }\n";
            }
            echo "\n    return true;\n}\n\n";

            if ($return) {
                return ob_get_clean();
            }

        }
    }

    /** 
     *  Template class generated from groups/if.tpl.php
     */
    class class_745a9a8e49cd4450b0d544f3f4422d08c6232d9e extends base_template_48f91366c839e056a4dcd440512f99e82188c46a
    {

        public function hasSection($name)
        {

            return false;
        }


        public function renderSection($name, Array $args = array(), $fail_on_missing = true)
        {
            if (!$this->hasSection($name)) {
                if ($fail_on_missing) {
                    throw new \RuntimeException("Cannot find section {$name}");
                }
                return "";
            }

        }

        public function enhanceException(Exception $e, $section = NULL)
        {
            if (!empty($e->enhanced)) {
                return;
            }

            $message = $e->getMessage() . "( IN " . 'groups/if.tpl.php';
            if ($section) {
                $message .= " | section: {$section}";
            }
            $message .= ")";

            $object   = new ReflectionObject($e);
            $property = $object->getProperty('message');
            $property->setAccessible(true);
            $property->setValue($e, $message);

            $e->enhanced = true;
        }

        public function render(Array $vars = array(), $return = false)
        {
            try {
                return $this->_render($vars, $return);
            } catch (Exception $e) {
                if ($return) ob_get_clean();
                $this->enhanceException($e);
                throw $e;
            }
        }

        public function _render(Array $vars = array(), $return = false)
        {
            $this->context = $vars;

            extract($vars);
            if ($return) {
                ob_start();
            }

            echo "if (" . ($self->getExpr()) . ") {\n    ";
            echo Dispatcher\Templates::get('urls')->render(array('urls' => $self->getUrls()), true) . "\n}\n";

            if ($return) {
                return ob_get_clean();
            }

        }
    }

    /** 
     *  Template class generated from groups/switch.tpl.php
     */
    class class_71415cc4ee21136a1a3e4a031229a7b5762a39df extends base_template_48f91366c839e056a4dcd440512f99e82188c46a
    {

        public function hasSection($name)
        {

            return false;
        }


        public function renderSection($name, Array $args = array(), $fail_on_missing = true)
        {
            if (!$this->hasSection($name)) {
                if ($fail_on_missing) {
                    throw new \RuntimeException("Cannot find section {$name}");
                }
                return "";
            }

        }

        public function enhanceException(Exception $e, $section = NULL)
        {
            if (!empty($e->enhanced)) {
                return;
            }

            $message = $e->getMessage() . "( IN " . 'groups/switch.tpl.php';
            if ($section) {
                $message .= " | section: {$section}";
            }
            $message .= ")";

            $object   = new ReflectionObject($e);
            $property = $object->getProperty('message');
            $property->setAccessible(true);
            $property->setValue($e, $message);

            $e->enhanced = true;
        }

        public function render(Array $vars = array(), $return = false)
        {
            try {
                return $this->_render($vars, $return);
            } catch (Exception $e) {
                if ($return) ob_get_clean();
                $this->enhanceException($e);
                throw $e;
            }
        }

        public function _render(Array $vars = array(), $return = false)
        {
            $this->context = $vars;

            extract($vars);
            if ($return) {
                ob_start();
            }

            echo "switch (" . ($self->getExpr()) . ")\n{\n";
            foreach($self->getUrls() as $case => $urls) {

                $this->context['case'] = $case;
                $this->context['urls'] = $urls;
                if ($case === '') {
                    $zelse = $urls;
                    $this->context['zelse'] = $zelse;
                    continue;
                }
                echo "        case ";
                var_export($case);
                echo ":\n            ";
                echo Dispatcher\Templates::get('urls')->render(array('urls' => $urls), true) . "\n            break;\n";
            }
            echo "\n}\n\n";
            if (!empty($zelse)) {
                echo "    // DEFAULT\n    ";
                echo Dispatcher\Templates::get('urls')->render(array('urls' => $zelse), true) . "\n";
            }

            if ($return) {
                return ob_get_clean();
            }

        }
    }

    /** 
     *  Template class generated from Main.tpl.php
     */
    class class_e3e00f73fbb9382e9bcbf6d5da438f81c0276903 extends base_template_48f91366c839e056a4dcd440512f99e82188c46a
    {

        public function hasSection($name)
        {

            return false;
        }


        public function renderSection($name, Array $args = array(), $fail_on_missing = true)
        {
            if (!$this->hasSection($name)) {
                if ($fail_on_missing) {
                    throw new \RuntimeException("Cannot find section {$name}");
                }
                return "";
            }

        }

        public function enhanceException(Exception $e, $section = NULL)
        {
            if (!empty($e->enhanced)) {
                return;
            }

            $message = $e->getMessage() . "( IN " . 'Main.tpl.php';
            if ($section) {
                $message .= " | section: {$section}";
            }
            $message .= ")";

            $object   = new ReflectionObject($e);
            $property = $object->getProperty('message');
            $property->setAccessible(true);
            $property->setValue($e, $message);

            $e->enhanced = true;
        }

        public function render(Array $vars = array(), $return = false)
        {
            try {
                return $this->_render($vars, $return);
            } catch (Exception $e) {
                if ($return) ob_get_clean();
                $this->enhanceException($e);
                throw $e;
            }
        }

        public function _render(Array $vars = array(), $return = false)
        {
            $this->context = $vars;

            extract($vars);
            if ($return) {
                ob_start();
            }

            echo "<?php\n/**\n *  Router dispatcher generated by crodas/Dispatcher\n *\n *  https://github.com/crodas/Dispatcher\n *\n *  This is a generated file, do not modify it.\n */\n";
            $ns = "crodas\\Dispatcher\\Generate\\t" . uniqid(true);
            $this->context['ns'] = $ns;
            echo "namespace " . ($ns) . ";\n\nuse Dispatcher\\Exception\\NotFoundHttpException;\nuse Symfony\\Component\\HttpFoundation\\Request;\n\nclass Router\n{\n    public function setWrapper(\\Dispatcher\\Router \$wrapper)\n    {\n        \$this->wrapper = \$wrapper;\n        return \$this;\n    }\n\n";
            foreach($self->getComplexUrls() as $id => $url) {

                $this->context['id'] = $id;
                $this->context['url'] = $url;
                Dispatcher\Templates::exec('complexurl', $this->context);
            }
            echo "\n    protected function handleComplexUrl(Request \$req, \$parts, \$length)\n    {\n";
            foreach($self->getComplexUrls() as $id => $url) {

                $this->context['id'] = $id;
                $this->context['url'] = $url;
                echo "            \$is_candidate = \$length >= " . ($url->getMinLength()) . "\n";
                $consts = $url->getConstants();
                $this->context['consts'] = $consts;
                if ($url->getFirstConstant()) {
                    echo "                && \$parts[0] == ";
                    var_export($url->getFirstConstant());
                    echo "\n";
                }
                if ($url->getLastConstant()) {
                    echo "                && \$parts[\$length-1] == ";
                    var_export($url->getLastConstant());
                    echo "\n";
                }
                if (count($consts) > 0) {
                    echo "                && count(array_intersect(\$parts, ";
                    var_export($consts);
                    echo ")) == " . (count($consts)) . "\n";
                }
                echo "                ;\n            if (\$is_candidate && \$this->complexUrl";
                echo $id . "(\$req, \$parts, \$length, \$r) == true) {\n                return \$r;\n            }\n";
            }
            echo "\n";
            if ($self->getNotFoundHandler()) {
                echo "            " . ($self->getNotFoundHandler()) . ";\n";
            }
            echo "        throw new NotFoundHttpException;\n    }\n\n    public function doRoute(Request \$req)\n    {\n        \$uri    = \$req->getRequestUri();\n        \$uri    = (\$p = strpos(\$uri, '?')) ? substr(\$uri, 0, \$p) : \$uri;\n        \$parts  = array_values(array_filter(explode(\"/\", \$uri)));\n        \$length = count(\$parts);\n        \$req->uri = \$uri;\n\n        ";
            echo $groups->__toString() . "\n\n        // We couldn't find any handler for the URL,\n        // let's find in our complex url set (if there is any)\n        \$this->handleComplexUrl(\$req, \$parts, \$length);\n    }\n\n    public static function getRoute(\$name, \$args = array())\n    {\n        if (!is_array(\$args)) {\n            \$args = func_get_args();\n            array_shift(\$args);\n        }\n\n        \$count = count(\$args);\n        switch (\$name) {\n";
            foreach($self->getNamedUrls() as $name => $route) {

                $this->context['name'] = $name;
                $this->context['route'] = $route;
                echo "        case ";
                var_export($name);
                echo ":\n";
                foreach($route['routes'] as $id => $url) {

                    $this->context['id'] = $id;
                    $this->context['url'] = $url;
                    echo "                if (" . ($url->getGeneratorFilter()) . ") {\n                    return ";
                    echo $url->getGeneratorExpr() . ";\n                }\n";
                }
                echo "            throw new RouteNotFoundException(\"Invalid arguments for route " . ($name) . ", possible routes:\\n" . ($route['exception']) . "\");\n            break;\n";
            }
            echo "        }\n\n        throw new RouteNotFoundException(\"There is not route name \$name\");\n    }\n\n}\n\nreturn new Router;\n";

            if ($return) {
                return ob_get_clean();
            }

        }
    }

    /** 
     *  Template class generated from url.tpl.php
     */
    class class_bcdf040d0776ca67087d70f20e8996e6c1f0ca9d extends base_template_48f91366c839e056a4dcd440512f99e82188c46a
    {

        public function hasSection($name)
        {

            return false;
        }


        public function renderSection($name, Array $args = array(), $fail_on_missing = true)
        {
            if (!$this->hasSection($name)) {
                if ($fail_on_missing) {
                    throw new \RuntimeException("Cannot find section {$name}");
                }
                return "";
            }

        }

        public function enhanceException(Exception $e, $section = NULL)
        {
            if (!empty($e->enhanced)) {
                return;
            }

            $message = $e->getMessage() . "( IN " . 'url.tpl.php';
            if ($section) {
                $message .= " | section: {$section}";
            }
            $message .= ")";

            $object   = new ReflectionObject($e);
            $property = $object->getProperty('message');
            $property->setAccessible(true);
            $property->setValue($e, $message);

            $e->enhanced = true;
        }

        public function render(Array $vars = array(), $return = false)
        {
            try {
                return $this->_render($vars, $return);
            } catch (Exception $e) {
                if ($return) ob_get_clean();
                $this->enhanceException($e);
                throw $e;
            }
        }

        public function _render(Array $vars = array(), $return = false)
        {
            $this->context = $vars;

            extract($vars);
            if ($return) {
                ob_start();
            }

            if ($expr) {
                echo "    " . ($url->exprPrepare()) . "\n    if (";
                echo $expr . ") {\n";
            }
            echo "\n";
            foreach($url->getArguments() as $name => $var) {

                $this->context['name'] = $name;
                $this->context['var'] = $var;
                echo "    \$req->get(";
                var_export($name);
                echo ", ";
                var_export($var);
                echo ");\n";
            }
            echo "\n    \$attributes = \$req->attributes->all();\n    \$merge      = false;\n";
            foreach($url->getVariables() as $name => $var) {

                $this->context['name'] = $name;
                $this->context['var'] = $var;
                if (count($var) == 1) {
                    $variable = "parts[" . $var[0] . "]";
                    $this->context['variable'] = $variable;
                }
                else {
                    $variable = "matches_" . $var[0] . "[" . $var[1] . "]";
                    $this->context['variable'] = $variable;
                }
                echo "        if (empty(\$attributes[";
                var_export($name);
                echo "])) {\n            \$attributes[";
                var_export($name);
                echo "] = \$" . ($variable) . ";\n            \$merge = true;\n        }\n";
            }
            echo "\n    if (\$merge) {\n        \$req->attributes->add(\$attributes);\n    }\n\n    \$allow = true;\n";
            if (count($preRoute) > 0) {
                echo "        //run preRoute filters\n";
                foreach($preRoute as $filter) {

                    $this->context['filter'] = $filter;
                    echo "            " . ($compiler->callbackPrepare($filter[0])) . "\n            if (\$allow) {\n                \$allow &= (";
                    echo $compiler->callback($filter[0], '$req', $filter[1]) . ") !== false;\n            }\n";
                }
            }
            echo "\n    if (\$allow) {\n        ";
            echo $compiler->callbackPrepare($url) . "\n        \$req->attributes->__handler__ = ";
            echo $compiler->callbackObject($url->getAnnotation()) . ";\n        \$response = ";
            echo $compiler->callback($url, '$req') . ";\n\n";
            foreach($postRoute as $filter) {

                $this->context['filter'] = $filter;
                echo "            " . ($compiler->callbackPrepare($filter[0])) . "\n            \$return = ";
                echo $compiler->callback($filter[0], '$req', $filter[1], '$response') . ";\n            if (is_array(\$return)) {\n                \$response = \$return;\n            }\n";
            }
            echo "\n        return \$response;\n    }\n\n\n";
            if ($expr) {
                echo "    }\n";
            }

            if ($return) {
                return ob_get_clean();
            }

        }
    }

    /** 
     *  Template class generated from urls.tpl.php
     */
    class class_c2276662ea4974cb085a05fe2d4490ddbb0e2e41 extends base_template_48f91366c839e056a4dcd440512f99e82188c46a
    {

        public function hasSection($name)
        {

            return false;
        }


        public function renderSection($name, Array $args = array(), $fail_on_missing = true)
        {
            if (!$this->hasSection($name)) {
                if ($fail_on_missing) {
                    throw new \RuntimeException("Cannot find section {$name}");
                }
                return "";
            }

        }

        public function enhanceException(Exception $e, $section = NULL)
        {
            if (!empty($e->enhanced)) {
                return;
            }

            $message = $e->getMessage() . "( IN " . 'urls.tpl.php';
            if ($section) {
                $message .= " | section: {$section}";
            }
            $message .= ")";

            $object   = new ReflectionObject($e);
            $property = $object->getProperty('message');
            $property->setAccessible(true);
            $property->setValue($e, $message);

            $e->enhanced = true;
        }

        public function render(Array $vars = array(), $return = false)
        {
            try {
                return $this->_render($vars, $return);
            } catch (Exception $e) {
                if ($return) ob_get_clean();
                $this->enhanceException($e);
                throw $e;
            }
        }

        public function _render(Array $vars = array(), $return = false)
        {
            $this->context = $vars;

            extract($vars);
            if ($return) {
                ob_start();
            }

            if (is_array($urls)) {
                foreach($urls as $id => $url) {

                    $this->context['id'] = $id;
                    $this->context['url'] = $url;
                    echo "        " . (Dispatcher\Templates::get('urls')->render(array('urls' => $url), true)) . "\n";
                }
            }
            else {
                echo "    " . ($urls) . "\n";
            }

            if ($return) {
                return ob_get_clean();
            }

        }
    }

}

namespace Dispatcher {


    class Templates
    {
        public static function getAll()
        {
            return array (
                0 => 'callback',
                1 => 'complexurl',
                2 => 'groups/if',
                3 => 'groups/switch',
                4 => 'main',
                5 => 'url',
                6 => 'urls',
            );
        }

        public static function getAllSections($name, $fail = true)
        {
            switch ($name) {
            default:
                if ($fail) {
                    throw new \RuntimeException("Cannot find section {$name}");
                }

                return array();
            }
        }

        public static function exec($name, Array $context = array(), Array $global = array())
        {
            $tpl = self::get($name);
            return $tpl->render(array_merge($global, $context));
        }

        public static function get($name, Array $context = array())
        {
            static $classes = array (
                'callback.tpl.php' => 'class_d5b1e9c7792768d5c2401b262ea8a886c76d1f6a',
                'callback' => 'class_d5b1e9c7792768d5c2401b262ea8a886c76d1f6a',
                'complexurl.tpl.php' => 'class_ae8225d480777bd6e834b5ab827505af67d3fdf8',
                'complexurl' => 'class_ae8225d480777bd6e834b5ab827505af67d3fdf8',
                'groups/if.tpl.php' => 'class_745a9a8e49cd4450b0d544f3f4422d08c6232d9e',
                'groups/if' => 'class_745a9a8e49cd4450b0d544f3f4422d08c6232d9e',
                'groups/switch.tpl.php' => 'class_71415cc4ee21136a1a3e4a031229a7b5762a39df',
                'groups/switch' => 'class_71415cc4ee21136a1a3e4a031229a7b5762a39df',
                'main.tpl.php' => 'class_e3e00f73fbb9382e9bcbf6d5da438f81c0276903',
                'main' => 'class_e3e00f73fbb9382e9bcbf6d5da438f81c0276903',
                'url.tpl.php' => 'class_bcdf040d0776ca67087d70f20e8996e6c1f0ca9d',
                'url' => 'class_bcdf040d0776ca67087d70f20e8996e6c1f0ca9d',
                'urls.tpl.php' => 'class_c2276662ea4974cb085a05fe2d4490ddbb0e2e41',
                'urls' => 'class_c2276662ea4974cb085a05fe2d4490ddbb0e2e41',
            );
            $name = strtolower($name);
            if (empty($classes[$name])) {
                throw new \RuntimeException("Cannot find template $name");
            }

            $class = "\\" . $classes[$name];
            return new $class;
        }
    }

}
