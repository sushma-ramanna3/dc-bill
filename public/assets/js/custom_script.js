$(document).ready(function() {
	 $('#dp1, #dp2').datepicker({
        format: 'dd-mm-yyyy'
    });
    
    $('#dp1, #dp2').datepicker();

    var isIE = navigator.userAgent.indexOf(' MSIE ') > -1;
    if(isIE) {
        $('.modal').removeClass('fade');
    }

    $( '[rel=tooltip]' ).tooltip();

    $("#phone, #zip, .integer_field").live("keyup", function(){
        if (!/^\d*$/.test($(this).val())) this.value = this.value.replace(/[^\d]/g,"");
    });

     $("#first_name, #last_name, .city").keypress(function(e){
          return letternumber(e);
      });

      function letternumber(e){
          var key;
          var keychar;
          if (window.event)
          key = window.event.keyCode;
          else if (e)
          key = e.which;
          else
          return true;
          keychar = String.fromCharCode(key);
          keychar = keychar.toLowerCase();
          // control keys
          if ((key==null) || (key==0) || (key==8) || 
          (key==9) || (key==13) || (key==27) )
          return true;
          // alphas and numbers
          else if ((("abcdefghijklmnopqrstuvwxyz ").indexOf(keychar) > -1))
          return true;
          else
          return false;
      }


   $( "#district_id" ).change(function() {
		var val = $(this).val();
		if(val != ''){
			var url= 'taluk.php?district_id='+val;
	    	$.getJSON(url, function(data){
	    		console.log(data);
	    		$('#taluk_id').empty();
				  $.each(data, function(index, text) {
			  	/*var optionExists = ($('#taluk option[value=' + index + ']').length > 0);
          		if(!optionExists)
              	{*/
					    $('#taluk_id').append(
					        $('<option></option>').val(index).html(text)
					    );
				//	}
				  });
			});
	    }
	});

    $( "#taluk_id" ).change(function() {
		var val = $(this).val();
		if(val != ''){
			var url= 'hobli.php?taluk_id='+val;
	    	$.getJSON(url, function(data){
	    		console.log(data);
	    		$('#hobli').empty();
				  $.each(data, function(index, text) {
				    $('#hobli').append(
				        $('<option></option>').val(index).html(text)
				    );
				  });
			});
	    }
	});

	$( "#product_id" ).change(function() {
		var val = $(this).val();
		if(val != ''){
			var url= 'manufacturer.php?product_id='+val;
	    	$.getJSON(url, function(data){
	    		console.log(data);
	    		$('#manufacturer_id').empty();
				  $.each(data, function(index, text) {
				    $('#manufacturer_id').append(
				        $('<option></option>').val(index).html(text)
				    );
				  });
			});
	    }
	});

	$( "#manufacturer_id" ).change(function() {
		var val = $(this).val();
		if(val != ''){
			var url= 'model.php?manufacturer_id='+val;
	    	$.getJSON(url, function(data){
	    		console.log(data);
	    		$('#model_id').empty();
				  $.each(data, function(index, text) {
				    $('#model_id').append(
				        $('<option></option>').val(index).html(text)
				    );
				  });
			});
	    }
	});

	$( "#model_id" ).change(function() {
		var val = $(this).val();
		if(val != ''){
			var url= 'specificaton.php?model_id='+val;
	    	$.getJSON(url, function(data){
	    		console.log(data);
	    		$('#spec_id').empty();
				  $.each(data, function(index, text) {
				    $('#spec_id').append(
				        $('<option></option>').val(index).html(text)
				    );
				  });
			});
	    }
	});

	$( "#spec_id" ).change(function() {
		var val = $(this).val();
		if(val != ''){
			var url= 'rateShare.php?spec_id='+val;
	    	$.getJSON(url, function(data){
	    		console.log(data);
	    		$('#fullRate').val(data.decFullRate);
	    		$('#govtShare').val(data.decGovtShare);
	    		$('#farmerShare').val(data.decFarmerShare);
			});
	    }
	});


  /* 	$( '#district_id1' ).change(function() {

      if($(this).val() != 0){
          $.ajax({
            type    : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url     : '/taluk', // the url where we want to POST
            data    : "district_id="+$(this).val(),//{'ids':JSON.stringify(selectednumbers)}, //"product_id=" + $('#product_id').val(),
            contentType: false,
            processData: false,
            dataType  : false // what type of data do we expect back from the server
          })
          // using the done promise callback
          .done(function(obj) {
          	$('#taluk').focus();
             console.log(obj.taluks);
              // log data to the console so we can see
            if(obj.taluks != ''){
                var option = '';
                 $.each(obj.taluks, function(k, v){
      //  htmlStr += v.id + ' ' + v.name + '<br />';
          option += '<option value="'+ v.id + '">' + v.name + '</option>';
   });
               /*for (i=0;i<taluks.length;i++){
                   option += '<option value="'+ numbers[i] + '">' + numbers[i] + '</option>';
                }*/
               /* $('#taluks').append(option);
            }
           
          	});
    	}
	});*/

});