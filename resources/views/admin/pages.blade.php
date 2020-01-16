@extends('layouts.admin')

@section('title')
    Pages | Admin Dashboard
@endsection

@section('content')

{{-- Delete Modal --}}
<!-- Modal -->
<div class="modal fade" id="deleteModalpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Do you want to delete it?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="deleteModalInner" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
    </form>
      </div>
    </div>
  </div>

{{-- POPUP MODAL --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Story</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/add-story" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Name</label>
              <input type="text" name='name' class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Profile Url</label>
              <input type="text" class="form-control" name='profile' id="profile-url"></textarea>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Story Url</label>
              <input type="text" class="form-control" name='url' id="story-url"></textarea>
            </div>
            <div class="form-group " >
                <p class="font-weight-normal">Type</p>
                <select name="type" class="form-control">
                    <option value="admin">Image</option>
                    <option value="user">Video</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Story</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
{{-- POPUP MODAL --}}
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Add Pages

            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">Add Stories</button>

          </h4>
          @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
         @elseif (session('warning'))`
         <div class="alert alert-warning" role="alert">
            {{ session('warning') }}
        </div>
         @endif
         {{-- Add Button --}}

        </div>
        <style>
            .w-10p{
                width: 10% !important;
            }
        </style>
        <div class="card-body">
          <div class="table-responsive">
            <table id="storyTable" class="table">
              <thead class=" text-primary">
                <th>ID</th>
                <th class='w-10p'>Name</th>
                <th class='w-15p'>Profile</th>
                <th class='w-15p'>Url</th>
                <th class="text-right">EDIT</th>
                <th class="text-right">DELETE</th>
              </thead>
              <tbody>
                  @foreach ($pages as $item)
                <tr>
                  <td>{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>
                    <div class="container">
                        <div class="col-md-8  px-0">
                        <img src="{{$item->profile}}" class="img-fluid">
                        </div>
                     </div>
                  </td>
                  <td class="text-left">

                    @if ($item->type=='image')
                    <div class="container">
                        <div class="col-md-8  px-0">
                        <img src="{{$item->url}}" class="img-fluid img-thumbnail">
                        </div>
                     </div>
                    @else
                     <div class="container">
                        <video width="220" height="140" controls>
                            <source src="{{$item->url}}" type="video/mp4">
                        </video>
                     </div>
                    @endif
                  </td>
                  <td class="text-right">
                    <a href="/pages/{{$item->id}}" class="btn btn-success">EDIT</a>
                  </td>
                  <td class="text-right">
                    <a href="javascript:void(0)" data-target="deleteModalpop" data-toggle="modal" class="btn btn-danger deletebtn">DELETE</a>
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
    $('#storyTable').DataTable();
    $('#storyTable').on('click','.deletebtn',function(){
       $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function(){
            return $(this).text();
        }).get();
        $('#deleteModalInner').attr('action','/delete-story/'+data[0]);
        $('#deleteModalpop').modal('show');
    })
} );
</script>
@endsection
