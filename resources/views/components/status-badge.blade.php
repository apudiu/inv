@switch($status)
    @case('due')
        <span class="badge blue-grey white-text text-capitalize">{{ $status }}</span>
    @break
    @case('draft')
        <span class="badge blue-grey white-text text-capitalize">{{ $status }}</span>
    @break
    @case('partial')
        <span class="badge blue darken-2 white-text text-capitalize">{{ $status }}</span>
    @break
    @case('sent')
        <span class="badge blue darken-2 white-text text-capitalize">{{ $status }}</span>
    @break
    @case('billed')
        <span class="badge green darken-3 white-text text-capitalize">{{ $status }}</span>
    @break
    @case('accepted')
        <span class="badge green darken-3 white-text text-capitalize">{{ $status }}</span>
    @break
    @default
        <span class="badge teal white-text text-capitalize">{{ $status }}</span>
    @break
@endswitch
