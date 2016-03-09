$(document).ready(function() {
            $('#div-btn1').click(function(){
                $.ajax({
                type: "GET",
                url: "{{ route('admin.reports.stadistics') }}",
                success: function(a) {
                    $('#div-results').html(a);
        }
       });
   });
});