@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Employee List
                    <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#addEmployee">Add Employee</button>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->employeeId }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->department->dept_name }}</td>
                                <td>
                                    @if($user->group_id == 0)
                                    <a href="" data-toggle="modal" data-target="#assignDesignation{{ $user->id }}">Designation</a>
                                    @else
                                    <a href="" data-toggle="modal" data-target="#assignDesignation{{ $user->id }}">{{ $user->group->group_name }}</a>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ URL::to('/') }}/deleteEmployee">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="btn-group">                                  
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        <a href="{{ URL::to('/') }}/{{ $user->employeeId }}/view" class="btn btn-sm btn-success">View</a>
                                    </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Departments
                    @if(session('Error'))
                        <p class="alert-danger pull-right"> {{ session('Error') }}</p>
                    @endif
                    @if(session('Success'))
                        <p class="alert-success pull-right"> {{ session('Success') }}</p>
                    @endif
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ URL::to('/') }}/addDepartment">
                        {{ csrf_field() }}
                        <table class="col-md-12">
                            <tr>
                                <td>
                                    <input type="text" required autosave="off" autocomplete="off" name="dept_name" class="form-control input-sm" placeholder="Department Name">
                                </td>
                                <td>
                                    <input type="submit" value="Add" class="btn btn-success btn-sm pull-right">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Department Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                            <tr>
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->dept_name }}</td>
                                <td>
                                    <form method="POST" action="{{ URL::to('/') }}/deleteDepartment">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $department->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-8">
            <div class="panel panel-default">
                <div class="panel-heading">Designations</div>
                <div class="panel-body">
                    <form method="POST" action="{{ URL::to('/') }}/addDesignation">
                        {{ csrf_field() }}
                        <table class="col-md-12">
                            <tr>
                                <td>
                                    <input type="text" required autosave="off" autocomplete="off" name="desig_name" class="form-control input-sm" placeholder="Designation Name">
                                </td>
                                <td>
                                    <input type="submit" value="Add" class="btn btn-success btn-sm pull-right">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Designation Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($groups as $department)
                            <tr>
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->group_name }}</td>
                                <td>
                                    <form method="POST" action="{{ URL::to('/') }}/deleteDesignation">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $department->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<form method="POST" action="{{ URL::to('/') }}/addEmployee">
{{ csrf_field() }}    
    <div id="addEmployee" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Enter Employee Details</h4>
          </div>
          <div class="modal-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Id:</td>
                        <td><input required name="emp_id" type="text" class="form-control input-sm" placeholder="Id"></td>
                        <td>Name:</td>
                        <td><input required name="name" type="text" class="form-control input-sm" placeholder="Name"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input required name="email" type="email" class="form-control input-sm" placeholder="Email"></td>
                        <td>Department:</td>
                        <td>
                            <select required name="dept" class="form-control">
                                <option value="">--Select--</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}"> {{ $department->dept_name}} </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success pull-left">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
</form>

@foreach($users as $user)
<!-- Modal -->
<form method="POST" action="{{ URL::to('/') }}/{{ $user->id }}/assignDesignation">
{{ csrf_field() }}    
    <div id="assignDesignation{{ $user->id }}" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Assign Designation</h4>
          </div>
          <div class="modal-body">
            Choose Designation:<br>
            <select name="designation" class="form-control">
                <option value="">--Select--</option>
                @foreach($groups as $group)
                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                @endforeach
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success pull-left">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
</form>
@endforeach
@endsection
