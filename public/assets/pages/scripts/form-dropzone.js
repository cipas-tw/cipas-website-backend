var FormDropzone = function () {


    return {
        //main function to initiate the module
        init: function () {

            Dropzone.options.myDropzone = {
                dictDefaultMessage: "",
                init: function() {
                    this.on("success", function(e) {
                        data = JSON.parse(e.xhr.response);
                        console.log(data.status);
                        if(data.status ==1){
                          var fileName = Dropzone.createElement('<input type="hidden" name="tmp_filename[]" id="tmp_filename" value="'+data.file_orig_name+'">');
                          var fileUrl = Dropzone.createElement('<input type="hidden" name="tmp_file_url[]" id="tmp_file_url" value="'+data.file_url+'">');
                          e.previewElement.appendChild(fileName);
                          e.previewElement.appendChild(fileUrl);
                        } else {
                          this.removeFile(e);
                        }
                    });

                    this.on("addedfile", function(file) {
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn red btn-sm btn-block'>Remove</a>");

                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                          // Make sure the button click doesn't submit the form:
                          e.preventDefault();
                          e.stopPropagation();

                          // Remove the file preview.
                          _this.removeFile(file);
                          // If you want to the delete the file on the server as well,
                          // you can do the AJAX request here.
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });
                }
            }
        }
    };
}();

jQuery(document).ready(function() {
   FormDropzone.init();
});