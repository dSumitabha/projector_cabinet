<div class="ec-pro-list-top d-flex mt-2">
    <div class="col-md-6 ec-grid-list">
        {{-- <div class="ec-gl-btn">
            <button class="btn btn-grid active"><img src="{{url('/')}}/frontend/assets/images/icons/grid.svg"
                    class="svg_img gl_svg" alt="" /></button>
            <button class="btn btn-list"><img src="{{url('/')}}/frontend/assets/images/icons/list.svg"
                    class="svg_img gl_svg" alt="" /></button>
        </div> --}}
    </div>
    <div class="col-md-6 ec-sort-select">
        <span class="sort-by">Sort by</span>
        <div class="ec-select-inner">
            <select name="ec-select" id="ec-select">
                <option selected disabled>Price Range</option>
                {{-- <option value="1">Relevance</option>
                <option value="2">Name, A to Z</option>
                <option value="3">Name, Z to A</option> --}}
                <option value="4">Price, low to high</option>
                <option value="5">Price, high to low</option>
            </select>
        </div>
    </div>
</div>
