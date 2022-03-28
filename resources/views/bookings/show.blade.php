@extends('layouts.app')

@section('content')
    <dl>
        @foreach($booking->getAttributes() as $name => $value)  {{-- $value потом не используется  --}}
            <dt>{{ $name }}  </dt>              {{-- например, "room_id"  --}}
            <dd>{{ $booking->$name }}  </dd>    {{-- например, "$booking->room_id" == 4  --}}
        @endforeach
    </dl>

@endsection