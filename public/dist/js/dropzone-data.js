/*Dropzone Init*/
$(function(){
	// "use strict";
	// Dropzone.options.myAwesomeDropzone = {
	// 	addRemoveLinks: true,
	// 	dictResponseError: 'Server not Configured',
	// 	acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp,.zip",
	// };

	Dropzone.options.myDropzone = {
            url: "/Account/Create",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            addRemoveLinks: true,
			acceptedFiles: "image/*",
        };
});

