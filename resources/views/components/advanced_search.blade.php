<div class="container">
    <style>
        .semi-transparent {
            color: rgb(0 0 0 / 28%);!important /* Adjust opacity */
        }
    </style>
	<div class="card shadow-lg border-0 rounded-3">
        <div class="card-header text-center fw-bold text-white" style="background-color: #4b50b7; font-size: 18px;">
            Advanced Cabinet Search
        </div>
        <form action="" class="mb-0 p-3" id="advancedSearch">

            <style>
                select option[disabled]:first-child {
    display: none;
}
            </style>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="brandSelect" class="form-label fw-bold">UST Projector Brand</label>
                        <select class="form-control form-select semi-transparent" id="brandSelect" name="projector_make" >
                            <option value="" selected disabled >Ex: AWOL</option>

                        </select>
                        <input type="text" id="otherBrandInput" class="form-control mt-2 d-none" placeholder="Enter Brand">
                    </div>

                    <!-- Model Select -->
                    <div class="col-md-4 mb-3">
                        <label for="projectorModelSelect" class="form-label fw-bold">UST Projector Model</label>
                        <select class="form-control form-select semi-transparent" id="projectorModelSelect" name="projector_model">
                            <option value="" selected disabled >Ex: LTV-3500 </option>

                        </select>
                        <input type="text" id="otherModelInput" class="form-control mt-2 d-none" placeholder="Enter Model">
                        <div id="modelMessage" class="text-danger d-none">Please choose a brand first.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="ceilingHeightSelect" class="form-label fw-bold">Ceiling Height</label>
                        <select class="form-control form-select semi-transparent" id="ceilingHeightSelect" name="ceiling_height">
                            <option value="" selected disabled>Ex: 8 Feet </option>
                            <option value="7">7 Feet</option>
                            <option value="8">8 Feet</option>
                            <option value="7-8">Between 7 to 8 Feet</option>
                            <option value="9">9 Feet</option>
                            <option value="8-9">Between 8 to 9 Feet</option>
                            <option value="10">10 Feet</option>
                        </select>
                    </div>



                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="channelBrandSelect" class="form-label fw-bold">Center Channel Brand</label>
                        <select class="form-control form-select semi-transparent" id="channelBrandSelect" name="channel_brand">
                            <option value="" selected disabled>Ex: Klipsch</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3" id="modelContainer">
                        <label for="channelModelSelect" class="form-label fw-bold">Center Channel Model</label>
                        <select class="form-control form-select semi-transparent" id="channelModelSelect" name="channel_model">
                            <option value="" selected disabled>Ex: RP-504C</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="screenSizeSelect" class="form-label fw-bold">Screen Size</label>
                        <select class="form-control form-select semi-transparent" id="screenSizeSelect" name="screen_size">
                            <option value="" selected disabled>Ex: 120 inches </option>
                            <option value="100">100 inches</option>
                            <option value="120">120 inches</option>
                            <option value="132">132 inches</option>
                            <option value="150">150 inches</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                </div>
                <div id="customFields" class="row d-none">
                    <!-- Length Dropdown -->
                    <div class="col-md-4 mb-3">
                        <label for="lengthSelect" class="form-label fw-bold">Center Channel Length</label>
                        <select class="form-control form-select" id="lengthSelect" name="length">
                            <option value="">Select Length</option>
                            <option value=">45 inches">Greater than 45 inches</option>
                            <option value="<45 inches">Less than 45 inches</option>
                        </select>
                    </div>

                    <!-- Depth Dropdown -->
                    <div class="col-md-4 mb-3">
                        <label for="depthSelect" class="form-label fw-bold">Center Channel Depth</label>
                        <select class="form-control form-select" id="depthSelect" name="depth">
                            <option value="">Select Depth</option>
                            <script>
                                for (let i = 5; i <= 20; i++) {
                                    document.write(`<option value="${i} inches">${i} inches</option>`);
                                }
                            </script>
                        </select>
                    </div>

                    <!-- Height Dropdown -->
                    <div class="col-md-4 mb-3">
                        <label for="heightSelect" class="form-label fw-bold">Center Channel Height</label>
                        <select class="form-control form-select" id="heightSelect" name="height">
                            <option value="">Select Height</option>
                            <option value="4 inches">4 inches or Between 4 and 5 inches</option>
                            <option value="5 inches">5 inches or Between 5 and 6 inches</option>
                            <option value="6 inches">6 inches or Between 6 and 7 inches</option>
                            <option value="7 inches">7 inches or Between 7 and 8 inches</option>
                            <option value="8 inches">8 inches or Between 8 and 9 inches</option>
                            <option value="9 inches">9 inches or Between 9 and 10 inches</option>
                            <option value="others">Others</option>
                        </select>
                        <input type="text" id="customHeightInput" class="form-control mt-2 d-none" placeholder="Enter custom height">
                    </div>
                </div>
                <div class="row text-center">
                    <label class="form-label fw-bold">Screen Type</label>
                    <div class="col-md-12 mb-3">

                        <span class="ec-new-option">
                            <span class="radio-option">
                                <input type="radio" id="account1" name="radio-group" value="fixed_screen">
                                <label for="account1">Fixed Screen</label>
                            </span>
                            <span class="radio-option">
                                <input type="radio" id="account2" name="radio-group" value="floor_raising">
                                <label for="account2">Floor Raising</label>
                            </span>
                            <span class="radio-option">
                                <input type="radio" id="account3" name="radio-group" value="both">
                                <label for="account3">Either Fixed  or Floor Raising Screen</label>
                            </span>
                        </span>
                    </div>

				</div>
			</div>
            <div class="card-footer d-flex justify-content-center" style="background-color: #f0f0f5;">
                <button type="submit" class="btn btn-primary px-4 fw-bold me-2"
                    style="height: 36px; font-size: 14px; display: flex; align-items: center; justify-content: center;">
                    Search
                </button>
                <button type="button" class="btn btn-secondary px-4 fw-bold"
                    id="clearFilters"
                    style="height: 36px; font-size: 14px; display: flex; align-items: center; justify-content: center;">
                    Clear Filters
                </button>
            </div>

        </form>
    </div>
</div>
