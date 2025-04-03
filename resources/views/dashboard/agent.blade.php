<x-layouts.app>
    <x-slot:title>Agent Paneli</x-slot:title>

    <div class="container py-5">
        <div class="row">
            <!-- Agent profili -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <img src="{{ asset('storage/' . ($agent->image ? $agent->image->path : 'default-avatar.jpg')) }}" alt="Agent Avatar" class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover; border-radius: 50%;">
                        <h2 class="h4">{{ $agent->name }}</h2>
                        <p class="text-muted">{{ $agent->designation }}</p>
                        <span class="badge bg-success">Agent</span>
                        <div class="mt-3">
                            <a href="{{ $agent->facebook }}" class="text-primary me-2" target="_blank"><i
                                    class="bi bi-facebook"></i></a>
                            <a href="{{ $agent->twitter }}" class="text-info me-2" target="_blank"><i class="bi bi-twitter"></i></a>
                            <a href="{{ $agent->instagram }}" class="text-danger" target="_blank"><i class="bi bi-instagram"></i></a>
                        </div>
                        <a href="{{ route('profile.agent.edit') }}" class="btn btn-primary btn-sm mt-3">Profilni
                            tahrirlash</a>
                    </div>
                </div>
            </div>

            <!-- Mulklar statistikasi -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 mb-4">Mening Mulklarim</h3>
            
                        <!-- Statistikalar -->
                        <div class="row text-center mb-4">
                            <div class="col-md-3">
                                <div class="p-3 bg-primary text-white rounded">
                                    <h4>{{ $properties->count() }}</h4>
                                    <p class="mb-0">Jami Mulklar</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-success text-white rounded">
                                    <h4>{{ $activeProperties->count() }}</h4>
                                    <p class="mb-0">Faol Mulklar</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-warning text-dark rounded">
                                    <h4>{{ $pendingProperties->count() }}</h4>
                                    <p class="mb-0">Ko‘rib chiqilmoqda</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-danger text-white rounded">
                                    <h4>{{ $rejectedProperties->count() }}</h4>
                                    <p class="mb-0">Rad etilgan</p>
                                </div>
                            </div>
                        </div>
            
                        <!-- Yangi Mulk Qo'shish -->
                        <div class="text-end mb-3">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#propertyModal">+ Yangi Mulk Qo‘shish</button>
                        </div>

                        <!-- Mulk Qo‘shish Modal -->
                        <div class="modal fade" id="propertyModal" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Modalni kengligini .modal-lg bilan o‘zgartirdik -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="propertyModalLabel">Yangi Mulk Qo‘shish</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Yangi Mulk Qo‘shish Formasi -->
                                        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" multiple accept="image/*">
                                            @csrf
                        
                                            <!-- Status -->
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Holat</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="available">Mavjud</option>
                                                    <option value="sold">Sotilgan</option>
                                                    <option value="pending">Kutilmoqda</option>
                                                </select>
                                            </div>

                                            <!-- Property Type -->
                                            <div class="mb-3">
                                                <label for="property_type_id" class="form-label">Mulk turi</label>
                                                <select class="form-select" id="property_type_id" name="property_type_id" required>
                                                    <option value="">Mulk turini tanlang</option>
                                                    @foreach($propertyTypes as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="property_agent_id" value="{{ $agent->id ?? '' }}">

                                            <!-- Mulk Nomi -->
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Mulk nomi</label>
                                                <input type="text" class="form-control" id="title" name="title" required>
                                            </div>
                        
                                            <!-- Tavsif -->
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Tavsif</label>
                                                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                            </div>
                        
                                            <!-- Narx -->
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Narxi</label>
                                                <input type="number" class="form-control" id="price" name="price" required>
                                            </div>
                        
                                            <!-- Manzil -->
                                            <div class="mb-3">
                                                <label for="location" class="form-label">Manzil</label>
                                                <input type="text" class="form-control" id="location" name="location" required>
                                            </div>
                        
                                            <!-- Ijara/Sotuv -->
                                            <div class="mb-3">
                                                <label for="is_for_rent_or_sale" class="form-label">Ijara yoki Sotuv</label>
                                                <select class="form-select" id="is_for_rent_or_sale" name="is_for_rent_or_sale" required>
                                                    <option value="">Ijara yoki Sotuvni tanlang</option>
                                                    <option value="rent">Ijara uchun</option>
                                                    <option value="sale">Sotuv uchun</option>
                                                </select>
                                            </div>
                        
                                             <!-- Bir nechta rasm yuklash -->
                                             <div class="mb-3">
                                                <label class="form-label">Mulk rasmlari</label>
                                                <div class="d-flex flex-wrap gap-3">
                                                    <!-- Yuklangan rasmlar uchun joy -->
                                                    <div id="image-preview-container" class="d-flex flex-wrap gap-2"></div>
                                            
                                                    <!-- Add More Pics tugmasi -->
                                                    <div class="card text-center p-3 bg-light border border-danger" style="width: 120px; height: 120px;">
                                                        <input type="file" id="image-upload" name="images[]" accept="image/*" multiple hidden>
                                                        <label for="image-upload" class="d-flex flex-column align-items-center justify-content-center h-100 text-danger">
                                                            <span class="fs-3 fw-bold">+</span>
                                                            <span class="small">Add more pics</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>                                                                                       

                                           <!-- Cancel button -->
                                           <div class="modal-footer d-flex justify-content-right gap-2">
                                               <!-- Cancel button -->
                                               <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Bekor qilish</button>
                                               <!-- Save button -->
                                               <button type="submit" class="btn btn-primary">Saqlash</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Agent qo‘shgan mulklar ro‘yxati -->
                        <div class="table-responsive">
                            @if ($properties->isNotEmpty())
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Turi</th>
                                            <th>Narxi</th>
                                            <th>Ijara/Sotuv</th>
                                            <th>Holati</th>
                                            <th>Amallar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($properties as $key => $property)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $property->title }}</td>
                                                <td>{{ ucfirst($property->type->name) }}</td>
                                                <td>${{ number_format($property->price, 2) }}</td>
                                                <td>
                                                    @if ($property->is_for_rent == 1)
                                                        <span class="badge bg-info">For Rent</span>
                                                    @elseif ($property->is_for_sale == 1)
                                                        <span class="badge bg-primary">For Sell</span>
                                                    @else
                                                        <span class="badge bg-secondary">Aniqlanmagan</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($property->status === 'available')
                                                        <span class="badge bg-success">Mavjud</span>
                                                    @elseif($property->status === 'sold')
                                                        <span class="badge bg-warning text-dark">Sotilgan</span>
                                                    @else
                                                        <span class="badge bg-danger">Kutilmoqda</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-sm btn-primary">Tahrirlash</a>
                                                    <button type="button" class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $property->id }}">O‘chirish</button>
                                                </td>
                                            </tr>
            
                                            <!-- Har bir mulk uchun alohida modal -->
                                            <div class="modal fade" id="deleteModal-{{ $property->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $property->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel-{{ $property->id }}">Tasdiqlash</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Haqiqatan ham ushbu ob'ektni o‘chirmoqchimisiz?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                                                            <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Ha, o‘chirish</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info" role="alert">
                                    Hozirda sizda qo‘shilgan mulklar mavjud emas. <a href="" class="alert-link" data-bs-toggle="modal" data-bs-target="#propertyModal">Yangi mulk qo‘shish</a> uchun shu yerni bosing.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bildirishnomalar -->
            <div class="col-md-12">
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h3 class="h5 mb-4">Yangi Bildirishnomalar</h3>

                        @if ($contacts->isEmpty())
                            <div class="alert alert-info">Hozircha hech qanday bildirishnoma mavjud emas.</div>
                        @else
                            <div class="list-group">
                                @foreach ($contacts as $contact)
                                    <div class="list-group-item list-group-item-action mb-3">
                                        <h5 class="mb-1">Ism: {{ $contact->name }}</h5>
                                        <p class="mb-1"><i class="fa fa-phone-alt text-primary me-2"></i>Telefon: {{ $contact->phone }}</p>
                                        <p class="mb-1"><i class="fa fa-home text-primary me-2"></i>Mulk ID: {{ $contact->property_id }}</p>
                                        <small class="text-muted">Yuborilgan vaqti: {{ $contact->created_at->format('d-m-Y H:i') }}</small>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
