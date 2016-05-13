{!! Form::open(['route' => ['profile'], 'file' => true, 'method' => 'post', 'id' => 'profile-image-upload']) !!}

<div class="alert alert-danger display-none error">
     <p>File must be an image</p>
 </div>

 <div class="form-group">
  {!! Form::label('upload', 'Upload Photo') !!}
  {!! Form::file('upload', ['id' => 'file-select', 'class' => 'form-control upload-box']) !!}
 </div>

{!! Form::close() !!}