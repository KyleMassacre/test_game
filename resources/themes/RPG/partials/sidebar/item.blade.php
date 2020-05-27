@php
/**
* @var $item \Maatwebsite\Sidebar\Item
**/
@endphp
<li>
    <a href="{{ $item->getUrl() }}">{{ $item->getName() }} @if($active)<span class="sr-only">(current)</span> @endif
    @foreach($badges as $badge)
    {!! $badge !!}
    @endforeach
    </a>
</li>
{{--<li class="list-group-item">--}}
    {{--<a class="nav-link @if($item->getItemClass()){{ $item->getItemClass() }}@endif @if($active)active @endif" href="{{ $item->getUrl() }}">--}}
        {{--{{ $item->getName() }} @if($active)<span class="sr-only">(current)</span> @endif--}}
    {{--</a>--}}
    {{--@foreach($badges as $badge)--}}
        {{--{!! $badge !!}--}}
    {{--@endforeach--}}
{{--</li>--}}

