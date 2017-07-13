@if ($active)
    @include('panel::_components.deactivateButton', ['route' => $deactivate_route])
@else
    @include('panel::_components.activateButton', ['route' => $activate_route])
@endif