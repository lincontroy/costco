<x-admin>

    <div class="container py-5">
        <!-- Package Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">{{ $package['name'] }} Package</h2>
            <span class="badge bg-primary fs-6 px-3 py-2">Premium Selection</span>
        </div>

        <!-- Package Details Card -->
        <div class="card shadow-lg rounded-4 mb-5 overflow-hidden">
            <div class="card-header bg-gradient text-white text-center py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h3 class="mb-1 fw-bold">ETB {{ number_format($package['price']) }}</h3>
                <small class="opacity-75">One-time Investment</small>
            </div>
            
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-gift text-success me-3 fs-4"></i>
                            <div>
                                <h6 class="mb-1">Product Value</h6>
                                <span class="text-muted">ETB {{ number_format($package['product_value']) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-percentage text-warning me-3 fs-4"></i>
                            <div>
                                <h6 class="mb-1">Commission (10%)</h6>
                                <span class="text-success fw-bold">ETB {{ number_format($package['product_value'] * 0.10) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>

        <!-- Products Preview Section -->
        @if($levelImages->isNotEmpty())
            <div class="mb-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-eye text-primary me-2"></i>

                    
                        <h4 class="mb-0">
                            @php
                                $categoryNames = [
                                    'Level 1' => 'Automotive',
                                    'Level 2' => 'Apple accessories', 
                                    'Level 3' => 'Gym and fitness',
                                    'Level 4' => 'Furniture',
                                    'Level 5' => 'Electronics'
                                ];
                            @endphp
                            {{ $categoryNames[$package['name']] ?? $package['name'] }}
                        </h4>
                        <br>
                        <span class="badge bg-secondary ms-2">{{ $levelImages->count() }} item(s)</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-primary btn-sm me-2" onclick="toggleView()">
                            <i class="fas fa-th-large" id="viewIcon"></i>
                            <span id="viewText">Grid View</span>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" onclick="toggleImageSize()">
                            <i class="fas fa-expand-alt" id="sizeIcon"></i>
                            <span id="sizeText">Large</span>
                        </button>
                    </div>
                </div>
                
             <!-- Updated HTML with image selection -->
<div class="row g-4" id="imageGrid">
    @foreach($levelImages as $index => $image)
        <div class="col-6 col-md-4 col-lg-3 image-item">
            <div class="card h-100 shadow-sm border-0 overflow-hidden position-relative image-card" 
                 onclick="toggleImageSelection(this, '{{ $image }}', {{ $index }})">
                
                <!-- Selection checkbox -->
                <div class="position-absolute top-0 start-0 p-2" style="z-index: 10;">
                    <input type="checkbox" class="form-check-input image-checkbox" 
                           id="image_{{ $index }}" 
                           value="{{ $image }}"
                           style="transform: scale(1.2);">
                </div>
                
                <!-- Selection overlay -->
                <div class="selection-overlay position-absolute top-0 start-0 w-100 h-100 d-none" 
                     style="background: rgba(0, 123, 255, 0.3); z-index: 5;">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <i class="fas fa-check-circle text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                
                <img src="{{ $image }}" 
                     class="card-img-top product-image" 
                     alt="{{ $package['name'] }} Product {{ $index + 1 }}"
                     style="height: 200px; object-fit: cover; transition: transform 0.3s ease;"
                     loading="lazy">
                     
                <div class="card-img-overlay d-flex align-items-end p-0">
                    <div class="bg-dark bg-opacity-75 text-white p-2 w-100">
                        <small class="mb-0">{{ $package['name'] }} - Item {{ $index + 1 }}</small>
                    </div>
                </div>
                
                <!-- Image Actions -->
                <div class="image-actions position-absolute top-0 end-0 p-2" style="z-index: 10;">
                    <button class="btn btn-sm btn-light rounded-circle shadow-sm" 
                            onclick="event.stopPropagation(); openImageModal('{{ $image }}', '{{ $package['name'] }} - Item {{ $index + 1 }}')"
                            title="View Full Size">
                        <i class="fas fa-expand-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Selection Summary -->
<div class="mt-4 p-3 bg-light rounded d-none" id="selectionSummary">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <strong>Selected Images: <span id="selectedCount">0</span></strong>
        </div>
        <div>
            <button class="btn btn-sm btn-outline-primary me-2" onclick="selectAll()">
                <i class="fas fa-check-double"></i> Select All
            </button>
            <button class="btn btn-sm btn-outline-secondary" onclick="clearSelection()">
                <i class="fas fa-times"></i> Clear All
            </button>
        </div>
    </div>
</div>

<script>
// Image selection functionality
let selectedImages = [];

function toggleImageSelection(card, imageUrl, index) {
    const checkbox = card.querySelector('.image-checkbox');
    const overlay = card.querySelector('.selection-overlay');
    
    // Toggle checkbox
    checkbox.checked = !checkbox.checked;
    
    if (checkbox.checked) {
        // Add to selection
        selectedImages.push({
            url: imageUrl,
            index: index
        });
        overlay.classList.remove('d-none');
        card.classList.add('selected');
    } else {
        // Remove from selection
        selectedImages = selectedImages.filter(img => img.index !== index);
        overlay.classList.add('d-none');
        card.classList.remove('selected');
    }
    
    updateSelectionSummary();
}

function updateSelectionSummary() {
    const summary = document.getElementById('selectionSummary');
    const count = document.getElementById('selectedCount');
    
    count.textContent = selectedImages.length;
    
    if (selectedImages.length > 0) {
        summary.classList.remove('d-none');
    } else {
        summary.classList.add('d-none');
    }
}

function selectAll() {
    const checkboxes = document.querySelectorAll('.image-checkbox');
    const cards = document.querySelectorAll('.image-card');
    
    selectedImages = [];
    
    checkboxes.forEach((checkbox, index) => {
        checkbox.checked = true;
        const card = cards[index];
        const overlay = card.querySelector('.selection-overlay');
        
        overlay.classList.remove('d-none');
        card.classList.add('selected');
        
        selectedImages.push({
            url: checkbox.value,
            index: index
        });
    });
    
    updateSelectionSummary();
}

function clearSelection() {
    const checkboxes = document.querySelectorAll('.image-checkbox');
    const cards = document.querySelectorAll('.image-card');
    
    selectedImages = [];
    
    checkboxes.forEach((checkbox, index) => {
        checkbox.checked = false;
        const card = cards[index];
        const overlay = card.querySelector('.selection-overlay');
        
        overlay.classList.add('d-none');
        card.classList.remove('selected');
    });
    
    updateSelectionSummary();
}

// Get selected images (use this function to get selected images)
function getSelectedImages() {
    return selectedImages;
}

// Check if any images are selected
function hasSelectedImages() {
    return selectedImages.length > 0;
}

// Simple modal close fix
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function(button) {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal');
            modal.style.display = 'none';
            modal.classList.remove('show');
            document.body.classList.remove('modal-open');
            
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        });
    });
});
</script>

<style>
.image-card {
    cursor: pointer;
    transition: all 0.3s ease;
}

.image-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.image-card.selected {
    border: 2px solid #007bff !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,123,255,0.3) !important;
}

.image-checkbox {
    background: white;
    border: 2px solid #dee2e6;
}

.image-checkbox:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.selection-overlay {
    backdrop-filter: blur(1px);
}

.card:hover img {
    transform: scale(1.05);
}

.image-actions {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.card:hover .image-actions {
    opacity: 1;
}

@media (max-width: 768px) {
    .image-actions {
        opacity: 1;
    }
}
</style>
                
                <!-- Pagination for large image sets -->
                @if($levelImages->count() > 12)
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Image pagination">
                            <ul class="pagination" id="imagePagination">
                                <!-- Pagination will be generated by JavaScript -->
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open text-muted display-1 mb-3"></i>
                <h5 class="text-muted">No products available for {{ $package['name'] }}</h5>
                <p class="text-muted">Product images will be displayed here when available.</p>
            </div>
        @endif

        <div class="card-footer bg-transparent text-center py-4">
                <form id="orderForm" method="POST" action="{{ route('admin.packages.order') }}">
                    @csrf
                    <input type="hidden" name="name" value="{{ $package['name'] }}">
                    <input type="hidden" name="price" value="{{ $package['price'] }}">
                    <input type="hidden" name="product_value" value="{{ $package['product_value'] }}">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 py-3 shadow-sm" id="orderBtn">
                        <i class="fas fa-bullhorn me-2"></i>
                        <span class="btn-text">Proceed to Advertise</span>
                        <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                    </button>
                </form>
            </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="imageModalLabel">Product Image</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <img id="modalImage" src="" class="img-fluid w-100" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Insufficient Balance Modal -->
    <div class="modal fade" id="insufficientBalanceModal" tabindex="-1" aria-labelledby="insufficientBalanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="mb-3 text-warning">Insufficient Balance</h4>
                    <p class="mb-4 text-muted">
                        <strong>Required Amount:</strong> ETB <span id="requiredAmount"></span><br>
                        <strong>Available Balance:</strong> ETB <span id="availableBalance"></span>
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('admin.wallet.deposit') }}" class="btn btn-primary">Top Up Wallet</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="mb-3 text-success">Order Successful!</h4>
                    <p class="mb-4 text-muted">Your commission of <strong class="text-success">ETB <span id="commissionAmount"></span></strong> will be reflected in your dashboard within <strong>5 minutes</strong>.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('admin.packages') }}" class="btn btn-primary">Proceed</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentView = 'grid';
        let currentImageSize = 'normal';
        let currentPage = 1;
        const itemsPerPage = 12;

        // Order form handling
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('orderBtn');
            const btnText = btn.querySelector('.btn-text');
            const spinner = btn.querySelector('.spinner-border');
            
            // Show loading state
            btn.disabled = true;
            btnText.textContent = 'Processing...';
            spinner.classList.remove('d-none');
            
            // Get form data
            const formData = new FormData(this);
            
            // Send AJAX request
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update modal content
                    document.getElementById('commissionAmount').textContent = data.commission;
                    
                    // Show success modal
                    const modal = new bootstrap.Modal(document.getElementById('successModal'));
                    modal.show();
                } else {
                    // Handle insufficient balance or other errors
                    if (data.required_amount && data.available_balance) {
                        // Show insufficient balance modal
                        document.getElementById('requiredAmount').textContent = data.required_amount;
                        document.getElementById('availableBalance').textContent = data.available_balance;
                        
                        const modal = new bootstrap.Modal(document.getElementById('insufficientBalanceModal'));
                        modal.show();
                    } else {
                        // Show generic error
                        alert('Error: ' + (data.message || 'Something went wrong'));
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            })
            .finally(() => {
                // Reset button state
                btn.disabled = false;
                btnText.textContent = 'Proceed to Advertise';
                spinner.classList.add('d-none');
            });
        });

        // Image modal function
        function openImageModal(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModalLabel').textContent = title;
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }

        // Toggle view function
        function toggleView() {
            const grid = document.getElementById('imageGrid');
            const viewIcon = document.getElementById('viewIcon');
            const viewText = document.getElementById('viewText');
            
            if (currentView === 'grid') {
                // Switch to list view
                grid.classList.remove('row', 'g-4');
                grid.classList.add('list-view');
                const items = grid.querySelectorAll('.image-item');
                items.forEach(item => {
                    item.className = 'col-12 image-item mb-3';
                });
                viewIcon.className = 'fas fa-th';
                viewText.textContent = 'List View';
                currentView = 'list';
            } else {
                // Switch to grid view
                grid.classList.remove('list-view');
                grid.classList.add('row', 'g-4');
                const items = grid.querySelectorAll('.image-item');
                items.forEach(item => {
                    item.className = 'col-6 col-md-4 col-lg-3 image-item';
                });
                viewIcon.className = 'fas fa-th-large';
                viewText.textContent = 'Grid View';
                currentView = 'grid';
            }
        }

        // Toggle image size function
        function toggleImageSize() {
            const images = document.querySelectorAll('.product-image');
            const sizeIcon = document.getElementById('sizeIcon');
            const sizeText = document.getElementById('sizeText');
            
            if (currentImageSize === 'normal') {
                images.forEach(img => {
                    img.style.height = '300px';
                });
                sizeIcon.className = 'fas fa-compress-alt';
                sizeText.textContent = 'Normal';
                currentImageSize = 'large';
            } else {
                images.forEach(img => {
                    img.style.height = '200px';
                });
                sizeIcon.className = 'fas fa-expand-alt';
                sizeText.textContent = 'Large';
                currentImageSize = 'normal';
            }
        }

        // Initialize pagination if needed
        document.addEventListener('DOMContentLoaded', function() {
            const totalItems = document.querySelectorAll('.image-item').length;
            if (totalItems > itemsPerPage) {
                initializePagination(totalItems);
            }
        });

        function initializePagination(totalItems) {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const paginationContainer = document.getElementById('imagePagination');
            
            if (!paginationContainer) return;
            
            paginationContainer.innerHTML = '';
            
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === 1 ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#" onclick="goToPage(${i})">${i}</a>`;
                paginationContainer.appendChild(li);
            }
            
            showPage(1);
        }

        function goToPage(page) {
            currentPage = page;
            showPage(page);
            
            // Update active pagination item
            document.querySelectorAll('.page-item').forEach(item => {
                item.classList.remove('active');
            });
            document.querySelector(`.page-item:nth-child(${page})`).classList.add('active');
        }

        function showPage(page) {
            const items = document.querySelectorAll('.image-item');
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            
            items.forEach((item, index) => {
                if (index >= startIndex && index < endIndex) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
        // Add this simple code to your existing script

// Simple function to make data-bs-dismiss work
document.addEventListener('DOMContentLoaded', function() {
    // Make all close buttons work
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function(button) {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal');
            modal.style.display = 'none';
            modal.classList.remove('show');
            document.body.classList.remove('modal-open');
            
            // Remove backdrop if exists
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        });
    });
});

// That's it! Your existing buttons with data-bs-dismiss="modal" will now work
    </script>

  

    <style>
        .card:hover img {
            transform: scale(1.05);
        }
        
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }
        
        .card-header.bg-gradient {
            border: none;
        }
        
        .image-actions {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .card:hover .image-actions {
            opacity: 1;
        }
        
        .list-view .image-item {
            margin-bottom: 1rem;
        }
        
        .list-view .card {
            display: flex;
            flex-direction: row;
            align-items: center;
        }
        
        .list-view .card-img-top {
            width: 150px;
            height: 100px;
            flex-shrink: 0;
        }
        
        .list-view .card-body {
            flex: 1;
        }
        
        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .list-view .card {
                flex-direction: column;
            }
            
            .list-view .card-img-top {
                width: 100%;
                height: 200px;
            }
        }
    </style>
</x-admin>