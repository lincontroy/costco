<x-admin>
    @section('title', 'Orders')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Orders Table</h3>
            <div class="card-tools"><a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary">Add</a></div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
    <table class="table table-striped" id="userTable">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Package Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->package_name }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>
                        {{-- optional actions here --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

        </div>
    </div>
    @section('js')
        <script>
            $(function() {
                $('#userTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
