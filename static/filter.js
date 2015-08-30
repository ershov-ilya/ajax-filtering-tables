/**
 * Created by
 * User: ershov-ilya
 * Website: ershov.pw
 * GitHub : https://github.com/ershov-ilya
 * on 20.08.2015.
 */

var FILTER = (function(){
    var PUBLIC={
        options:{},
        data:{}
    };
    // Private
    var DEBUG=true;
    var scopes=[];
    var url;
    var FirstData;

    function filterChange(){
        $this=$(this);
        var name=$this.attr('name');
        var value=$this.find(':selected').val();
        if(DEBUG) console.log('filterChange() '+name+' '+value);
        PUBLIC.options[name]=value;
        if(PUBLIC.options[name]=="") delete(PUBLIC.options[name]);
        $(document).trigger('FILTER.GetData');
    }

    function getData(){
		if(DEBUG) console.log('FILTER.getData()');
        $.ajax({
            url: url,
            data: PUBLIC.options
        }).success(function(response){
            response=JSON.parse(response);
            if(typeof response.data != 'undefined') PUBLIC.data=response.data;
            if(!FirstData){
                FirstData=true;
                $(document).trigger('FILTER.FirstData');
            }
            $(document).trigger('FILTER.LoadDone');
        });
    }

    PUBLIC.init=function(connector_url){
		if(DEBUG) console.log('FILTER.init()');
        FirstData=false;
        if(typeof connector_url != 'undefined') {
		if(DEBUG) console.log('url='+connector_url);
			url=connector_url;
		}
        else{
            console.error('Не указан коннектор фильтра данных');
            return false;
        }

        $('.filter-select').change(filterChange);
        $(document).off('FILTER.GetData');
        $(document).on('FILTER.GetData',getData);
		$(document).trigger('FILTER.GetData');
    };

    return PUBLIC;
})();