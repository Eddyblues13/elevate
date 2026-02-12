@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Manage Trading Histories</h4>
                <p class="admin-page-subtitle">View and manage user trading records</p>
            </div>
            <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#createHistoryModal">
                <i class="fas fa-plus me-1"></i> Add New
            </button>
        </div>

        <div class="admin-card">
            <div class="admin-table">
                <div class="table-responsive">
                    <table id="HistoryTable" class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Trader</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histories as $history)
                            <tr>
                                <td>{{ $history->user->first_name }} {{ $history->user->last_name }}</td>
                                <td>{{ $history->trader->name }}</td>
                                <td>${{ number_format($history->amount, 2) }}</td>
                                <td>
                                    <span
                                        class="admin-badge-{{ $history->status == 'completed' ? 'success' : ($history->status == 'failed' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($history->status) }}
                                    </span>
                                </td>
                                <td>{{ $history->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $history->id }}"
                                        data-user_id="{{ $history->user_id }}"
                                        data-trader_id="{{ $history->trader_id }}" data-amount="{{ $history->amount }}"
                                        data-status="{{ $history->status }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.trading-histories.destroy', $history->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-btn"><i
                                                class="fas fa-trash"></i></button>
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

<!-- Create Modal -->
<div class="modal fade" id="createHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
            <div class="modal-header" style="border-color:var(--border-color);">
                <h5 class="modal-title" style="color:var(--heading-color);">Add New Trading History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createHistoryForm">
                <div class="modal-body">
                    <div id="createErrors" class="alert alert-danger d-none"></div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">User</label>
                        <select name="user_id" class="admin-form-control" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)<option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Trader</label>
                        <select name="trader_id" class="admin-form-control" required>
                            <option value="">Select Trader</option>
                            @foreach($traders as $trader)<option value="{{ $trader->id }}">{{ $trader->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Amount ($)</label>
                        <input type="number" step="0.01" name="amount" class="admin-form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Status</label>
                        <select name="status" class="admin-form-control" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="border-color:var(--border-color);">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-admin-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
            <div class="modal-header" style="border-color:var(--border-color);">
                <h5 class="modal-title" style="color:var(--heading-color);">Edit Trading History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editHistoryForm">
                @csrf @method('PUT')
                <input type="hidden" name="history_id" id="editHistoryId">
                <div class="modal-body">
                    <div id="editErrors" class="alert alert-danger d-none"></div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">User</label>
                        <select name="user_id" id="editUserId" class="admin-form-control" required>
                            @foreach($users as $user)<option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Trader</label>
                        <select name="trader_id" id="editTraderId" class="admin-form-control" required>
                            @foreach($traders as $trader)<option value="{{ $trader->id }}">{{ $trader->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Amount ($)</label>
                        <input type="number" step="0.01" name="amount" id="editAmount" class="admin-form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Status</label>
                        <select name="status" id="editStatus" class="admin-form-control" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="border-color:var(--border-color);">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-admin-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
    $('#HistoryTable').DataTable({ order: [[4, 'desc']], dom: 'Bfrtip', buttons: ['copy', 'csv', 'print', 'excel', 'pdf'] });

    $('#createHistoryForm').submit(function(e) {
        e.preventDefault();
        const form = $(this); const submitBtn = form.find('[type="submit"]');
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');
        $.ajax({
            url: "{{ route('admin.trading-histories.store') }}", type: 'POST', data: form.serialize(),
            success: function(r) { if(r.status === 'success') { toastr.success(r.message); $('#createHistoryModal').modal('hide'); setTimeout(() => { window.location.reload(); }, 1500); } },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('Create');
                if(xhr.status === 422) { let h = '<ul class="mb-0">'; $.each(xhr.responseJSON.errors, function(k,v){ h += '<li>'+v[0]+'</li>'; }); h += '</ul>'; $('#createErrors').html(h).removeClass('d-none'); }
                else { toastr.error(xhr.responseJSON?.message || 'An error occurred'); }
            }
        });
    });

    $('.edit-btn').click(function() {
        $('#editHistoryId').val($(this).data('id'));
        $('#editUserId').val($(this).data('user_id'));
        $('#editTraderId').val($(this).data('trader_id'));
        $('#editAmount').val($(this).data('amount'));
        $('#editStatus').val($(this).data('status'));
        new bootstrap.Modal(document.getElementById('editHistoryModal')).show();
    });

    $('#editHistoryForm').submit(function(e) {
        e.preventDefault();
        const form = $(this); const submitBtn = form.find('[type="submit"]');
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');
        $.ajax({
            url: "/admin/trading-histories/" + $('#editHistoryId').val(), type: 'POST', data: form.serialize(),
            success: function(r) { if(r.status === 'success') { toastr.success(r.message); $('#editHistoryModal').modal('hide'); setTimeout(() => { window.location.reload(); }, 1500); } },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('Update');
                if(xhr.status === 422) { let h = '<ul class="mb-0">'; $.each(xhr.responseJSON.errors, function(k,v){ h += '<li>'+v[0]+'</li>'; }); h += '</ul>'; $('#editErrors').html(h).removeClass('d-none'); }
                else { toastr.error(xhr.responseJSON?.message || 'An error occurred'); }
            }
        });
    });

    $('.delete-btn').click(function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        if(confirm('Are you sure?')) {
            $.ajax({
                url: form.attr('action'), type: 'POST', data: form.serialize(),
                success: function(r) { if(r.status === 'success') { toastr.success(r.message); form.closest('tr').fadeOut(300, function(){ $(this).remove(); }); } },
                error: function(xhr) { toastr.error(xhr.responseJSON?.message || 'An error occurred'); }
            });
        }
    });
});
</script>