<div class="form-group col-md-12">
    <label class="text-light">Name</label>
    <input type="text" class="form-control bg-dark text-light" name="name"
        value="{{ old('name', $payment->name ?? '') }}" required>
</div>
<div class="form-group col-md-6">
    <label class="text-light">Minimum Amount</label>
    <input type="number" class="form-control bg-dark text-light" name="min_amount"
        value="{{ old('min_amount', $payment->min_amount ?? '') }}" required>
</div>
<div class="form-group col-md-6">
    <label class="text-light">Maximum Amount</label>
    <input type="number" class="form-control bg-dark text-light" name="max_amount"
        value="{{ old('max_amount', $payment->max_amount ?? '') }}" required>
</div>
<div class="form-group col-md-6">
    <label class="text-light">Charges</label>
    <input type="number" class="form-control bg-dark text-light" name="charges"
        value="{{ old('charges', $payment->charges ?? '') }}" required>
</div>
<div class="form-group col-md-6">
    <label class="text-light">Charges Type</label>
    <select name="charge_type" class="form-control bg-dark text-light">
        <option value="percentage" {{ (old('charge_type', $payment->charge_type ?? '') == 'percentage') ? 'selected' :
            '' }}>Percentage(%)</option>
        <option value="fixed" {{ (old('charge_type', $payment->charge_type ?? '') == 'fixed') ? 'selected' : ''
            }}>Fixed($)</option>
    </select>
</div>
<div class="form-group col-md-6">
    <label class="text-light">Type</label>
    <select name="type" class="form-control bg-dark text-light" required>
        <option value="currency" {{ (old('type', $payment->type ?? '') == 'currency') ? 'selected' : '' }}>Currency
        </option>
        <option value="crypto" {{ (old('type', $payment->type ?? '') == 'crypto') ? 'selected' : '' }}>Crypto</option>
    </select>
</div>
<div class="form-group col-md-6">
    <label class="text-light">Status</label>
    <select name="status" class="form-control bg-dark text-light" required>
        <option value="enabled" {{ (old('status', $payment->status ?? '') == 'enabled') ? 'selected' : '' }}>Enabled
        </option>
        <option value="disabled" {{ (old('status', $payment->status ?? '') == 'disabled') ? 'selected' : '' }}>Disabled
        </option>
    </select>
</div>
<div class="form-group col-md-6">
    <label class="text-light">Type for</label>
    <select name="type_for" class="form-control bg-dark text-light" required>
        <option value="withdrawal" {{ (old('type_for', $payment->type_for ?? '') == 'withdrawal') ? 'selected' : ''
            }}>Withdrawal</option>
        <option value="deposit" {{ (old('type_for', $payment->type_for ?? '') == 'deposit') ? 'selected' : '' }}>Deposit
        </option>
        <option value="both" {{ (old('type_for', $payment->type_for ?? '') == 'both') ? 'selected' : '' }}>Both</option>
    </select>
</div>
<div class="form-group col-md-12">
    <label class="text-light">Optional Note</label>
    <input type="text" class="form-control bg-dark text-light" name="note"
        value="{{ old('note', $payment->note ?? '') }}">
</div>