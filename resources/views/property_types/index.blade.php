<x-layouts.app>
    <x-slot:title>
        Mulk turlari
    </x-slot:title>
    <div class="container">
        <h1>Property Types</h1>
        <div class="row">
            @foreach ($types as $type)
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                        <div class="rounded p-4">
                            <div class="icon mb-3">
                                <img class="img-fluid" src="{{ asset($type->icon) }}" alt="Icon">
                            </div>
                            <h6>{{ $type->name }}</h6>
                            <span>{{ $type->properties->count() }} Properties</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
