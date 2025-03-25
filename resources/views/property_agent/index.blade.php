<x-layouts.app>
    <x-slot:title>
        Mulk agenti
    </x-slot:title>

    <div class="container">
        <h1>Property Agents</h1>
        <div class="row">
            @foreach ($agents as $agent)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item rounded overflow-hidden">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{ asset($agent->image) }}" alt="">
                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                <a class="btn btn-square mx-1" href="{{ $agent->facebook }}"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href="{{ $agent->twitter }}"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href="{{ $agent->instagram }}"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4 mt-3">
                            <h5 class="fw-bold mb-0">{{ $agent->name }}</h5>
                            <small>{{ $agent->designation }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</x-layouts.app>
