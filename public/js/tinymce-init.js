tinymce.init({
	selector : "textarea",
	theme: "modern",
	relative_urls: false,
	images_upload_base_path: "/img/upload",
	subfolder: "/img/upload",
	plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks fullscreen", "insertdatetime media table contextmenu paste jbimages"],
	toolbar : "insertfile undo redo | styleselect | bold italic underline strikethrough removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages"
});