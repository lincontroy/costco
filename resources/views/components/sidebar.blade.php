<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        @role('admin')
            <li class="nav-item">
                <a href="{{ route('admin.user.index') }}"
                    class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Users
                        <span class="badge badge-info right">{{ $userCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.deposits') }}"
                    class="nav-link {{ Route::is('admin.deposits') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-coins"></i>
                    <p>Deposits
                        <span class="badge badge-info right">{{ App\Models\Deposit::count(); }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders') }}"
                    class="nav-link {{ Route::is('admin.orders') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-box"></i>
                    <p>Orders
                        <span class="badge badge-info right">{{ App\Models\Order::count() }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.role.index') }}"
                    class="nav-link {{ Route::is('admin.role.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-tag"></i>
                    <p>Role
                        <span class="badge badge-success right">{{ $RoleCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.permission.index') }}"
                    class="nav-link {{ Route::is('admin.permission.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-hat-cowboy"></i>
                    <p>Permission
                        <span class="badge badge-danger right">{{ $PermissionCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.category.index') }}"
                    class="nav-link {{ Route::is('admin.category.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list-alt"></i>
                    <p>Category
                        <span class="badge badge-warning right">{{ $CategoryCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.subcategory.index') }}"
                    class="nav-link {{ Route::is('admin.subcategory.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Sub Category
                        <span class="badge badge-secondary right">{{ $SubCategoryCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.collection.index') }}"
                    class="nav-link {{ Route::is('admin.collection.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-pdf"></i>
                    <p>Collection
                        <span class="badge badge-primary right">{{ $CollectionCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.product.index') }}"
                    class="nav-link {{ Route::is('admin.product.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Products
                        <span class="badge badge-warning right">{{ $ProductCount }}</span>
                    </p>
                </a>
            </li>
        @endrole

        @role('user')
       
        <li class="nav-item">
    <a href="{{ route('admin.packages') }}"
        class="nav-link {{ Route::is('admin.packages') ? 'active' : '' }}">
        <i class="nav-icon fas fa-layer-group"></i>
        <p>Levels</p>
    </a>
</li>



<li class="nav-item has-treeview {{ Route::is('admin.wallet.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Route::is('admin.wallet.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-wallet"></i>
        <p>
            Wallet
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.wallet.deposit') }}" 
               class="nav-link {{ Route::is('admin.wallet.deposit') ? 'active' : '' }}">
                <i class="fas fa-arrow-down nav-icon text-success"></i>
                <p>Deposit</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.wallet.withdraw') }}" 
               class="nav-link {{ Route::is('admin.wallet.withdraw') ? 'active' : '' }}">
                <i class="fas fa-arrow-up nav-icon text-danger"></i>
                <p>Withdraw</p>
            </a>
        </li>
    </ul>
</li>



<li class="nav-item">
    <a href="{{ route('admin.profile.edit') }}"
        class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Profile</p>
    </a>
</li>
@endrole


    </ul>
</nav>
