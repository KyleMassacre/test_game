<?php
/**
 * @var $group \Maatwebsite\Sidebar\Domain\DefaultGroup
 */
?>
@if($group->shouldShowHeading())
   <li>
       <a href="#{{ $group->getName() }}Submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{ $group->getName() }}</a>
@endif
<li>

    @foreach($items as $item)
        @if($group->shouldShowHeading())
            <ul class="collapse list-unstyled" id="{{ $group->getName() }}Submenu">
        @endif
            {!! $item !!}
        @if($group->shouldShowHeading())
            </ul>
        @endif
    @endforeach
</li>
@if($group->shouldShowHeading())
    </li>
@endif
{{--<div class="py-sm-1 py-md-2">--}}
    {{--<div class="card card-default">--}}
        {{--<div class="card-header">{{ $group->getName() }}</div>--}}
        {{--<div class="card-body sidemenu">--}}
            {{--<ul class="list-group list-group-flush">--}}
                {{--@foreach($items as $item)--}}
                    {{--{!! $item !!}--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
