<!-- resources/views/livewire/stock-transfer.blade.php -->

<div>
    <div class="form-group">
        <label for="measure">Weight:</label>
        <input wire:model="measure" class="form-control" placeholder="Weight">
    </div>

    <div class="form-group">
        <label for="tot_no_of_items">Number of Items:</label>
        <input wire:model="totNoOfItems" class="form-control" placeholder="Number of Items">
    </div>

    <div class="form-group">
        <label for="total_amount">Total Amount:</label>
        <input type="number" value="{{ $totalAmount }}" readonly>
    </div>
</div>
