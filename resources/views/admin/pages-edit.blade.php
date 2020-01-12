@extends('layouts.admin')

@section('title')
    Edit Story | Admin Dashboard
@endsection

@section('content')
<style>
    .form-group{
        width: 30%
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">
                        Edit Story
                    </h1>
                    <form action="{{url('edit-story/'.$pages->id)}}". method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" name='name' value="{{$pages->name}}" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Profile Url</label>
                          <input type="text" value="{{$pages->profile}}" class="form-control" name='profile' id="profile-url"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Story Url</label>
                          <input type="text" value="{{$pages->url}}"  class="form-control" name='url' id="story-url"></textarea>
                        </div>
                        <div class="form-group " >
                            <p class="font-weight-normal">Type</p>
                            <select name="type" class="form-control" >
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <a href="{{url('pages')}}" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
