<!-- Search start -->
<div class="searchwrap">
    <div class="container" style="position: relative">
        <h3>Isang milyong kwento ng tagumpay. <span>Simulan mo ang sa'yo ngayon.</span></h3>
        <p>Maghanap ng Trabaho, Pagkakakitaan, at Mga Oportunidad sa Karera</p>
        <div class="searchbar">
            <form action="{{ url('jobs') }}" method="GET">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control"
                            placeholder="Ilagay ang Pamagat ng Trabaho" value="{{ request('search') }}" />
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
            </form>
        </div>
        <!-- button start -->
        <div class="getstarted">
            <div class="row">
                <div class="col-12 col-md-6">
                    <a href="{{ url('client/jobs/create') }}" class="w-full"><i class="fa fa-briefcase" aria-hidden="true"></i> I-post ang iyong Trabaho</a>
                </div>
                <div class="col-12 col-md-6">
                    <a href="{{ url('jobs') }}" class="w-full"><i class="fa fa-user-o" aria-hidden="true"></i> Maghanap ng Trabaho</a>
                </div>
            </div>
        </div>
        <!-- button end -->
    </div>
</div>
<!-- Search End -->