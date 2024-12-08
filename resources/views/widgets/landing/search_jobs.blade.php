<!-- Search start -->
<div class="searchwrap">
    <div class="bg-yellow"></div>
    <div class="container" style="position: relative">
        <h3>Isang milyong kwento ng tagumpay. <span>Simulan mo ang sa'yo ngayon.</span></h3>
        <p>Maghanap ng Trabaho, Pagkakakitaan, at Mga Oportunidad sa Karera</p>
        <div class="searchbar">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Ilagay ang Pamagat ng Trabaho" />
                </div>
                {{-- <div class="col-md-3">
                    <select class="form-control">
                        <option>Select Categories</option>
                        <option>Marketing</option>
                        <option>Teaching & Education </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control">
                        <option>Select City</option>
                        <option>New York</option>
                        <option>San Joes</option>
                    </select>
                </div> --}}
                <div class="col-md-2">
                    <input type="submit" class="btn" value="Maghanap" />
                </div>
            </div>
        </div>
        <!-- button start -->
        <div class="getstarted">
            <a href="{{ url('client/jobs/create') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> I-post ang iyong Trabaho</a>
            <a href="{{ url('jobs') }}"><i class="fa fa-user-o" aria-hidden="true"></i> Maghanap ng Trabaho</a>
        </div>
        <!-- button end -->
    </div>
</div>
<!-- Search End -->