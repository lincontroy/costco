<x-admin>
    @section('title','Dashboard')
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
                    <h3>{{App\Models\User::where('level', '!=', 0)->count();}}</h3>
                    <p>Active users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <a href="{{ route('admin.user.index') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ App\Models\Order::count() }}</h3>
                    <p>Total Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fas fa-th"></i>
                </div>
                <a href="{{ route('admin.orders') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>ETB {{App\Models\Deposit::where('status', '=', 'approved')->sum('amount');}}</h3>
                    <p>Approved Deposits</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <a href="{{ route('admin.deposits') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
       
    @endrole
</div>
@role('user')
<div class="row">
   
    <!-- Wallet Balance -->
         <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h5>ETB {{ $walletBalance }}</h5>
                    <p>Wallet balance</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h5>ETB {{ $totalCommissions }}</h5>
                    <p>Total totalCommissions</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-4 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h5>ETB {{ $totalWthdrawals }}</h5>
                    <p>Total Withdrawals</p>
                </div>
                <div class="icon">
                    <i class="fas fas fa-file-pdf"></i>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>



    
</div>

<div class="row mt-4">
    <div class="col-12 text-center">
        <a href="{{ route('admin.packages') }}" class="btn btn-lg btn-primary px-5 py-3">
            <i class="fas fa-rocket me-2"></i> Get Started
        </a>
    </div>
</div>

<!-- Partners -->
 <style>
   .partners {
    width: 100%;
}

.partner-slider {
    width: 100%;
    overflow: hidden;
    position: relative;
    height: 150px;
}

.slider-track {
    display: flex;
    width: calc(200%); /* adjust as needed if you want more repetitions */
    animation: scroll 15s linear infinite;
}

.partner-logo img {
    max-height: 250px; /* or any size you want */
    height: auto;
}

@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}


 </style>
<section class="partners py-5 bg-light">
    <div class="text-center mb-4">
        <h3>Our Partners</h3>
    </div>

    <div class="partner-slider overflow-hidden">
        <div class="slider-track ">
            <div class="partner-logo">
                <img src="{{url('images/partners/cosco.png')}}" alt="Partner 1" class="img-fluid">
            </div>
            <div class="partner-logo px-4">
                <img src="{{url('images/partners/alibaba.png')}}" alt="Partner 2" class="img-fluid">
            </div>
            <div class="partner-logo px-4">
                <img src="{{url('images/partners/aliexpress.png')}}" alt="Partner 3" class="img-fluid">
            </div>
            <div class="partner-logo px-4">
                <img src="{{url('images/partners/shopify.png')}}" alt="Partner 4" class="img-fluid">
            </div>
            <div class="partner-logo px-4">
                <img src="{{url('images/partners/amazon.png')}}" alt="Partner 5" class="img-fluid">
            </div>
            <div class="partner-logo px-4">
                <img src="{{url('images/partners/wayfair.png')}}" alt="Partner 5" class="img-fluid">
            </div>
        </div>
    </div>
</section>


@endrole


</x-admin>
