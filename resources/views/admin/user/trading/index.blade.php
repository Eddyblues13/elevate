@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Manage Trades</h4>
                <p class="admin-page-subtitle">For {{ $user->name }}</p>
            </div>
        </div>

        <!-- Create Trade Form -->
        <div class="admin-card mb-4">
            <div class="card-body">
                <h6 style="color:var(--heading-color);" class="mb-3"><i class="fas fa-plus-circle me-1"></i> Create New
                    Trade</h6>
                <form id="tradeForm" action="{{ route('admin.trade.history.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Trader</label>
                            <select name="trader_name" class="admin-form-control" required>
                                <option value="">Select Trader</option>
                                <option value="VirtualBacon">VirtualBacon</option>
                                <option value="CryptoRover">CryptoRover</option>
                                <option value="BitBoy">BitBoy</option>
                                @foreach(App\Models\Trader::all() as $trader)
                                <option value="{{ $trader->name }}">{{ $trader->name }}</option>
                                @endforeach
                                <option value="Other">Other</option>
                            </select>
                            <small id="trader_name-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Symbol</label>
                            <select name="symbol" class="admin-form-control" required>
                                <option value="">Select Symbol</option>
                                <option value="BTCUSDT">BTC/USDT</option>
                                <option value="ETHUSDT">ETH/USDT</option>
                                <option value="TONUSDT">TON/USDT</option>
                                <option value="XRPUSDT">XRP/USDT</option>
                                <option value="SOLUSDT">SOL/USDT</option>
                                <option value="TSLA">Tesla (TSLA)</option>
                                <option value="AAPL">Apple (AAPL)</option>
                                <option value="GOOGL">Alphabet (GOOGL)</option>
                                <option value="AMZN">Amazon (AMZN)</option>
                                <option value="MSFT">Microsoft (MSFT)</option>
                                <option value="NFLX">Netflix (NFLX)</option>
                                <option value="META">Meta Platforms (META)</option>
                                <option value="NVDA">NVIDIA (NVDA)</option>
                                <option value="BRK.A">Berkshire Hathaway (BRK.A)</option>
                                <option value="JPM">JPMorgan Chase (JPM)</option>
                            </select>
                            <small id="symbol-error" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Direction</label>
                            <select name="direction" class="admin-form-control" required>
                                <option value="up">Long (UP)</option>
                                <option value="down">Short (DOWN)</option>
                            </select>
                            <small id="direction-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Profit</label>
                            <input type="number" step="0.0001" class="admin-form-control" name="profit" required>
                            <small id="entry_price-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Amount</label>
                            <input type="number" step="0.0001" class="admin-form-control" name="amount" required>
                            <small id="amount-error" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);">Entry Date</label>
                            <input type="datetime-local" class="admin-form-control" name="entry_date" required>
                            <small id="entry_date-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);">Status</label>
                            <select name="status" class="admin-form-control" id="statusSelect" required>
                                <option value="active">Active</option>
                                <option value="closed">Closed</option>
                            </select>
                            <small id="status-error" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row mb-3" id="closedFields" style="display:none;">
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);">Exit Price</label>
                            <input type="number" step="0.0001" class="admin-form-control" name="exit_price">
                            <small id="exit_price-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);">Exit Date</label>
                            <input type="datetime-local" class="admin-form-control" name="exit_date">
                            <small id="exit_date-error" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Notes</label>
                        <textarea class="admin-form-control" name="notes" rows="2"></textarea>
                        <small id="notes-error" class="text-danger"></small>
                    </div>

                    <button type="submit" class="btn btn-admin-primary" id="submitBtn">
                        <i class="fas fa-plus-circle me-1"></i> Create Trade
                    </button>
                </form>
            </div>
        </div>

        <!-- Trades Table -->
        <div class="admin-card">
            <div class="card-body">
                <h6 style="color:var(--heading-color);" class="mb-3">Trade History</h6>
                <div class="table-responsive">
                    <table id="tradeTable" class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Symbol</th>
                                <th>Trader</th>
                                <th>Type</th>
                                <th>Direction</th>
                                <th>Amount</th>
                                <th>Entry Price</th>
                                <th>Exit Price</th>
                                <th>Profit</th>
                                <th>Status</th>
                                <th>Entry Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trades as $trade)
                            <tr id="trade-row-{{ $trade->id }}">
                                <th scope="row">{{ $trade->id }}</th>
                                <td>{{ $trade->symbol }}</td>
                                <td>{{ $trade->trader_name }}</td>
                                <td>{{ ucfirst($trade->type) }}</td>
                                <td>
                                    <span class="admin-badge-{{ $trade->direction === 'up' ? 'success' : 'danger' }}">
                                        {{ strtoupper($trade->direction) }}
                                    </span>
                                </td>
                                <td>{{ $trade->formattedAmount }}</td>
                                <td>{{ number_format($trade->entry_price, 4) }}</td>
                                <td>{{ $trade->exit_price ? number_format($trade->exit_price, 4) : 'N/A' }}</td>
                                <td style="color:{{ $trade->profit >= 0 ? '#00d25b' : '#fc424a' }};">
                                    {{ $trade->profit ? $trade->formattedProfit : 'N/A' }}
                                </td>
                                <td>
                                    <span class="admin-badge-{{ $trade->status === 'active' ? 'info' : 'warning' }}">
                                        {{ ucfirst($trade->status) }}
                                    </span>
                                </td>
                                <td>{{ $trade->entry_date->format('M j, Y H:i') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-btn" data-trade-id="{{ $trade->id }}"
                                        data-trade="{{ $trade }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-trade-id="{{ $trade->id }}"
                                        data-trade-symbol="{{ $trade->symbol }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

<!-- Edit Trade Modal -->
<div class="modal fade" id="editTradeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
            <div class="modal-header" style="border-color:var(--border-color);">
                <h5 class="modal-title" style="color:var(--heading-color);">Edit Trade #<span id="modalTradeId"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editTradeForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="editTradeId">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);">Trader</label>
                            <select name="trader_name" class="admin-form-control" id="editTraderName" required>
                                <option value="VirtualBacon">VirtualBacon</option>
                                <option value="CryptoRover">CryptoRover</option>
                                <option value="BitBoy">BitBoy</option>
                                <option value="Other">Other</option>
                            </select>
                            <small id="edit-trader_name-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);">Symbol</label>
                            <select name="symbol" class="admin-form-control" id="editSymbol" required>
                                <option value="BTCUSDT">BTC/USDT</option>
                                <option value="ETHUSDT">ETH/USDT</option>
                                <option value="TONUSDT">TON/USDT</option>
                                <option value="XRPUSDT">XRP/USDT</option>
                                <option value="SOLUSDT">SOL/USDT</option>
                            </select>
                            <small id="edit-symbol-error" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Type</label>
                            <select name="type" class="admin-form-control" id="editType" required>
                                <option value="spot">Spot</option>
                                <option value="futures">Futures</option>
                                <option value="margin">Margin</option>
                            </select>
                            <small id="edit-type-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Direction</label>
                            <select name="direction" class="admin-form-control" id="editDirection" required>
                                <option value="up">Long (UP)</option>
                                <option value="down">Short (DOWN)</option>
                            </select>
                            <small id="edit-direction-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Status</label>
                            <select name="status" class="admin-form-control" id="editStatus" required>
                                <option value="active">Active</option>
                                <option value="closed">Closed</option>
                            </select>
                            <small id="edit-status-error" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Amount</label>
                            <input type="number" step="0.0001" class="admin-form-control" name="amount" id="editAmount"
                                required>
                            <small id="edit-amount-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Entry Price</label>
                            <input type="number" step="0.0001" class="admin-form-control" name="entry_price"
                                id="editEntryPrice" required>
                            <small id="edit-entry_price-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="color:var(--heading-color);">Profit</label>
                            <input type="number" step="0.0001" class="admin-form-control" name="profit" id="editProfit">
                            <small id="edit-profit-error" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="color:var(--heading-color);">Entry Date</label>
                            <input type="datetime-local" class="admin-form-control" name="entry_date" id="editEntryDate"
                                required>
                            <small id="edit-entry_date-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-6" id="editExitDateField" style="display:none;">
                            <label class="form-label" style="color:var(--heading-color);">Exit Date</label>
                            <input type="datetime-local" class="admin-form-control" name="exit_date" id="editExitDate">
                            <small id="edit-exit_date-error" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6" id="editExitPriceField" style="display:none;">
                            <label class="form-label" style="color:var(--heading-color);">Exit Price</label>
                            <input type="number" step="0.0001" class="admin-form-control" name="exit_price"
                                id="editExitPrice">
                            <small id="edit-exit_price-error" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Notes</label>
                        <textarea class="admin-form-control" name="notes" rows="2" id="editNotes"></textarea>
                        <small id="edit-notes-error" class="text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer" style="border-color:var(--border-color);">
                    <button type="button" class="btn"
                        style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-admin-primary" id="updateTradeBtn">
                        <i class="fas fa-save me-1"></i> Update Trade
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteTradeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
            <div class="modal-header" style="border-color:var(--border-color);">
                <h5 class="modal-title" style="color:var(--heading-color);">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete trade for <span id="deleteTradeSymbol" class="fw-bold"></span>?</p>
                <p class="text-danger">This action cannot be undone!</p>
            </div>
            <div class="modal-footer" style="border-color:var(--border-color);">
                <button type="button" class="btn"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fas fa-trash me-1"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
    // Show/hide closed fields based on status
    $('#statusSelect').change(function() {
        if ($(this).val() === 'closed') {
            $('#closedFields').show();
            $('[name="exit_price"]').prop('required', true);
            $('[name="exit_date"]').prop('required', true);
        } else {
            $('#closedFields').hide();
            $('[name="exit_price"]').prop('required', false);
            $('[name="exit_date"]').prop('required', false);
        }
    }).trigger('change');

    // Create trade form
    $('#tradeForm').on('submit', function(e) {
        e.preventDefault();
        $('.text-danger').text('');
        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creating...');
        let formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message);
                $('#tradeForm')[0].reset();
                setTimeout(() => { window.location.reload(); }, 2000);
            },
            error: function(xhr) {
                $('#submitBtn').prop('disabled', false).html('<i class="fas fa-plus-circle me-1"></i> Create Trade');
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) { $(`#${key}-error`).text(value[0]); });
                    toastr.error('Please fix the form errors');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });

    // Edit Trade Button
    $('.edit-btn').click(function() {
        const trade = $(this).data('trade');
        const tradeId = $(this).data('trade-id');
        $('#modalTradeId').text(tradeId);
        $('#editTradeId').val(tradeId);
        $('#editTraderName').val(trade.trader_name);
        $('#editSymbol').val(trade.symbol);
        $('#editType').val(trade.type);
        $('#editDirection').val(trade.direction);
        $('#editAmount').val(trade.amount);
        $('#editEntryPrice').val(trade.entry_price);
        $('#editProfit').val(trade.profit);
        $('#editStatus').val(trade.status);
        $('#editEntryDate').val(new Date(trade.entry_date).toISOString().slice(0, 16));
        $('#editExitPrice').val(trade.exit_price);
        $('#editExitDate').val(trade.exit_date ? new Date(trade.exit_date).toISOString().slice(0, 16) : '');
        $('#editNotes').val(trade.notes);
        toggleClosedFields(trade.status);
        $('#editTradeModal').modal('show');
    });

    // Delete Trade Button
    $('.delete-btn').click(function() {
        const tradeId = $(this).data('trade-id');
        const tradeSymbol = $(this).data('trade-symbol');
        $('#deleteTradeSymbol').text(tradeSymbol);
        $('#confirmDeleteBtn').data('trade-id', tradeId);
        $('#deleteTradeModal').modal('show');
    });

    // Confirm Delete
    $('#confirmDeleteBtn').click(function() {
        const tradeId = $(this).data('trade-id');
        const deleteBtn = $(this);
        deleteBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
        $.ajax({
            url: "{{ route('admin.trade.history.destroy', '') }}/" + tradeId,
            type: 'DELETE',
            data: { _token: "{{ csrf_token() }}" },
            success: function(response) {
                toastr.success(response.message);
                $('#trade-row-' + tradeId).remove();
                $('#deleteTradeModal').modal('hide');
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Error deleting trade');
                deleteBtn.prop('disabled', false).html('<i class="fas fa-trash me-1"></i> Delete');
            }
        });
    });

    // Edit Status Change
    $('#editStatus').change(function() {
        toggleClosedFields($(this).val());
    });

    function toggleClosedFields(status) {
        const showFields = status === 'closed';
        $('#editExitDateField, #editExitPriceField').toggle(showFields);
        if (showFields) {
            const now = new Date();
            const timezoneOffset = now.getTimezoneOffset() * 60000;
            const localISOTime = new Date(now - timezoneOffset).toISOString().slice(0, 16);
            if (!$('#editExitDate').val()) { $('#editExitDate').val(localISOTime); }
        }
    }

    // Edit form submission
    $('#editTradeForm').on('submit', function(e) {
        e.preventDefault();
        $('.text-danger').text('');
        $('#updateTradeBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');
        const tradeId = $('#editTradeId').val();
        let formData = new FormData(this);
        $.ajax({
            url: "{{ route('admin.trade.history.update', '') }}/" + tradeId,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message);
                $('.modal').modal('hide');
                setTimeout(() => { window.location.reload(); }, 1500);
            },
            error: function(xhr) {
                $('#updateTradeBtn').prop('disabled', false).html('<i class="fas fa-save me-1"></i> Update Trade');
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) { $(`#edit-${key}-error`).text(value[0]); });
                    toastr.error('Please fix the form errors');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });
});
</script>