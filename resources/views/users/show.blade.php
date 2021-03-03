@extends('layouts.defaults')

@section('title', $user->name.'-个人信息')

@section('styles')
<link rel="stylesheet" href="{{ mix('css/cropper.min.css') }}">
<link rel="stylesheet" href="{{ mix('css/sitelogo.css') }}">
@endsection

@section('content')
<div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
    <div class="card ">
        <div id="crop-avatar">
          <div class="@can('update', $user) avatar-view @endcan"><img class="card-img-top" src="{{ $user->avatar }}"  alt="{{ $user->name }}"></div>
        </div>
        <div class="card-body">
            <h5><strong>个人简介</strong></h5>
            <p>{{ $user->introduction?:'这个人很懒，还没有编写简介~' }}</p>
            <hr>
            <h5><strong>注册于</strong></h5>
            <p>{{ $user->created_at->diffForHumans() }}</p>
            <hr>
            <h5><strong>活跃于</strong></h5>
            <p>{{ $user->last_actived_at->diffForHumans() }}</p>
        </div>
    </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <div class="card ">
        <div class="card-body">
            <h1 class="mb-0" style="font-size:22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
        </div>
    </div>
    <hr>

    {{-- 用户发布的内容 --}}
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs">
          <li class="nav-item"><a class="nav-link bg-transparent {{active_class(!if_query('tab','replies'))}} " href="{{ Request::url() }}?tab=topic">Ta 的话题</a></li>
          <li class="nav-item"><a class="nav-link bg-transparent {{active_class(if_query('tab','replies'))}} " href="{{ Request::url() }}?tab=replies">Ta 的回复</a></li>
        </ul>
        @if(!if_query('tab','replies'))
          @include('users._topics', ['topics' => $user->topics()->recent()->paginate(10)])
        @else
          @include('users._replies', ['replies'=> $user->replies()->with('topic')->recent()->paginate(10)])
        @endif
      </div>
    </div>

    </div>
</div>
@can('update', $user)
<div class="modal fade show" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form class="avatar-form" action="{{ route('users.update_avatar', $user->id) }}" enctype="multipart/form-data" method="post">
              {{ csrf_field() }}
              {{ method_field('put')}}

              <div class="modal-header" style="display: block;">
                  <button class="close" data-dismiss="modal" type="button">&times;</button>
                  <h4 class="modal-title" id="avatar-modal-label">修改头像</h4>
              </div>
              <div class="modal-body">
                  <div class="avatar-body">
                      <div class="avatar-upload">
                          <input class="avatar-src" name="avatar_src" type="hidden">
                          <input class="avatar-data" name="avatar_data" type="hidden">
                          <label for="avatarInput">图片上传</label>
                          <input class="avatar-input" id="avatarInput" name="avatar_input" type="file"></div>
                      <div class="row">
                          <div class="col-md-9">
                              <div class="avatar-wrapper"></div>
                          </div>
                          <div class="col-md-3">
                              <div class="avatar-preview preview-lg"></div>
                              <div class="avatar-preview preview-md"></div>
                              <div class="avatar-preview preview-sm"></div>
                          </div>
                      </div>
                      <div class="row avatar-btns">
                          <div class="col-md-9">
                              <div class="btn-group">
                                  <button class="btn" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees" style="background-color: #eee">
                                    <i class="fa fa-undo"></i> 
                                  向左旋转</button>
                              </div>
                              <div class="btn-group">
                                  <button class="btn" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees" style="background-color: #eee">
                                    <i class="fa fa-repeat"></i> 
                                    向右旋转</button>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <button class="btn btn-success btn-block avatar-save" type="submit"><iclass="fa fa-save"></i> 保存修改</button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
</div>
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
@endcan
@stop

@section('scripts')
<script src="{{ mix('js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ mix('js/cropper.min.js') }}"></script>
<script src="{{ mix('js/sitelogo.js') }}"></script>
<script src="{{ mix('js/bootstrap.min.js') }}"></script>
@endsection