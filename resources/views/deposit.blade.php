@php
    $deposits = auth()->user()->deposits()->orderBy('created_at', 'desc')->get();
@endphp

<x-admin>
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-wallet me-2"></i>
                            My Deposits
                        </h4>
                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#depositModal">
                            <i class="fas fa-plus me-2"></i>
                            Make Deposit
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Summary Cards -->
                    <div class="row mb-4 g-3">
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body text-white position-relative">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="card-title mb-2 opacity-75">Total Deposits</h6>
                        <h3 class="mb-0 fw-bold">ETB {{ number_format($deposits->sum('amount'), 2) }}</h3>
                    </div>
                    <div class="opacity-50">
                        <i class="fas fa-coins fa-2x"></i>
                    </div>
                </div>
                <div class="position-absolute bottom-0 end-0 p-3">
                  
                </div>
            </div>
        </div>
    </div>

    <br>
    
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
            <div class="card-body text-white position-relative">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="card-title mb-2 opacity-75">Completed</h6>
                        <h3 class="mb-0 fw-bold">ETB {{ number_format($deposits->where('status', 'completed')->sum('amount'), 2) }}</h3>
                    </div>
                    <div class="opacity-50">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
                <div class="position-absolute bottom-0 end-0 p-3">
                   
                </div>
            </div>
        </div>
    </div>

    <br>
    
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="card-body text-white position-relative">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="card-title mb-2 opacity-75">Pending</h6>
                        <h3 class="mb-0 fw-bold">ETB {{ number_format($deposits->where('status', 'pending')->sum('amount'), 2) }}</h3>
                    </div>
                    <div class="opacity-50">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
                <div class="position-absolute bottom-0 end-0 p-3">
                    
                </div>
            </div>
        </div>
    </div>

    <br>
    
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #fc4a1a 0%, #f7b733 100%);">
            <div class="card-body text-white position-relative">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="card-title mb-2 opacity-75">Failed</h6>
                        <h3 class="mb-0 fw-bold">ETB {{ number_format($deposits->where('status', 'failed')->sum('amount'), 2) }}</h3>
                    </div>
                    <div class="opacity-50">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                </div>
                <div class="position-absolute bottom-0 end-0 p-3">
                   
                </div>
            </div>
        </div>
    </div>
</div>
<br>


                    <!-- Search Bar -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" 
                                       id="searchInput" 
                                       class="form-control" 
                                       placeholder="Search by reference, method, or status...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <span class="badge bg-info fs-6">Total Records: <span id="totalDeposits">{{ $deposits->count() }}</span></span>
                            </div>
                        </div>
                    </div>

                    @if($deposits->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No deposits found</h5>
                            <p class="text-muted">You haven't made any deposits yet. Click "Make Deposit" to get started.</p>
                        </div>
                    @else
                        <!-- Deposits Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="depositsTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">Reference</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Method</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Processed Date</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="depositsTableBody">
                                    @foreach($deposits as $deposit)
                                        <tr class="deposit-row">
                                            <td class="text-center fw-bold">#{{ $deposit->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                        <i class="fas fa-receipt text-success"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $deposit->reference_number }}</h6>
                                                        <small class="text-muted">Reference</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-success">ETB {{ number_format($deposit->amount, 2) }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $deposit->payment_method)) }}</span>
                                            </td>
                                            <td>
                                                @switch($deposit->status)
                                                    @case('pending')
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="fas fa-clock me-1"></i>Pending
                                                        </span>
                                                        @break
                                                    @case('completed')
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check-circle me-1"></i>Completed
                                                        </span>
                                                        @break
                                                    @case('failed')
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times-circle me-1"></i>Failed
                                                        </span>
                                                        @break
                                                    @case('cancelled')
                                                        <span class="badge bg-secondary">
                                                            <i class="fas fa-ban me-1"></i>Cancelled
                                                        </span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <div>
                                                    <small class="text-muted">{{ $deposit->created_at->format('M d, Y') }}</small>
                                                    <br>
                                                    <small class="text-muted">{{ $deposit->created_at->format('h:i A') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                @if($deposit->processed_at)
                                                    <div>
                                                        <small class="text-success">{{ $deposit->processed_at->format('M d, Y') }}</small>
                                                        <br>
                                                        <small class="text-success">{{ $deposit->processed_at->format('h:i A') }}</small>
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#depositDetailsModal{{ $deposit->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    @if($deposit->status == 'pending')
                                                        <button type="button" 
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="cancelDeposit({{ $deposit->id }})">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Deposit Details Modal -->
                                        <div class="modal fade" id="depositDetailsModal{{ $deposit->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Deposit Details #{{ $deposit->id }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Reference:</strong></div>
                                                            <div class="col-sm-6">{{ $deposit->reference_number }}</div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Amount:</strong></div>
                                                            <div class="col-sm-6">ETB {{ number_format($deposit->amount, 2) }}</div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Payment Method:</strong></div>
                                                            <div class="col-sm-6">{{ ucfirst(str_replace('_', ' ', $deposit->payment_method)) }}</div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Status:</strong></div>
                                                            <div class="col-sm-6">
                                                                @switch($deposit->status)
                                                                    @case('pending')
                                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                                        @break
                                                                    @case('completed')
                                                                        <span class="badge bg-success">Completed</span>
                                                                        @break
                                                                    @case('failed')
                                                                        <span class="badge bg-danger">Failed</span>
                                                                        @break
                                                                    @case('cancelled')
                                                                        <span class="badge bg-secondary">Cancelled</span>
                                                                        @break
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Deposit Date:</strong></div>
                                                            <div class="col-sm-6">{{ $deposit->created_at->format('M d, Y h:i A') }}</div>
                                                        </div>
                                                        @if($deposit->processed_at)
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-6"><strong>Processed Date:</strong></div>
                                                                <div class="col-sm-6">{{ $deposit->processed_at->format('M d, Y h:i A') }}</div>
                                                            </div>
                                                        @endif
                                                        @if($deposit->notes)
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-6"><strong>Notes:</strong></div>
                                                                <div class="col-sm-6">{{ $deposit->notes }}</div>
                                                            </div>
                                                        @endif
                                                        @if($deposit->proof_path)
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-6"><strong>Proof:</strong></div>
                                                                <div class="col-sm-6">
                                                                    <a href="{{ asset('storage/' . $deposit->proof_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-download me-1"></i>View Proof
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- No Results Message (Hidden by default) -->
                        <div id="noResults" class="text-center py-5" style="display: none;">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No deposits match your search</h5>
                            <p class="text-muted">Try adjusting your search terms.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Make Deposit Modal -->
<div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="depositModalLabel">Make New Deposit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.wallet.deposit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">ETB</span>
                            <input type="number" 
                                   class="form-control @error('amount') is-invalid @enderror" 
                                   id="amount" 
                                   name="amount" 
                                   step="0.01" 
                                   min="1" 
                                   value="{{ old('amount') }}"
                                   required>
                        </div>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                        <select class="form-select @error('payment_method') is-invalid @enderror" 
                                id="payment_method" 
                                name="payment_method" 
                                required>
                            <option value="">Select Payment Method</option>
                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="mobile_money" {{ old('payment_method') == 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="chapa" {{ old('payment_method') == 'chapa' ? 'selected' : '' }}>Chapa</option>
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reference_number" class="form-label">Reference Number <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('reference_number') is-invalid @enderror" 
                               id="reference_number" 
                               name="reference_number" 
                               placeholder="Enter transaction reference number"
                               value="{{ old('reference_number') }}"
                               required>
                        @error('reference_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" 
                                  name="notes" 
                                  rows="3" 
                                  placeholder="Any additional information...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="proof" class="form-label">Proof of Payment (Optional)</label>
                        <input type="file" 
                               class="form-control @error('proof') is-invalid @enderror" 
                               id="proof" 
                               name="proof" 
                               accept="image/*,.pdf">
                        <div class="form-text">Upload receipt or proof of payment (Image or PDF, max 5MB)</div>
                        @error('proof')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane me-1"></i>Submit Deposit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS if not already included -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const depositsTableBody = document.getElementById('depositsTableBody');
    const noResults = document.getElementById('noResults');
    const totalDeposits = document.getElementById('totalDeposits');
    const depositsTable = document.getElementById('depositsTable');

    if (searchInput && depositsTableBody) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = depositsTableBody.querySelectorAll('.deposit-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const depositNumber = row.querySelector('td:first-child').textContent.toLowerCase();
                const reference = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const method = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                
                if (depositNumber.includes(searchTerm) || 
                    reference.includes(searchTerm) || 
                    method.includes(searchTerm) ||
                    status.includes(searchTerm)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleCount === 0 && searchTerm !== '') {
                depositsTable.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                depositsTable.style.display = '';
                noResults.style.display = 'none';
            }

            // Update total count
            totalDeposits.textContent = visibleCount;
        });
    }

    // Auto-show modal if there are validation errors
    @if($errors->any())
        var depositModal = new bootstrap.Modal(document.getElementById('depositModal'));
        depositModal.show();
    @endif
});

function cancelDeposit(depositId) {
    if (confirm('Are you sure you want to cancel this deposit?')) {
        // Create a form to cancel the deposit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/deposits/${depositId}/cancel`;
        
        // Add CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const csrfField = document.createElement('input');
        csrfField.type = 'hidden';
        csrfField.name = '_token';
        csrfField.value = csrfToken;
        form.appendChild(csrfField);
        
        // Add method override for DELETE or PATCH
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'PATCH';
        form.appendChild(methodField);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<style>
.table th {
    border-top: none;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table td {
    vertical-align: middle;
    border-top: 1px solid #dee2e6;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
}

.card {
    border-radius: 0.75rem;
}

.card-header {
    border-radius: 0.75rem 0.75rem 0 0;
}

.row .card {
    height: 100%;
}

.modal-content {
    border-radius: 0.75rem;
}

.modal-header {
    border-radius: 0.75rem 0.75rem 0 0;
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-group .btn {
        padding: 0.125rem 0.25rem;
    }
    
    .row .col-md-3 {
        margin-bottom: 1rem;
    }
}
</style>
</x-admin>