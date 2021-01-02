@extends('layouts.app')


@section('content')
<div class="d-flex">
    <div class="p-2">
        <h2>Users Management</h2>
    </div>

    @can('user-create')
        <div class="ml-auto p-2">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
    @endcan
</div>

<br/>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<br/>

<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>

        @can('user-edit')
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        @endcan

        @can('user-delete')
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{ $i }}">Delete</button>

            <!-- Modal -->
            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            <div id="myModal{{ $i }}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-center">Are you sure you want to delete {{ $user->name }} ?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        @endcan

    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}

@endsection
