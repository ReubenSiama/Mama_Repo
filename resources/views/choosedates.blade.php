@extends('layouts.app')

@section('content')
<div class="col-md-4 col-md-offset-4">
<h2>Choose date</h2>
@foreach($dates as $date)
<a href="{{ URL::to('/') }}/{{ $uid }}/{{ $date }}/viewreports">{{ $date }}</a>
@endforeach
</div>
@endsection