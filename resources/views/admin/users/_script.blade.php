@push('scripts')
    <script type="text/javascript">
		$(document).ready(function(){
		   
		// **************** Users Page ******************** //

		// start load users

		$userstable = $('#users-table').DataTable( {
		    serverSide: true,
		    processing: true,
		    ajax: "{{ route('get.users') }}",
		    dom: 'lBfrtip',
		    buttons: true,
		    columns: [
		                { data: 'id', name: 'id'	},
		                { data: 'username', name: 'username'	},
		                { data: 'email', name: 'email'	},
		                { data: 'name', name: 'name'	},
		                { data: 'contact', name: 'contact'	},
		                { data: 'status', name: 'status'	},
		                { data: 'created_at', name: 'created_at'	},
		                { data: 'action', name: 'action'	}
		            ]
		} );

		// end load users

		// start user form


		// load form
		$(document ).on('click','a.form-load', function(){
		    $target = $(this).attr('href');
		    $form_url = $(this).attr('data-form-url');
		    $($target + ' .modal-body').html('<div class="alert alert-warning"><i class="pull-left fa fa-spin fa-circle-o-notch"></i> Loading form...</div>');
		    $.ajax({
		        url: $form_url,
		        method: "GET",
		        dataType:'html',    
		        success: function(data){
		        	if (result.hasOwnProperty('permitted') && !result.permitted) {
                        swal({
                            type: 'error',
                            title: result.msg,
                            animation: true,
                            showConfirmButton: true,
                        });
                    } else {
		            	$($target + ' .modal-body').html(data);
		            }
		        }
		    })
		});


		// for on submission: edit/create user
		$user_form = $('form.user-info');
		$submit_user_button = $('button#submit-user');
		$(document).on('click','button#submit-user',function(evt){
		    evt.preventDefault();
		    evt.stopPropagation();
		    $(this).text('Loading..');
		    $(this).attr('disabled',true);
		    $.ajax({
		        url: $('form.user-info').attr('action'),
		        method: $('form.user-info').attr('method'),
		        data: $('form.user-info').serialize(),
		        success: function(data){
		                $('form.user-info').parent().html(data);
		                $submit_user_button.text('Save');
		                $submit_user_button.attr('disabled',false);
		                $userstable.ajax.reload( null, false );
		        }
		    });
		});
		    
		// end user form

		// delete user button

		$(document).on('click', 'a.delete-user', function(e){
		    e.preventDefault();
		    $del_btn = $(this);
		    swal({   
		        title: "Are you sure?",   
		        text: "You are about to delete this user!",   
		        type: "warning",   
		        showCancelButton: true,   
		        confirmButtonColor: "#f8b32d",   
		        confirmButtonText: "Yes, delete it!",   
		        closeOnConfirm: false 
		    }, function(){   
		        $.ajax({
		            url: $del_btn.attr('href'),
		            method: "GET",
		            success: function(data){
		            	if (data.hasOwnProperty('permitted') && !data.permitted) {
                            swal({
                                type: 'error',
                                title: data.msg,
                                animation: true,
                                showConfirmButton: true,
                            });
                        } else {
			                data  = JSON.parse(data);
			                swal("Deleted!",data.msg, data.type); 
			                $userstable.ajax.reload( null, false );
			            }    
		            }
		        });
		        
		    });
		});

		// end delete user

		// start search user

		$('#search-user').on('keyup', function(){
		    $userstable.search($(this).val()).draw();
		});

		// end search user

		// start export csv

		    $('.export-users-csv').click(function(){
		        $('.dt-button.buttons-csv.buttons-html5').click();
		    });

		// end export csv

		// start print users

		$('.export-users-print').click(function(){
		    $('.dt-button.buttons-print').click();
		});

		// end print users


		});
	</script>
@endpush
