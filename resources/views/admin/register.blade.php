@extends('layouts.admin')

@section('title')
    Add User | Admin Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Registered Roles</h4>
          @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
         @elseif (session('warning'))
         <div class="alert alert-warning" role="alert">
            {{ session('warning') }}
        </div>
         @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="roles" class="table">
              <thead class=" text-primary">
                <th>ID</th>
                <th>Name</th>
                <th>User Type</th>
                <th>Email</th>
                <th class="text-right">EDIT</th>
                <th class="text-right">DELETE</th>
              </thead>
              <tbody>
                  @foreach ($users as $item)
                <tr>
                  <td>{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->usertype}}</td>
                  <td>{{$item->email}}</td>
                  <td class="text-right">
                    <a href="/role-edit/{{$item->id}}" class="btn btn-success">EDIT</a>
                  </td>
                  <td class="text-right">
                      <form action="/role-delete/{{$item->id}}" method="post">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger">DELETE</button>
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
@endsection

@section('scripts')
<script>
    $(document).ready( function () {
        $('#roles').DataTable();
    } );
    </script>
@endsection
