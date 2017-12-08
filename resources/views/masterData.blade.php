@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Countries</div>
                <div class="panel-body">
                    <form method="POST" action="/addCountry">
                        {{ csrf_field() }}
                        <table class="table">
                            <tr>
                                <td><input required type="text" class="form-control input-sm" name="code" placeholder="Code"></td>
                                <td><input required type="text" class="form-control input-sm" name="name" placeholder="Country Name"></td>
                                <td><input type="submit" class="btn btn-primary btn-sm" value="Add"></td>
                            </tr>
                        </table>
                    </form>
                    <table class="table">
                        <thead>
                            <th>Country Code</th>
                            <th>Country Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($countries as $country)
                                <tr>
                                    <td>{{ $country->country_code }}</td>
                                    <td>{{ $country->country_name }}</td>
                                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">States</div>
                <div class="panel-body">
                    <form method="POST" action="/addState">
                            {{ csrf_field() }}
                            <table class="table">
                                <tr>
                                    <td>
                                        <select class="form-control input-sm" name="zone_id" required>
                                            <option value="">--Zones--</option>
                                            @foreach($zones as $zone)
                                            <option value="{{ $zone->id }}">{{ $zone->zone_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="state_name" required class="form-control input-sm" placeholder="State Name"></td>
                                    <td><button type="submit" class="btn btn-success input-sm">Add</button></td>
                                </tr>
                            </table>
                        </form>
                        <table class="table">
                            <thead>
                                    <th>Country</th>
                                    <th>State Name</th>
                                </thead>
                                <tbody>
                                    @foreach($states as $state)
                                        <tr>
                                            <td>{{ $state->zone->country->country_name }} - ({{ $state->zone->country->country_code }})</td>
                                            <td>{{ $state->state_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Zones
                    @if(session('ErrorZone'))
                        <div class="alert-danger pull-right">{{ session('ErrorZone' )}}</div>
                    @endif 
                </div>
                <div class="panel-body">
                    <form method="POST" action="/addZone">
                            {{ csrf_field() }}
                            <table class="table">
                                <tr>
                                    <td>
                                        <select class="form-control input-sm" name="sId" required="">
                                            <option value="">--Country--</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="zone_name" required class="form-control input-sm" placeholder="Zone Name"></td>
                                    <td><button type="submit" class="btn btn-success input-sm">Add</button></td>
                                </tr>
                            </table>
                        </form>
                        <table class="table">
                            <thead>
                                    <th>Country</th>
                                    <th>Zone Name</th>
                                </thead>
                                <tbody>
                                    @foreach($zones as $zone)
                                        <tr>
                                            <td>{{ $zone->country->country_name }} </td>
                                            <td>{{ $zone->zone_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Wards</div>
                <div class="panel-body">
                    <form method="POST" action="/addWard" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <table class="table">
                            <tr>
                                <td>
                                    <select name="country" required class="input-sm form-control">
                                        <option value="">--Country--</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select required name="zone" class="input-sm form-control">
                                        <option value="">--Zone--&nbsp;&nbsp;&nbsp;</option>
                                        @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->zone_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select required name="state" class="input-sm form-control">
                                        <option value="">--State--&nbsp;&nbsp;&nbsp;</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" name="name" required placeholder="Ward Name" class="form-control input-sm"></td>
                                <td><input type="file" name="image" required class="form-control input-sm" accept="image/*"></td>
                            </tr>
                        </table>
                        <button type="submit" class="form-control btn btn-success input-sm">Add</button>
                    </form>
                    <br>
                        <table class="table">
                            <thead>
                                <th>Ward Name</th>
                                <th>Ward Image</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                    @foreach($wards as $ward)
                                    <tr>
                                        <td>{{ $ward->ward_name }}</td>
                                        <td><a href="{{ URL::to('/') }}/wardImages/{{ $ward->ward_image }}">Click Here to view image</a></td>
                                        <th><button class="btn btn-danger input-sm">Delete</button></th>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Sub Wards</div>
                <div class="panel-body">
                    <form method="POST" action="/addSubWard" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <table class="table">
                            <tr>
                                <td>
                                    <select name="ward" required class="form-control input-sm">
                                        <option value="">Ward&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                        @foreach($wards as $ward)
                                        <option value="{{ $ward->id }}">{{ $ward->ward_name }}</option>
                                        @endforeach
                                    </select>

                                </td>
                                <td><input type="text" name="name" required placeholder="Subward Name" class="form-control input-sm"></td>
                                <td><input type="file" name="image" required class="form-control input-sm" accept="image/*"></td>
                                <td><button type="submit" class="btn btn-success input-sm">Add</button></td>
                            </tr>
                        </table>
                    </form>
                        <table class="table">
                            <thead>
                                <th>Subward Name</th>
                                <th>Ward Image</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                    @foreach($subwards as $ward)
                                    <tr>
                                        <td>{{ $ward->sub_ward_name }}</td>
                                        <td><a href="{{ URL::to('/')}}/subWardImages/{{ $ward->sub_ward_image}}">Click Here to view image</a></td>
                                        <th><button class="btn btn-danger input-sm">Delete</button></th>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
