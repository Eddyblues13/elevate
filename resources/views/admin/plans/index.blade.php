@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Manage Account Plans</h4>
                <p class="admin-page-subtitle">View and manage subscription plans</p>
            </div>
            <a href="{{ route('admin.plans.create') }}" class="btn btn-admin-primary"><i class="fas fa-plus me-1"></i>
                Create New Plan</a>
        </div>

        <div class="admin-card">
            <div class="admin-table">
                <div class="table-responsive">
                    <table id="PlanTable" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price ($)</th>
                                <th>Swap Fee</th>
                                <th>Trading Pairs</th>
                                <th>Leverage</th>
                                <th>Spread</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($plans as $plan)
                            <tr>
                                <td>{{ $plan->name }}</td>
                                <td>{{ number_format($plan->price, 2) }}</td>
                                <td>{{ $plan->swap_fee ? 'Yes' : 'No' }}</td>
                                <td>{{ $plan->pairs }}</td>
                                <td>{{ $plan->leverage ?? 'N/A' }}</td>
                                <td>{{ $plan->spread ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.plans.edit', $plan->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST"
                                        class="d-inline" data-ajax-delete>
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
    $('#PlanTable').DataTable({ order: [[0, 'desc']], dom: 'Bfrtip', buttons: ['copy', 'csv', 'print', 'excel', 'pdf'] });
    $('form[data-ajax-delete]').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const button = form.find('[type="submit"]');
        if(confirm('Are you sure you want to delete this plan?')) {
            button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');
            $.ajax({
                url: form.attr('action'), type: 'POST', data: form.serialize(),
                success: function(response) {
                    if(response.status === 'success') { toastr.success(response.message); form.closest('tr').fadeOut(300, function(){ $(this).remove(); }); }
                },
                error: function(xhr) { toastr.error(xhr.responseJSON?.message || 'An error occurred'); button.prop('disabled', false).html('Delete'); }
            });
        }
    });
});
</script>