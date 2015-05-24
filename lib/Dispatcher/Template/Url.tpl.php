@if ($expr)
    {{ $url->exprPrepare() }}
    if ({{$expr}}) {
@end

    @foreach ($url->getArguments() as $name => $var)
    $req->get({{@$name}}, {{@$var}});
    @end

    @foreach ($url->getVariables() as $name => $var)
        @if (count($var) == 1)
            @set($variable, "parts[" . $var[0] . "]")
        @else
            @set($variable, "matches_" . $var[0] . "[" . $var[1] . "]")
        @end
        $req->setIfEmpty({{@$name}}, ${{$variable}});
    @end

    $allow = true;
    @if (count($preRoute) > 0) 
        //run preRoute filters
        @foreach ($preRoute as $filter)
            {{ $compiler->callbackPrepare($filter[0]) }}
            if ($allow) {
                $allow &= ({{$compiler->callback($filter[0], '$req', $filter[1])}}) !== false;
            }
        @end
    @end

    if ($allow) {
        {{ $compiler->callbackPrepare($url) }}
        $req->setIfEmpty('__handler__', {{$compiler->callbackObject($url->getAnnotation())}});
        $response = {{ $compiler->callback($url, '$req') }};

        @foreach ($postRoute as $filter)
            $return = {{$compiler->callback($filter[0], '$req', $filter[1], '$response') }};
            if (is_array($return)) {
                $response = $return;
            }
        @end

        return $response;
    }


@if ($expr)
    }
@end 
