@extends('layouts.admin')

@section('title')
    Edit User | Admin Dashboard
@endsection

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Roles and Permissions</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                    <form action="/update-role/{{$users->id}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <p class="font-weight-normal"> Name</p>
                                <input type="text" class="form-control" value="{{$users->name}}" name="username">
                            </div>
                            <div class="form-group " >
                                <p class="font-weight-normal">Give Role</p>
                                <select name="usertype" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="vendor">Vendor</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Update Role</button>
                            <a href="/add-roles" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
