<table>
    <tr>
        <th></th>
        <th>Path</th>
        <th>Route</th>
        <th>Uses</th>
        <th>Before</th>
        <th>After</th>
    </tr>
    <?php $routes = Route::getRoutes(); ?>
    @foreach($routes as $name => $route)
        @if ( Route::currentRouteName() == $name)
        <tr class="highlight">
        @else
        <tr>
        @endif
        <?php
        $beforeFilters = $route->beforeFilters();
        $strBeforeFilters = array();
        foreach ($beforeFilters as $filter => $params):
            $strBeforeFilters[] = $filter.($params?":".implode(",", $params):"");
        endforeach;
        $afterFilters = $route->afterFilters();

        $strAfterFilters = array();
        foreach ($afterFilters as $filter => $params):
            $strAfterFilters[] = $filter.($params?":".implode(",", $params):"");
        endforeach;
        ?>
            <td>[{{ array_get($route->getMethods(), 0) }}]</td>
            <td>{{ $route->getPath() }}</td>
            <td>{{ $name }}</td>
            <td>{{ $route->getActionName() ?: 'Closure' }}</td>
            <td>{{ implode('|', $strBeforeFilters) }}</td>
            <td>{{ implode('|', $strAfterFilters) }}</td>
        </tr>
    @endforeach
</table>