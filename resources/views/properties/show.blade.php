<!-- filepath: /Applications/MAMP/htdocs/real-estate/resources/views/properties/show.blade.php -->
<x-layouts.app>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <!-- Back Button -->
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
                    <i class="fa fa-arrow-left me-2"></i>Back
                </a>

                <!-- Price -->
                <h4 class="text-primary mb-0">${{ number_format($property->price, 2) }}</h4>
            </div>

            <div class="row g-5">
                <!-- Left Column: Property Images -->
                <div class="col-lg-8">
                    <!-- Main Image with Carousel -->
                    <div class="position-relative overflow-hidden rounded mb-3">
                        @if ($property->images->count() > 3)
                            <!-- Carousel -->
                            <div id="propertyCarousel" class="carousel slide" data-bs-interval="false">
                                <div class="carousel-inner">
                                    @foreach ($property->images as $key => $image)
                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                            <img class="d-block w-100" src="{{ asset('storage/' . $image->image_path) }}" alt="Property Image" style="height: 400px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <!-- Remaining Images Count -->
                            <div class="position-absolute bottom-0 start-0 bg-dark text-white px-3 py-1 rounded">
                                +{{ $property->images->count() }} more
                            </div>
                        @else
                            <!-- Single Main Image -->
                            <img id="mainImage" class="img-fluid w-100" src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->title }}" style="height: 400px; object-fit: cover;">
                        @endif
                    </div>
                </div>

                <!-- Right Column: Thumbnail Images -->
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-2 h-100">
                        @foreach ($property->images->skip(1)->take(2) as $image)
                            <img class="img-thumbnail thumbnail-image" src="{{ asset('storage/' . $image->image_path) }}" alt="Thumbnail" style="cursor: pointer;" onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')">
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Property Description -->
            <!-- filepath: /Applications/MAMP/htdocs/real-estate/resources/views/properties/show.blade.php -->
<div class="row mt-5">
    <!-- Left Column: Property Description -->
    <div class="col-lg-8">
        <h3 class="mb-4">Property Description</h3>
        <p>{{ $property->description }}</p>
    </div>

    <!-- Right Column: Agent Information -->
    <div class="col-lg-4">
        <h3 class="mb-4">Agent Information</h3>
        <div class="d-flex align-items-center">
            <img src="{{ asset('storage/' . ($agent->image ? $agent->image->path : 'default-avatar.jpg')) }}" alt="{{ $agent->name }}" class="rounded-circle me-3" style="width: 80px; height: 80px;">
            <div>
                <h5 class="mb-1">{{ $agent->name }}</h5>
                <p class="mb-1"><i class="fa fa-phone-alt text-primary me-2"></i>{{ $agent->phone }}</p>
                <p class="mb-0"><i class="fa fa-envelope text-primary me-2"></i>{{ $agent->email }}</p>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>

    <!-- Contact Agent Modal -->
    <div class="modal fade" id="contactAgentModal" tabindex="-1" aria-labelledby="contactAgentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="contactAgentModalLabel">Bog'lanish uchun ma'lumotlaringizni kiriting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('contact.agent') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Ismingiz</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ismingizni kiriting" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefon raqamingiz</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="+998 90 123 45 67" required>
                        </div>
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <button type="submit" class="btn btn-primary w-100">Yuborish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>