<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script>
	$(document).ready(function(){
		/*$('#customFile').change(function(){
		 let reader = new FileReader();
		 reader.onload = (e) => {
		 $('#featured_image_preview').attr('src', e.target.result);
		 }
		 reader.readAsDataURL(this.files[0]);
		 });*/

		//For artist profile tab
		$image_crop = $('#image-preview').croppie({
			enableExif:true,
			viewport:{
				width:540,
				height:540,
				type:'square'
			},
			boundary:{
				width:540,
				height:540
			}
		});

		//For artist profile tab
		$('#upload_image').change(function(){
			var reader = new FileReader();

			reader.onload = function(event){
				$image_crop.croppie('bind', {
					url:event.target.result
				}).then(function(){
					console.log('jQuery bind complete');
				});
			}
			reader.readAsDataURL(this.files[0]);
		});

		// Photo tab Image Crop Module
		$(document).on('click','#cropEvenImage',function() {

			console.log("test doc");

			if ($('#upload_image').get(0).files.length === 0) {
				$(".error_file_valid").show().delay(5000).fadeOut();
				$(".error_file_valid").html('No files selected. Please select file. ');
				return false;
			}

			$image_crop.croppie('result', {
				type:'canvas',
				size:'viewport'
			}).then(function(response){
				var _token = $('input[name=_token]').val();
				var id = $('input[name=id]').val();
				$.ajax({
					url:'{{ route("admin.image.upload") }}',
					type:'post',
					data:{"image":response, _token:_token, id:id},
					dataType:"json",
					success:function(data)
					{
						var crop_image = '<img src="'+data.path+'" class="featured_image_preview"/>';
						$('#uploaded_image').html(crop_image);
						$("#ImageCropper_modal").modal('hide');
						$('#upload_image').val('');
						$('#eventInputImage').val(data.image_name);
						$('#image-preview img').css('display','none');
					}
				});
			});
		});

        //For CMS Page
        $image_crop_cms_page = $('#image-preview-cms-page').croppie({
            enableExif:true,
            viewport:{
                width:350,
                height:350,
                type:'square'
            },
            boundary:{
                width:350,
                height:350
            }
        });

        //For CMS Page
        $('#upload_image_cms_page').change(function(){
            var reader = new FileReader();

            reader.onload = function(event){
                $image_crop_cms_page.croppie('bind', {
                    url:event.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        //For CMS Page
        $(document).on('click','#cropEvenImageCmsPage',function() {

            console.log("test cms page");

            if ($('#upload_image_cms_page').get(0).files.length === 0) {
                $(".error_file_valid").show().delay(5000).fadeOut();
                $(".error_file_valid").html('No files selected. Please select file. ');
                return false;
            }

            $image_crop_cms_page.croppie('result', {
                type:'canvas',
                size:'viewport'
            }).then(function(response){
                var _token = $('input[name=_token]').val();
                var id = $('input[name=id]').val();
                $.ajax({
                    url:'{{ route("admin.image.upload") }}',
                    type:'post',
                    data:{"image":response, _token:_token, id:id},
                    dataType:"json",
                    success:function(data)
                    {
                        var crop_image = '<img src="'+data.path+'" />';
                        $('#uploaded_image').html(crop_image);
                        $("#ImageCropper_modal_cms_page").modal('hide');
                        $('#upload_image_cms_page').val('');
                        $('#eventInputImage').val(data.image_name);
                        $('#image-preview-cms-page img').css('display','none');
                    }
                });
            });
        });

        //For Panel Page
        $image_crop_panel_page = $('#image-preview-panel-page').croppie({
            enableExif:true,
            viewport:{
                width:300,
                height:300,
                type:'square'
            },
            boundary:{
                width:300,
                height:300
            }
        });

        //For Panel Page
        $('#upload_image_panel_page').change(function(){
            var reader = new FileReader();

            reader.onload = function(event){
                $image_crop_panel_page.croppie('bind', {
                    url:event.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        //For Panel Page
        $(document).on('click','#cropEvenImagePanelPage',function() {

            console.log("test pznel page");

            if ($('#upload_image_panel_page').get(0).files.length === 0) {
                $(".error_file_valid").show().delay(5000).fadeOut();
                $(".error_file_valid").html('No files selected. Please select file. ');
                return false;
            }

            $image_crop_panel_page.croppie('result', {
                type:'canvas',
                size:'viewport'
            }).then(function(response){
                var _token = $('input[name=_token]').val();
                var id = $('input[name=id]').val();
                $.ajax({
                    url:'{{ route("admin.image.upload") }}',
                    type:'post',
                    data:{"image":response, _token:_token, id:id},
                    dataType:"json",
                    success:function(data)
                    {
                        var crop_image = '<img src="'+data.path+'" />';
                        $('#uploaded_image').html(crop_image);
                        $("#ImageCropper_modal_panel_page").modal('hide');
                        $('#upload_image_panel_page').val('');
                        $('#customFile').val(data.image_name);
                        $('#image-preview-panel-page img').css('display','none');
                    }
                });
            });
        });

        //for cancel modal button click
        $(document).on('click','.whiteBtn, .close',function() {
            $('#upload_image').val('');
            $('#image-preview img').css('display','none');

            $('#upload_image_cms_page').val('');
            $('#image-preview-cms-page img').css('display','none');

            $('#upload_image_panel_page').val('');
            $('#image-preview-panel-page img').css('display','none');
        });
	});

</script>