window.onload = function () {
    $(document).on('change','#size-filter',function () { 
        $('.filter__filter-form').submit();
    })
}