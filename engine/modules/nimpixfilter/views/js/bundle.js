window.onload = function () {
    $(document).on('click','.color',function(){
        var data = $(this).data('color');
        $("#color-data").val(data);
        $('.filter__filter-form').submit();
    });
}