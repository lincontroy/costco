<div class="row">
    @role('admin')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $user }}</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.user.index') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $category }}</h3>
                    <p>Total Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <a href="{{ route('admin.category.index') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $product }}</h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <i class="fas fas fa-th"></i>
                </div>
                <a href="{{ route('admin.product.index') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $collection }}</h3>
                    <p>Total Collections</p>
                </div>
                <div class="icon">
                    <i class="fas fas fa-file-pdf"></i>
                </div>
                <a href="{{ route('admin.collection.index') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endrole

    @role('user')

    <div class="row">
    <!-- Wallet Balance -->
    <div class="col-lg-4 col-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <i class="fas fa-wallet fa-2x text-primary mb-2"></i>
                <h5 class="card-title">Wallet Balance</h5>
                <p class="card-text h5 text-success">
                    ETB {{ number_format($user->wallet_balance, 2) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Total Commissions -->
    <div class="col-lg-4 col-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <i class="fas fa-coins fa-2x text-warning mb-2"></i>
                <h5 class="card-title">Total Commissions</h5>
                <p class="card-text h5 text-info">
                    ETB {{ number_format($totalCommissions, 2) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Total Withdrawals -->
    <div class="col-lg-4 col-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <i class="fas fa-hand-holding-usd fa-2x text-danger mb-2"></i>
                <h5 class="card-title">Total Withdrawals</h5>
                <p class="card-text h5 text-danger">
                    ETB {{ number_format($totalWithdrawals, 2) }}
                </p>
            </div>
        </div>
    </div>
</div>


    @endrole
</div>
