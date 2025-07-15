@php
    $userLevel = auth()->user()->level;
@endphp

<x-admin>
<div class="container py-3">
    <!-- Commission Box -->
    <div class="col-md-6 col-12 mb-3">
        <div class="small-box bg-success p-3" style="min-height: 100px;">
            <div class="inner">
                <h4 class="mb-1">ETB {{ Auth::user()->total_commissions }}</h4>
                <p class="mb-0 small">My Total Commissions</p>
            </div>
            <div class="icon">
                <i class="fas fa-list-alt"></i>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="small-box-footer small">
                View <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <h4 class="text-center mb-4">Get Started</h4>

    <div class="row g-3">
        @php
            $packages = collect([
                ['name' => 'Level 1', 'price' => 2500, 'product_value' => 800000],
                ['name' => 'Level 2', 'price' => 5500, 'product_value' => 1200000],
                ['name' => 'Level 3', 'price' => 11900, 'product_value' => 1600000],
                ['name' => 'Level 4', 'price' => 24000, 'product_value' => 2000000],
                ['name' => 'Level 5', 'price' => 39000, 'product_value' => 2500000],
            ])->map(fn($pkg) => array_merge($pkg, ['commission' => number_format($pkg['product_value'] * 0.10)]));
        @endphp

        @foreach($packages as $package)
            <div class="col-sm-6 col-lg-4 mb-3">
                <div class="card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-header text-white text-center py-2"
                        style="background: linear-gradient(to right, #007bff, #0056b3); border-top-left-radius: .75rem; border-top-right-radius: .75rem;">
                        <h6 class="mb-0">{{ $package['name'] }}</h6>
                    </div>
                    <div class="card-body text-center py-3 px-2">
                        <p class="text-muted small mb-1">
                            Product Value: <strong>ETB {{ number_format($package['product_value']) }}</strong>
                        </p>
                        <p class="small mb-2">
                            Commission: <strong>ETB {{ $package['commission'] }} (10%)</strong>
                        </p>

                        @php
                            $packageLevel = $loop->iteration;
                            $isAvailable = $userLevel == 0 ? ($packageLevel == 1) : ($packageLevel == $userLevel + 1);
                            $isUnlocked = $userLevel >= $packageLevel;
                            $isLocked = !$isAvailable && !$isUnlocked;
                        @endphp

                        @if($isUnlocked)
                            <span class="badge bg-success">Unlocked</span>
                        @elseif($isLocked)
                            <span class="badge bg-danger">Locked</span>
                        @endif
                    </div>
                    <div class="card-footer text-center bg-transparent py-2">
                        @if($isAvailable)
                            <a href="{{ route('admin.packages.show', $package['name']) }}" class="btn btn-sm btn-primary w-75 rounded-pill">Select</a>
                        @elseif($isUnlocked)
                            <button class="btn btn-sm btn-success w-75 rounded-pill" disabled>Unlocked</button>
                        @else
                            <button class="btn btn-sm btn-secondary w-75 rounded-pill" disabled>Locked</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</x-admin>
