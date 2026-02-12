@include('admin.header')

<div class="main-content">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:10px;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:10px;">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="mb-4">
        <h2 class="admin-page-title">Manage Deposits</h2>
        <p class="admin-page-subtitle">Review and approve or reject pending deposit requests</p>
    </div>

    <div class="admin-card">
        <div class="admin-table">
            <div class="table-responsive">
                <table id="DepositTable" class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Account Type</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deposits as $deposit)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:700;">
                                        {{ strtoupper(substr($deposit->user->first_name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>{{ $deposit->user->first_name }} {{ $deposit->user->last_name }}</div>
                                </div>
                            </td>
                            <td class="fw-semibold">${{ number_format($deposit->amount, 2) }}</td>
                            <td>
                                <span class="admin-badge admin-badge-info">{{ ucfirst($deposit->account_type) }}</span>
                            </td>
                            <td>
                                <span class="admin-badge 
                                    @if($deposit->status == 'approved') admin-badge-success
                                    @elseif($deposit->status == 'rejected') admin-badge-danger
                                    @else admin-badge-warning
                                    @endif">
                                    {{ ucfirst($deposit->status) }}
                                </span>
                            </td>
                            <td>{{ $deposit->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                @if($deposit->status == 'pending')
                                <div class="d-flex gap-1">
                                    <form action="{{ route('admin.deposits.approve', $deposit->id) }}" method="POST"
                                        class="d-inline" data-ajax-form>
                                        @csrf
                                        <button type="submit" class="btn btn-sm"
                                            style="background:rgba(34,197,94,0.15);color:#22c55e;border-radius:8px;font-weight:600;font-size:12px;">
                                            <i class="bi bi-check-lg me-1"></i>Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.deposits.reject', $deposit->id) }}" method="POST"
                                        class="d-inline" data-ajax-form>
                                        @csrf
                                        <button type="submit" class="btn btn-sm"
                                            style="background:rgba(239,68,68,0.15);color:#ef4444;border-radius:8px;font-weight:600;font-size:12px;">
                                            <i class="bi bi-x-lg me-1"></i>Reject
                                        </button>
                                    </form>
                                </div>
                                @else
                                <span style="color:var(--text-color);opacity:0.5;font-size:13px;">Processed</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000"
    };

    $(document).ready(function () {
        $('#DepositTable').DataTable({
            order: [[4, 'desc']],
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'print']
        });

        $('form[data-ajax-form]').submit(function(e) {
            e.preventDefault();
            const form = $(this);
            const button = form.find('[type="submit"]');
            const action = form.attr('action').includes('approve') ? 'approve' : 'reject';
            
            if(confirm('Are you sure you want to ' + action + ' this deposit?')) {
                button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> ...');
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if(response.status === 'success') {
                            toastr.success(response.message);
                            setTimeout(() => { window.location.reload(); }, 1500);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        toastr.error(response?.message || 'An error occurred');
                        button.prop('disabled', false).html(action.charAt(0).toUpperCase() + action.slice(1));
                    }
                });
            }
        });
    });
</script>