<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <form action="{{ route('properties.index') }}" method="GET">
            <div class="row g-2">
                <div class="col-md-10">
                    <div class="row g-2">
                        <div class="col-md-4 position-relative">
                            <input type="text" id="searchInput" name="keyword"
                                class="form-control border-0 py-3 pe-5" placeholder="Search Keyword"
                                value="{{ request('keyword') }}">

                            <!-- "X" tugmasi -->
                            <button type="button"
                                class="btn btn-light position-absolute top-50 end-0 translate-middle-y me-2"
                                onclick="clearInput()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="col-md-4">
                            <select name="type" class="form-select border-0 py-3">
                                <option value="">Property Type</option>
                                @foreach ($propertyTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ request('type') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="location" class="form-select border-0 py-3">
                                <option value="">Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ trim(preg_replace('/\s+/', ' ', $location)) }}"
                                        {{ trim(preg_replace('/\s+/', ' ', request('location'))) == trim(preg_replace('/\s+/', ' ', $location)) ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark border-0 w-100 py-3">Search</button>
                </div>
            </div>
        </form>

    </div>
</div>
