@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Manage Withdrawals</h4>
                <p class="admin-page-subtitle">Review and process withdrawal requests</p>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="row mb-4">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="admin-form-control" placeholder="Search by user name...">
            </div>
            <div class="col-md-6 text-end">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-outline-secondary filter-btn active"
                        data-filter="all">All</button>
                    <button type="button" class="btn btn-sm btn-outline-success filter-btn"
                        data-filter="approved">Approved</button>
                    <button type="button" class="btn btn-sm btn-outline-warning filter-btn"
                        data-filter="pending">Pending</button>
                    <button type="button" class="btn btn-sm btn-outline-danger filter-btn"
                        data-filter="rejected">Rejected</button>
                </div>
            </div>
        </div>

        <!-- Withdrawal Cards -->
        <div class="row" id="withdrawalsContainer">
            @foreach($withdrawals as $withdrawal)
            <div class="col-md-6 col-lg-4 mb-4 withdrawal-card"
                data-user="{{ strtolower($withdrawal->user->first_name.' '.$withdrawal->user->last_name) }}"
                data-status="{{ $withdrawal->status }}">
                <div class="admin-card h-100"
                    style="border-left: 3px solid {{ $withdrawal->status == 'approved' ? '#10b981' : ($withdrawal->status == 'rejected' ? '#ef4444' : '#f59e0b') }};">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div
                                style="width:36px;height:36px;border-radius:50%;background:var(--accent-color);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:0.8rem;">
                                {{ strtoupper(substr($withdrawal->user->first_name, 0, 1)) }}{{
                                strtoupper(substr($withdrawal->user->last_name, 0, 1)) }}
                            </div>
                            <h6 class="mb-0" style="color:var(--heading-color);">
                                {{ $withdrawal->user->first_name }} {{ $withdrawal->user->last_name }}
                            </h6>
                        </div>
                        <span
                            class="admin-badge-{{ $withdrawal->status == 'approved' ? 'success' : ($withdrawal->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($withdrawal->status) }}
                        </span>
                    </div>

                    <div class="mb-2 d-flex justify-content-between" style="color:var(--text-color);">
                        <span>Amount:</span>
                        <strong>
                            @if($withdrawal->account_type == 'crypto')
                            {{ number_format($withdrawal->amount, 8) }} {{ strtoupper($withdrawal->crypto_currency) }}
                            @else
                            ${{ number_format($withdrawal->amount, 2) }}
                            @endif
                        </strong>
                    </div>

                    <div class="mb-2 d-flex justify-content-between" style="color:var(--text-color);">
                        <span>Account Type:</span>
                        <span class="text-capitalize">{{ $withdrawal->crypto_currency }}</span>
                    </div>

                    <div class="mb-2" style="color:var(--text-color);">
                        <span>Payment Details:</span>
                        <div class="mt-1 ps-2" style="font-size:0.85rem;">
                            <div class="d-flex justify-content-between">
                                <span>Crypto Type:</span>
                                <span class="text-capitalize">{{ $withdrawal->crypto_currency }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-1">
                                <span>Wallet:</span>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="text-truncate wallet-address" style="max-width:120px;cursor:pointer;"
                                        title="{{ $withdrawal->wallet_address }}"
                                        data-clipboard-text="{{ $withdrawal->wallet_address }}">
                                        {{ $withdrawal->wallet_address }}
                                    </span>
                                    <button class="btn btn-sm copy-btn p-0" title="Copy"
                                        style="color:var(--accent-color);">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 d-flex justify-content-between" style="color:var(--text-color);">
                        <span>Date:</span>
                        <span>{{ $withdrawal->created_at->format('M d, Y H:i') }}</span>
                    </div>

                    @if($withdrawal->status == 'pending')
                    <div class="pt-3 border-top" style="border-color:var(--border-color) !important;">
                        <div class="d-flex gap-2">
                            <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST"
                                class="flex-fill" data-ajax-form>
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm w-100">Approve</button>
                            </form>
                            <form action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}" method="POST"
                                class="flex-fill" data-ajax-form>
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm w-100">Reject</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="pt-3 border-top text-center"
                        style="border-color:var(--border-color) !important;color:var(--text-color);opacity:0.6;">
                        No actions available
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $withdrawals->links() }}
        </div>
    </div>
</div>

@include('admin.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    $(document).ready(function() {
    new ClipboardJS('.copy-btn', {
        text: function(trigger) {
            return $(trigger).closest('.d-flex').find('.wallet-address').data('clipboard-text');
        }
    });

    $('.copy-btn').on('click', function() {
        toastr.success('Wallet address copied!');
    });

    $('#searchInput').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();
        const filterStatus = $('.filter-btn.active').data('filter');
        $('.withdrawal-card').each(function() {
            const userName = $(this).data('user');
            const status = $(this).data('status');
            const matchesSearch = userName.includes(searchTerm);
            const matchesFilter = filterStatus === 'all' || status === filterStatus;
            $(this).toggle(matchesSearch && matchesFilter);
        });
    });

    $('.filter-btn').on('click', function() {
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        const filterStatus = $(this).data('filter');
        const searchTerm = $('#searchInput').val().toLowerCase();
        $('.withdrawal-card').each(function() {
            const userName = $(this).data('user');
            const status = $(this).data('status');
            const matchesSearch = userName.includes(searchTerm);
            const matchesFilter = filterStatus === 'all' || status === filterStatus;
            $(this).toggle(matchesSearch && matchesFilter);
        });
    });

    $('form[data-ajax-form]').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const button = form.find('[type="submit"]');
        const action = form.attr('action').includes('approve') ? 'approve' : 'reject';
        if(confirm(`Are you sure you want to ${action} this withdrawal?`)) {
            button.prop('disabled', true).html(`<span class="spinner-border spinner-border-sm"></span> ${action.charAt(0).toUpperCase() + action.slice(1)}ing...`);
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
                    toastr.error(response.message || 'An error occurred');
                    button.prop('disabled', false).html(action.charAt(0).toUpperCase() + action.slice(1));
                }
            });
        }
    });
});
</script>