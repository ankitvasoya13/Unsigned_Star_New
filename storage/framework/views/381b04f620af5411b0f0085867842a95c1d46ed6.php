<div class="modal fade lang_ms_banner" id="ImageCropper_modal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Upload Image</h5>
			</div>
			
			<div class="modal-body">
				<div class="img-container">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="file" name="upload_image" class="orangeBtn" id="upload_image" style="width: 100%;" />
							<div class="error_file_valid"> </div>
						</div>
					</div>
					<div class="row previewTop">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div id="image-preview"></div>
							
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="modal-footer">
				<div class="tb_es_btn_wrapper">
				<button type="button" class="whiteBtn" data-dismiss="modal">Cancel</button>
				<button type="button" class="orangeBtn" id="cropEvenImage">Crop</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- For CMS Page -->
<div class="modal fade lang_ms_banner" id="ImageCropper_modal_cms_page" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Upload Image</h5>
			</div>

			<div class="modal-body">
				<div class="img-container">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="file" name="upload_image_cms_page" class="orangeBtn" id="upload_image_cms_page" style="width: 100%;" />
							<div class="error_file_valid"> </div>
						</div>
					</div>
					<div class="row previewTop">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div id="image-preview-cms-page"></div>
							
						</div>
						
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<div class="tb_es_btn_wrapper">
				<button type="button" class="whiteBtn" data-dismiss="modal">Cancel</button>
				<button type="button" class="orangeBtn" id="cropEvenImageCmsPage">Crop</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- For Panel Page -->
<div class="modal fade lang_ms_banner" id="ImageCropper_modal_panel_page" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Upload Image</h5>
			</div>

			<div class="modal-body">
				<div class="img-container">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="file" name="upload_image_panel_page" class="orangeBtn" id="upload_image_panel_page" style="width: 100%;" />
							<div class="error_file_valid"> </div>
						</div>
					</div>
					<div class="row previewTop">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div id="image-preview-panel-page"></div>
							
						</div>
						
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<div class="tb_es_btn_wrapper">
				<button type="button" class="whiteBtn" data-dismiss="modal">Cancel</button>
				<button type="button" class="orangeBtn" id="cropEvenImagePanelPage">Crop</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('.profileImage').click(function(event){
alert('Hi!');
	$image_crop.croppie('result', {
      type:'canvas',
      size:'viewport'
    }).then(function(response){
      var _token = $('input[name=_token]').val();
      var id = $('input[name=id]').val();
      $.ajax({
        url:'<?php echo e(route("image_crop.upload")); ?>',
        type:'post',
        data:{"image":response, _token:_token, id:id},
        dataType:"json",
        success:function(data)
        {
          var crop_image = '<img src="'+data.path+'" />';
		  $('#uploaded_image').html(crop_image);
		  $("#ImageCropper_modal").modal('hide');
        }
      });
    });
  });
</script>