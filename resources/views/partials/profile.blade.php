<div class="modal fade" tabindex="-1" id="user-profile">
 <div class="modal-dialog" >
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload Profile Picture</h4>
    </div>
    <div class="modal-body">
        <div id="load" class="display-none" style="width:32px;margin:150px auto;"><img src="img/loading2.gif"></div>
        <div class="upload-container">
          @include('adminlte::partials._profile_form')
        </div>
        <div id="image-box" class="image display-none" style="text-align:center;">
            <img id="large-image" src="img/loading2.gif" style="max-width:100%;max-height:500px;display:inline-block;">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default close-button" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
  </div>
 </div>
</div>