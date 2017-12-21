@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $user->employeeId }} : {{ $user->name }}
                </div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td>Name</td>
                            <td>: {{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td>: {{ $user->department->dept_name }}</td>
                        </tr>
                        <tr>
                            <td>Designation: </td>
                            <td>
                                {{ $user->group->group_name }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <a href="{{ URL::to('/') }}/home" class="btn btn-default form-control">Back</a>
        </div>
    </div>
</div>
@endsection
