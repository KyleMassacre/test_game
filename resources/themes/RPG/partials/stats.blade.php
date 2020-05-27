<li class="stat" id="stat{{ ucfirst($stat->name) }}">
@if($stat->percentage)
    {{ $stat->name }}: {{ $stat->percentage }}%
@else
    {{ $stat->name }}: {!! $stat->formatted !!}
@endif
</li>
