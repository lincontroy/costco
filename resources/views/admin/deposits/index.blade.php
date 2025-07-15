<x-admin>
    @section('title', 'Deposits')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Deposits Table</h3>
          
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="depositsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Reference Number</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Proof</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deposits as $deposit)
                            <tr>
                                <td>{{ $deposit->id }}</td>
                                <td>{{ $deposit->user->name }}</td>
                                <td>ETB {{ number_format($deposit->amount, 2) }}</td>
                                <td>{{ $deposit->payment_method }}</td>
                                <td>{{ $deposit->reference_number }}</td>
                                <td>
                                    <span class="badge badge-{{ $deposit->status == 'approved' ? 'success' : ($deposit->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($deposit->status) }}
                                    </span>
                                </td>
                                <td>{{ $deposit->notes ?? 'N/A' }}</td>
                                <td>
                                    @if($deposit->proof_path)
                                        <a href="{{ asset('storage/' . $deposit->proof_path) }}" target="_blank" class="btn btn-xs btn-info">View</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $deposit->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    @if($deposit->status == 'pending')
                                        <button type="button" class="btn btn-xs btn-success" onclick="approveDeposit({{ $deposit->id }}, '{{ $deposit->user->name }}', '{{ number_format($deposit->amount, 2) }}')">
                                            Approve
                                        </button>
                                        <button type="button" class="btn btn-xs btn-danger" onclick="rejectDeposit({{ $deposit->id }}, '{{ $deposit->user->name }}', '{{ number_format($deposit->amount, 2) }}')">
                                            Reject
                                        </button>
                                        
                                        <!-- Hidden forms for submission -->
                                        <form id="approve-form-{{ $deposit->id }}" action="{{ route('admin.deposit.approve', $deposit->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                        <form id="reject-form-{{ $deposit->id }}" action="{{ route('admin.deposit.reject', $deposit->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                    @else
                                        <span class="text-muted">No actions</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @section('js')
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            $(function() {
                $('#depositsTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                    "order": [[0, "desc"]], // Order by ID descending (newest first)
                    "columnDefs": [
                        {
                            "targets": [9], // Actions column
                            "orderable": false
                        }
                    ]
                });
            });

            // Approve deposit function
            function approveDeposit(depositId, userName, amount) {
                Swal.fire({
                    title: 'Approve Deposit?',
                    html: `
                        <div class="text-left">
                            <p><strong>User:</strong> ${userName}</p>
                            <p><strong>Amount:</strong> ${amount}</p>
                            <p class="text-muted">This will add the amount to user's wallet balance.</p>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Approve!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Processing...',
                            text: 'Approving deposit and updating wallet balance',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                        
                        // Submit the form
                        document.getElementById('approve-form-' + depositId).submit();
                    }
                });
            }

            // Reject deposit function
            function rejectDeposit(depositId, userName, amount) {
                Swal.fire({
                    title: 'Reject Deposit?',
                    html: `
                        <div class="text-left">
                            <p><strong>User:</strong> ${userName}</p>
                            <p><strong>Amount:</strong> ${amount}</p>
                            <p class="text-warning">This action cannot be undone.</p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Reject!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Processing...',
                            text: 'Rejecting deposit',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                        
                        // Submit the form
                        document.getElementById('reject-form-' + depositId).submit();
                    }
                });
            }
        </script>
    @endsection
</x-admin>