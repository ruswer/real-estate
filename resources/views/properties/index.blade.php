<x-layouts.app>
    <x-slot:title>
        Mulklar Ro'yhati
    </x-slot:title>
    <div class="container">
        <div class="row">
            @foreach ($properties as $property)
                <div class="col-md-12">
                    <div class="card shadow-sm mb-4">
                        <div class="row g-0 align-items-center">
                            <!-- Mulk Ma'lumotlari -->
                            <div class="col-md-8">
                                <img src="{{ asset('storage/' . $property->image) }}" class="card-img-top"
                                    alt="Property Image">
                                <div class="card-body">
                                    <h2 class="card-title">{{ $property->title }}</h2>
                                    <p class="card-text">{{ $property->description }}</p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Price:</strong>
                                            ${{ number_format($property->price, 2) }}</li>
                                        <li class="list-group-item"><strong>Location:</strong> {{ $property->location }}
                                        </li>
                                        <li class="list-group-item"><strong>Type:</strong> {{ $property->type->name }}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Agent Ma'lumotlari -->
                            <div class="col-md-4 text-center border-start">
                                <div class="p-3">
                                    <h4>Agent Information</h4>
                                    <img src="{{ asset($property->agent->image) }}" class="rounded-circle mb-3"
                                        width="100" height="100">
                                    <h5>{{ $property->agent->name }}</h5>
                                    <p class="text-muted">{{ $property->agent->designation }}</p>
                                    <div>
                                        <a href="{{ $property->agent->facebook }}"
                                            class="btn btn-primary btn-sm mx-1"><i class="fab fa-facebook-f"></i></a>
                                        <a href="{{ $property->agent->twitter }}" class="btn btn-info btn-sm mx-1"><i
                                                class="fab fa-twitter"></i></a>
                                        <a href="{{ $property->agent->instagram }}"
                                            class="btn btn-danger btn-sm mx-1"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('property_list') }}" class="btn btn-secondary mt-3">Back to Listings</a>
    </div>
</x-layouts.app>
