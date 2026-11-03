		<!-- jQuery 2.1.4 -->
		<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="plugins/jQueryUI/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
		<!-- Bootstrap 3.3.5 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<!-- Bootstrap Hover Dropdown -->
		<script src="plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		
		<!-- Bootstrap Treeview -->
		<script src="includes/js/bootstrap-treeview.js"></script>
		
		<!-- Morris.js charts -->
		<?php /*
		<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="plugins/morris/morris.min.js"></script>
		*/ ?>
		<!-- Sparkline -->
		<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- jQuery Knob Chart -->
		<script src="plugins/knob/jquery.knob.js"></script>
		<!-- Select2 -->
		<script src="plugins/select2/select2.full.min.js"></script>
		<!-- daterangepicker -->
		<?php /*
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
		*/?>
		<script src="plugins/daterangepicker/daterangepicker.js"></script>
		
		<!-- datepicker -->
		<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
		

		<!-- Bootstrap WYSIHTML5 -->
		<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<!-- Slimscroll -->
		<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="plugins/fastclick/fastclick.min.js"></script>
		<!-- DataTables -->
		<script src="plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
		
		<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		
		
		<script>
		var crud = {
			add_priv: <?php echo $add_priv; ?>,
			edit_priv: <?php echo $edit_priv; ?>,
			delete_priv: <?php echo $delete_priv; ?>
		};
		
		$(".datepicker").datepicker({
			format: "yyyy-mm-dd",
			autoclose: true
		});
		</script>
		
		
		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>
		
		<!-- CK Editor -->
		<!--<script src="plugins/ckeditor/ckeditor.js"></script>-->
		
		<!-- tinymce -->
		<script src="plugins/tinymce/tinymce.min.js"></script>
		
		<script>
			var theTable;
		</script>
		<!-- Custom Script -->
		<script src="includes/js/main.js"></script>
		
		<script>
		  $(function () {
			//bootstrap WYSIHTML5 - text editor
			$('.textarea').wysihtml5()
		  })
		</script>
		
		<?php 
		if(isset($additionaljs)){ 
			if(is_array($additionaljs)){
				foreach($additionaljs as $c){
					echo '<script src="'.$c.'"></script>';
				}
			};
		}
		if(isset($customjs)){ 
			if(is_array($customjs)){
				foreach($customjs as $c){
					echo '<script src="includes/js/'.$c.'"></script>';
				}
			};
		}
		?>
		<script>
		$(function () {
			$('.select2').select2();
			$('.hover-initialized').dropdownHover();
			// Replace the <textarea id="editor1"> with a CKEditor
			// instance, using default configuration.
			/*
			if($('#editor1').length){
				CKEDITOR.replace('editor1');
			}
			if($('#editorNaskah').length){
				CKEDITOR.replace('editorNaskah');
			}
			*/
			tinymce.init({
				selector: '.ckeditor',
				height : 250,
				menubar: false,
				auto_focus:true,

				// To avoid TinyMCE path conversion from base64 to blob objects.
				// https://www.tinymce.com/docs/configure/file-image-upload/#images_dataimg_filter
				images_dataimg_filter : function(img) {
					return img.hasAttribute('internal-blob');
				},
				setup : function(ed)
				{
					ed.on('init', function()
					{
						this.getDoc().body.style.fontSize = '16px';
						this.getDoc().body.style.fontFamily = 'Arial, "Helvetica Neue", Helvetica, sans-serif';
					});
				},
				plugins: [
					  "advlist autolink link image lists charmap print preview hr anchor pagebreak",
					  "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
					  "table contextmenu directionality emoticons paste textcolor responsivefilemanager code tiny_mce_wiris"
				],
				toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
				toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor | print preview | tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry",
				image_advtab: true,

				external_filemanager_path:"plugins/filemanager/",
				filemanager_title:"Tata Kelola File"
			});
		});
		</script>