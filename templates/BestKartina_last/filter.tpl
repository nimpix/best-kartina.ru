<div class="filter-nimpix">
    <form class="filter__filter-form" action="filtered" method="POST">
        <div class="filter__filter-body-select">
            <div class="form-group">
                <label for="">Выбрать цвет</label>
                <input type="hidden" name="color" id="color-data">
            </div>
        </div>
    </form>
</div>
<div class="clearfix"></div>
<script src="engine/modules/nimpixfilter/views/js/bundle.js"></script>

<style>
.color{
    width:40px;
    height:40px;
    display: inline-block;
    margin-right:10px;
    margin-bottom: 10px;
    cursor:pointer;
}
.filter-nimpix{
    display: block;
    margin:0px 0px 10px 0px;
    clear:both;
}

</style>