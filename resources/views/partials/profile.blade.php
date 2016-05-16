<div class="modal fade" tabindex="-1" id="user-profile">
 <div class="modal-dialog modal-info" >
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload Profile Picture</h4>
    </div>
    <div class="modal-body">
        <div class="upload-container">
          @include('adminlte::partials._profile_form')
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="profile-cancel" class="btn btn-default close-button" data-dismiss="modal">Close</button>
        <button type="button" id="profile-save" class="btn btn-primary">Save changes</button>
    </div>
  </div>
 </div>
</div>
@section('user-scripts')
<script>
    $(document).ready(function(){

        function setupAvatarEdit() {
            var $uploadCrop;

            function ajaxAvatar(){
                //new upload
                $('#profile-image').on('change', function () {
                    readFile(this);
                });

                //send ajax
                $('#profile-form').on('submit',function(){

                    $.ajax({
                        type: this.method,
                        url: this.action,
                        dataType: 'json',
                        data: {
                            imagebase64:this.elements['imagebase64'].value,
                            _token:this.elements['_token'].value
                        },
                        success:function(resp){
                            $('.avatar').attr('src',resp.avatar);
                            $('#user-profile').modal('hide');
                        }
                    });

                    return false;
                });

                //save changes
                $('#profile-save').on('click', function (ev) {
                    $uploadCrop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function (resp) {
                        $('#imagebase64').val(resp);
                        $('#profile-form').submit();
                    });
                });
            }

            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        });
                        $('.upload-form').addClass('ready');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
                else {
                    swal("Sorry - you're browser doesn't support the FileReader API");
                }
            }

            function initCroppie(){

                $uploadCrop = $('#upload-target').croppie({
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'square'
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    }
                });

                bindImg();
            }

            function bindImg(){
                var profile = $('.avatar').get(0).src+'?rnd='+(Math.random()+'').split('.')[1];
                $uploadCrop.croppie('bind', {
                    url: profile
                });
            }

            function refreshCroppie(){
                $('#upload-target').croppie('bind');
                $('#upload-target').croppie('setZoom', 0);
                $('#upload-target').croppie('setZoom', 0);
            }

            $('#user-profile').on('show.bs.modal', function () {
                refreshCroppie();
            });

            $('#user-profile').on('shown.bs.modal', function () {
                refreshCroppie();
            });

            $('#user-profile').on('hidden.bs.modal', function() {
                $('#profile-form').get(0).reset();
                bindImg();
            })

            initCroppie();
            ajaxAvatar();
        }

        setupAvatarEdit();
    });
</script>
@append
