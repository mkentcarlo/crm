@push('scripts')
    <script type="text/javascript" src="https://momentjs.com/downloads/moment.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
        function previewImages() 
        {

            var preview = document.querySelector('#preview');
          
                if (this.files) {
                    [].forEach.call(this.files, readAndPreview);
                }

            function readAndPreview(file) 
            {
                // Make sure `file.name` matches our extensions criteria
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                  return alert(file.name + " is not an image");
                } // else...
                
                var reader = new FileReader();
                
                reader.addEventListener("load", function() {
                    var innerDiv = document.createElement('div');  
                    var aInnerDiv = document.createElement('a'); 
                    var linkText = document.createTextNode("Delete image");
                    aInnerDiv.appendChild(linkText);
                    aInnerDiv.title = "Delete image";
                    aInnerDiv.href = "javascript:;";
                    aInnerDiv.className = 'delete-gallery-img';
                    var image = new Image();
                    image.height = 100;
                    image.title  = file.name;
                    image.src    = this.result;
                 
                    preview.appendChild(innerDiv);
                    innerDiv.appendChild(image);
                    innerDiv.appendChild(aInnerDiv);
                });
                
                reader.readAsDataURL(file);
                
            }

        }
    
        function readURL(input) {

          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
          }
        }
        $(function () {
            $productsTable = $('#products-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: "{{ route('get.products') }}",
                dom: 'lBfrtip',
                buttons: true,
                columns: [
                    {
                        data:    "img_path",
                        render: function (data, type, row) {
                            if (row.img_path) {
                                return '<img src="'+row.img_path+'" alt="iMac" width="80">';
                            }
                            
                            return "No Image Available";
                        }
                    },  
                    {data: "name", name: "name"},
                    {data: "brands", name: "brands"},
                    {data: "categories", name: "categories"},
                    {data: "price", name: "price"},
                    {data: "status", name: "status"},  
                    {data: "date_created", name: "date_created"},   
                    {data: "action", name: "action"}
                ]
            } );

            $('#filterForm').on('submit', function (e) {
                e.preventDefault();
                 $productsTable.columns(1).search($('#name').val()).draw();
            });

            $('body').on('change', '#select-brand', function (e) {
                e.preventDefault();
                $productsTable.columns(2).search($(this).val()).draw();
            });

            $('body').on('change', '#select-cat', function (e) {
                e.preventDefault();
                $productsTable.columns(3).search($(this).val()).draw();
            });

            $(document).on('click', 'a.delete', function(e){
                e.preventDefault();
                $del_btn = $(this);
                swal({   
                    title: "Are you sure?",   
                    text: "You are about to delete this product!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#f8b32d",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false 
                }, function(){   
                    $.ajax({
                        url: $del_btn.attr('href'),
                        type: "delete",
                        dataType: "JSON",
                        success: function(data) {
                            if (data.hasOwnProperty('permitted') && !data.permitted) {
                                swal({
                                    type: 'error',
                                    title: data.msg,
                                    animation: true,
                                    showConfirmButton: true,
                                });
                            } else {
                                swal("Deleted!",data.msg, data.type); 
                                $productsTable.ajax.reload( null, false );
                            }    
                        } 
                    }); 
                });
            });

            $('body').on('click','a.delete-gallery-img', function(e) {
            e.preventDefault();
            var index = $(this).parent().index();
            $('#preview div:eq("'+ index+'")').remove();
        });

        $('#productForm').on('submit', function(e) {
                e.preventDefault();

                var img_ids = [];
                var img_content = [];
                $.each($("#preview img"), function() {
                    var imgsrc = $(this).attr("src");
                    if ($(this).is("[ino]")) {
                        img_ids.push($(this).attr("ino"));
                    } else {
                        img_content.push(imgsrc+'separator');
                    }
                });

                var formData = new FormData(this);
                formData.append('img_ids', JSON.stringify(img_ids));
                formData.append('img_content', JSON.stringify(img_content));
                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data:  formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function () {
                        swal({
                            title: 'Loading...',
                            imageUrl: "{{ asset('img/loader.gif') }}",
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
                            animation: true,
                            showConfirmButton: false,
                        });
                    },
                    success: function(result) {
                        if (result.success) {
                            successMsg(result.msg);
                        } else {
                            errorMsg(result.msg);
                        }  
                    },
                    error:      function (errors) {
                        errorMsg(errors.responseJSON.errors);
                    }
                });             
            });

            $("#imgInp").change(function() {
              readURL(this);
            });

            $('#file-input').change(function(){}, previewImages);
        });
    </script>
@endpush