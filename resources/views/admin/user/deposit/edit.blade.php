@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Edit Deposit</h4>
                <p class="admin-page-subtitle">For {{ $user->name }}</p>
            </div>
            <a href="{{ route('admin.users.deposits.index', $user->id) }}" class="btn btn-sm"
                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="admin-card">
                    <div class="card-body">
                        <form id="editDepositForm" method="POST"
                            action="{{ route('admin.users.deposits.update', [$user->id, $deposit->id]) }}">
                            @csrf
                            @method('PUT')

                            <div id="formErrors" class="alert alert-danger d-none"></div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        style="background:var(--input-bg);color:var(--text-color);border-color:var(--border-color);">$</span>
                                    <input type="number" step="0.01" name="amount" class="admin-form-control"
                                        value="{{ $deposit->amount }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Account Type</label>
                                <select name="account_type" class="admin-form-control" required>
                                    <option value="holding" {{ $deposit->account_type == 'holding' ? 'selected' : ''
                                        }}>Holding Account</option>
                                    <option value="trading" {{ $deposit->account_type == 'trading' ? 'selected' : ''
                                        }}>Trading Account</option>
                                    <option value="mining" {{ $deposit->account_type == 'mining' ? 'selected' : ''
                                        }}>Mining Account</option>
                                    <option value="staking" {{ $deposit->account_type == 'staking' ? 'selected' : ''
                                        }}>Staking Account</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Status</label>
                                <select name="status" class="admin-form-control" required>
                                    <option value="pending" {{ $deposit->status == 'pending' ? 'selected' : ''
                                        }}>Pending</option>
                                    <option value="approved" {{ $deposit->status == 'approved' ? 'selected' : ''
                                        }}>Approved</option>
                                    <option value="rejected" {{ $deposit->status == 'rejected' ? 'selected' : ''
                                        }}>Rejected</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-admin-primary">Update Deposit</button>
                                <a href="{{ route('admin.users.deposits.index', $user->id) }}" class="btn"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
    $('#editDepositForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        errorContainer.addClass('d-none').empty();
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Updating...');
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if(response.status === 'success') {
                    toastr.success(response.message);
                    setTimeout(() => { window.location.href = response.redirect; }, 1500);
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('Update Deposit');
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul class="mb-0">';
                    $.each(errors, function(key, value) { errorHtml += '<li>' + value[0] + '</li>'; });
                    errorHtml += '</ul>';
                    errorContainer.html(errorHtml).removeClass('d-none');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });
});
</script>