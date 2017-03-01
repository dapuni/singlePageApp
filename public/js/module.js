$(document).ready(function(){
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	
	$('.menu').on('click',function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		axios.get(url).then(function (response) {
		    console.log(response);
		    $('#content_section').html(response.data);
		})
		.catch(function (error) {
		    console.log(error);
		});
	});

	$('#content_section').bind('contextmenu',function(e) {
      	e.preventDefault();
    });
});