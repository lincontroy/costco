<x-admin>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Withdraw</h4>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ url('admin/wallet/withdraw') }}" method="POST">
                        @csrf

                        <h5 class="mb-4 text-primary">Payment Details</h5>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input
                                type="number"
                                class="form-control"
                                id="amount"
                                name="amount"
                                placeholder="Enter amount"
                                required
                                min="0"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="bank_details" class="form-label">Bank Details</label>
                            <textarea
                                class="form-control"
                                id="bank_details"
                                name="bank_details"
                                rows="4"
                                placeholder="Enter your bank name and account number"
                                required
                            ></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                Submit Withdrawal
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</x-admin>