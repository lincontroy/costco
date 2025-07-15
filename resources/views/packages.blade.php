@php
    $userLevel = auth()->user()->level; 
@endphp

<x-admin>
<div class="container py-5">
        <div class="col-md-12 col-12">
            <div class="small-box bg-success" style="min-height: 200px; padding: 2rem;">
                <div class="inner">
                    <h3>ETB {{ Auth::user()->total_commissions }}</h3>
                    <p>My Total Commissions</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="small-box-footer">
                    View <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>    
    <h2 class="text-center mb-5">Get Started</h2>
    <div class="row g-4">
        @php
            $packages = collect([
                [
                    'name' => 'Level 1',
                    'price' => 2500,
                    'product_value' => 800000,
                ],
                [
                    'name' => 'Level 2',
                    'price' => 5500,
                    'product_value' => 1200000,
                ],
                [
                    'name' => 'Level 3',
                    'price' => 8500,
                    'product_value' => 1600000,
                ],
                [
                    'name' => 'Level 4',
                    'price' => 12000,
                    'product_value' => 2000000,
                ],
                [
                    'name' => 'Level 5',
                    'price' => 24000,
                    'product_value' => 2500000,
                ],
            ])->map(function($pkg) {
                $pkg['commission'] = number_format($pkg['product_value'] * 0.10); // 10%
                return $pkg;
            });
        @endphp

        @foreach($packages as $package)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 border-0 shadow rounded-4">
            <div class="card-header text-white text-center py-3"
                style="background: linear-gradient(to right, #007bff, #0056b3); border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h5 class="mb-0">{{ $package['name'] }} </h5>
            </div>
            <div class="card-body text-center">
                <!-- <h3 class="text-primary fw-bold mb-3">
                    ETB {{ number_format($package['price']) }}
                </h3> -->
                <p class="text-muted mb-2">
                    Product Value: <strong>ETB {{ number_format($package['product_value']) }}</strong>
                </p>
                <p class="">
                    Commission: <strong>ETB {{ number_format($package['product_value'] * 0.10) }} (10%)</strong>
                </p>

                @php
                    // Determine which packages are available based on user level
                    $packageLevel = $loop->iteration; // 1, 2, 3, 4, 5
                    $isAvailable = false;
                    $isUnlocked = false;
                    $isLocked = false;
                    
                    if ($userLevel == 0) {
                        // User level 0: Only Level 1 (first package) is available
                        $isAvailable = ($packageLevel == 1);
                        $isLocked = ($packageLevel > 1);
                    } else {
                        // User level 1+: Previous levels are unlocked, next level is available
                        if ($packageLevel <= $userLevel) {
                            $isUnlocked = true; // Previous levels (including current) are unlocked
                        } elseif ($packageLevel == $userLevel + 1) {
                            $isAvailable = true; // Next level is available
                        } else {
                            $isLocked = true; // Future levels are locked
                        }
                    }
                @endphp

                @if($isUnlocked)
                    <span class="badge bg-success">Unlocked</span>
                @elseif($isLocked)
                    <span class="badge bg-danger">Locked</span>
                @endif
            </div>
            <div class="card-footer bg-transparent text-center">
                @if($isAvailable)
                    <a href="{{ route('admin.packages.show', $package['name']) }}" class="btn btn-primary w-75 rounded-pill">
                        Select
                    </a>
                @elseif($isUnlocked)
                    <button class="btn btn-success w-75 rounded-pill" disabled>Unlocked</button>
                @else
                    <button class="btn btn-secondary w-75 rounded-pill" disabled>Locked</button>
                @endif
            </div>
        </div>
    </div>
@endforeach

    </div>
</div>
</x-admin>