//to highlight the side bar when access
var page_module = $('.content').attr('name');
$('.treeview-menu').find('li.'+page_module).addClass('active');
if ($('.treeview-menu').find('li.'+page_module).parent().parent().hasClass('treeview') )
{
	$('.treeview-menu').find('li.'+page_module).parent().parent().addClass('active');
}

$(function () {
	$('.img-editable').hover(
		function(){
			$(this).attr('data-toggle','tooltip');
			$(this).attr('data-original-title','Change Photo');
			$(this).css({"opacity" : "0.5"});
		},
		function(){
			$(this).css({"opacity" : "1"});
		});
		$('.img-editable').on('click', function(){
			$(this).parent().find('input:file').click();
			$file_input = $(this).parent().find('input:file');
			$image = $(this);
			$file_input.change(function(){imageUploadPreview (this, $image)});
		});
});

//javascript function to upload image and preview it on to a division.
function imageUploadPreview (input, input_preview_div)
{
	if(input.files && input.files[0])
	{
		//if the file submitted is not image, it will alert user.
		if(input.files[0].type.indexOf('image') == -1){
			// alert
			alert('File Submitted is not image, please choose an image.');
		}
		else
		{
			var reader = new FileReader();
			reader.onload = function(e){
				console.log(e);
				console.log(input.files[0]);
				$(input_preview_div).attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0])
		}

	}
}
