@push('scripts')
<script type="text/javascript">
  // check or unchecked all input checkbox on specific selector
    function checkedOrUnchecked(selector, isChecked = false) {
      for (let i = 0; i < selector.length; i++) {
        if (selector[i].type == 'checkbox')
          selector[i].checked = isChecked;
      }
    }
  $(function () {

    $('body').on('click', '#check-all', function(){
      let selector = $('tbody > tr').find('input[type="checkbox"]');
      
      if($(this).hasClass('checked')) {
        $(this).removeClass('checked');
        checkedOrUnchecked(selector, false);
      } else {
        $(this).addClass('checked');
        checkedOrUnchecked(selector, true);
      }
    });

    $('body').on('click', '.marks', function(e){
      e.preventDefault();
      let selector = $('tbody > tr').find('input[type="checkbox"]');
      let ids = [];
      for (let i = 0; i < selector.length; i++) {
        if (selector[i].checked) {
          ids.push(selector[i].value);
        }  
      }
      var data = ids.join(',');
      if (data == '') {
        alert('must select checkbox to continue this action');
      } else {
        swal({
            title: 'Loading...',
            imageUrl: "{{ asset('img/loader.gif') }}",
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            animation: true,
            showConfirmButton: false,
        });

        $.getJSON("{{ url('inquiries/action/marks') }}" + '?action='+$(this).attr('id') + '&id=' + data, function (result) {
            swal.close();
            location.reload();
        });
      }
      
    });
    $('body').on('click', '#delete-inquiry', function(e) {
      e.preventDefault();
      var id = $(this).attr('ino');
      swal({
            title: 'Loading...',
            imageUrl: "{{ asset('img/loader.gif') }}",
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            animation: true,
            showConfirmButton: false,
        });

       $.getJSON("{{ url('inquiries/action/delete') }}/" + id, function (result) {
            swal.close();
            location.href = '/inquiries';
        });
    })
     $('body').on('click', '.status', function(e) {
      e.preventDefault();
      var id = $(this).attr('ino');
      var status = $(this).attr('id');
      swal({
            title: 'Loading...',
            imageUrl: "{{ asset('img/loader.gif') }}",
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            animation: true,
            showConfirmButton: false,
        });

       $.getJSON("{{ url('inquiries/action/status') }}/" + id +'?status=' + status, function (result) {
            swal.close();
            location.href = '/inquiries';
        });
    });
    
    $('body').on('click', '.view-by-message', function(e) {
      e.preventDefault();
      var id = $(this).attr('ino');
      var status = 'read';
      $.getJSON("{{ url('inquiries/action/status') }}/" + id +'?status=' + status, function (result) {
          location.href = '/inquiries/' + id;
          //console.log(result);
      });
      //alert(status);
    });    
  });

</script>
@endpush
