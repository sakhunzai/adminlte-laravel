{!! Form::open(['route' => ['profile'], 'file' => true, 'method' => 'post', 'class'=>'profile-form', 'id'=>'profile-form']) !!}

 <div class="form-group">
  <div id="upload-target"></div>
  <input type="hidden" id="imagebase64" name="imagebase64">
  {!! Form::file('upload', ['id' => 'profile-image',  'accept'=>"image/*", 'class' => 'btn btn-default btn-sm']) !!}
 </div>

{!! Form::close() !!}