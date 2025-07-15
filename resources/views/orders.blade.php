@php
    $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->get();
@endphp

<x-admin>
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-shopping-cart me-2"></i>
                        My Orders
                    </h4>
                </div>
                
                <div class="card-body">
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
                                       placeholder="Search by package name, status, or order ID...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <span class="badge bg-info fs-6">Total Orders: <span id="totalOrders">{{ $orders->count() }}</span></span>
                            </div>
                        </div>
                    </div>

                    @if($orders->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No orders found</h5>
                            <p class="text-muted">You haven't placed any orders yet.</p>
                        </div>
                    @else
                        <!-- Orders Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="ordersTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">Package</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Product Value</th>
                                        <th scope="col">Commission</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Commission Date</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="ordersTableBody">
                                    @foreach($orders as $order)
                                        <tr class="order-row">
                                            <td class="text-center fw-bold">#{{ $order->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                        <i class="fas fa-box text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $order->package_name }}</h6>
                                                        <small class="text-muted">Package</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-primary">ETB {{ number_format($order->price, 2) }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-success">ETB {{ number_format($order->product_value, 2) }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-warning">ETB {{ number_format($order->commission, 2) }}</span>
                                            </td>
                                            <td>
                                                @switch($order->status)
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
                                                    @case('cancelled')
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times-circle me-1"></i>Cancelled
                                                        </span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <div>
                                                    <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                                                    <br>
                                                    <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                @if($order->commission_processed_at)
                                                    <div>
                                                        <small class="text-success">{{ $order->commission_processed_at->format('M d, Y') }}</small>
                                                        <br>
                                                        <small class="text-success">{{ $order->commission_processed_at->format('h:i A') }}</small>
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
                                                            data-bs-target="#orderModal{{ $order->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    @if($order->status == 'pending')
                                                        <button type="button" 
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="cancelOrder({{ $order->id }})">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Order Details Modal -->
                                        <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Order Details #{{ $order->id }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Package:</strong></div>
                                                            <div class="col-sm-6">{{ $order->package_name }}</div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Price:</strong></div>
                                                            <div class="col-sm-6">ETB {{ number_format($order->price, 2) }}</div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Product Value:</strong></div>
                                                            <div class="col-sm-6">ETB {{ number_format($order->product_value, 2) }}</div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Commission:</strong></div>
                                                            <div class="col-sm-6">ETB {{ number_format($order->commission, 2) }}</div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Status:</strong></div>
                                                            <div class="col-sm-6">
                                                                @switch($order->status)
                                                                    @case('pending')
                                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                                        @break
                                                                    @case('completed')
                                                                        <span class="badge bg-success">Completed</span>
                                                                        @break
                                                                    @case('cancelled')
                                                                        <span class="badge bg-danger">Cancelled</span>
                                                                        @break
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6"><strong>Order Date:</strong></div>
                                                            <div class="col-sm-6">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                                                        </div>
                                                        @if($order->commission_processed_at)
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-6"><strong>Commission Date:</strong></div>
                                                                <div class="col-sm-6">{{ $order->commission_processed_at->format('M d, Y h:i A') }}</div>
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
                            <h5 class="text-muted">No orders match your search</h5>
                            <p class="text-muted">Try adjusting your search terms.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const ordersTableBody = document.getElementById('ordersTableBody');
    const noResults = document.getElementById('noResults');
    const totalOrders = document.getElementById('totalOrders');
    const ordersTable = document.getElementById('ordersTable');

    if (searchInput && ordersTableBody) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = ordersTableBody.querySelectorAll('.order-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const orderNumber = row.querySelector('td:first-child').textContent.toLowerCase();
                const packageName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
                
                if (orderNumber.includes(searchTerm) || 
                    packageName.includes(searchTerm) || 
                    status.includes(searchTerm)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleCount === 0 && searchTerm !== '') {
                ordersTable.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                ordersTable.style.display = '';
                noResults.style.display = 'none';
            }

            // Update total count
            totalOrders.textContent = visibleCount;
        });
    }
});

function cancelOrder(orderId) {
    if (confirm('Are you sure you want to cancel this order?')) {
        // Add your cancel order logic here
        // You can make an AJAX call to your cancel route
        fetch(`/orders/${orderId}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error cancelling order: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error cancelling order');
        });
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

@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-group .btn {
        padding: 0.125rem 0.25rem;
    }
}
</style>
</x-admin>