
    $(function() {
    var i = 2;
    
    $('#addNew').on('click', function() {
        if(i < 4){
            $('<div class="form-group"><label class="col-md-4 control-label" for="workex"> Work Experience &nbsp;'+ i +'</label> <div id="append-div"> <div class="col-md-2"> <select class="form-control input-md" name="workarea[]"><option value="" selected="selected">--Select--</option><option value="Sales - Banking & Fin Services">Sales - Banking & Fin Services</option><option value="Non-Sales -  Banking & Fin Services">Non-Sales -  Banking & Fin Services</option><option value="Others">Others</option></select></div><div class="col-md-2"><input class="form-control input-md months" placeholder="in months" name="workex[]" type="text"></div></div></div>').appendTo(workexappend);
            i++;
        }
        return false;
    });

     $('#addNew1').on('click', function() {
        if(i < 4){
            $('<div class="form-group"><label class="col-md-4 control-label" for="workex"> Work Experience &nbsp;'+ i +'</label> <div id="append-div"> <div class="col-md-2"> <select class="form-control input-md" name="workarea[]"><option value="" selected="selected">--Select--</option><option value="Financial Advisor/ Planner">Financial Advisor/ Planner</option><option value="RM in a Bank">RM in a Bank</option><option value="RM in a Brokerage firm">RM in a Brokerage firm</option><option value="Wealth Manager">Wealth Manager</option><option value="Equity Research">Equity Research</option><option value="Sales role in Bank or FIs">Sales role in Bank or FIs</option><option value="Others">Others</option></select></div><div class="col-md-2"><input class="form-control input-md months" placeholder="in months" name="workex[]" type="text"></div></div></div>').appendTo(workexappend);
            i++;
        }
        return false;
    });
    
    $('#remove').on('click', function() {
        $('div#workexappend').children().last().remove();
        if( i > 2 ) i--;
        return false;
    });
    });