<form method="post" action="{{ route('stocks.store') }}">
    @csrf {{-- CSRF protection --}}

    <div class="form-group">
        <label for="search">Search:</label>
        <input type="text" id="search" class="form-control" placeholder="Search items">
    </div>

    <table class="table" id="itemsTable">
        <thead>
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th>Type</th>
                <th>Requirement</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>
                        <img src="{{ asset($item->prod_pic) }}" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;">
                        {{ $item->name }}
                    </td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->type }}</td>
                    <td>
                        <input type="number" name="items_required[{{ $item->id }}]" class="form-control" placeholder="3Kg -> 3 or 5 Items ->5">
                    </td>
                    <td>
                        <input type="checkbox" name="selected_items[]" value="{{ $item->id }}">
                        <input type="hidden" name="prod_pics[{{ $item->id }}]" value="{{ $item->prod_pic }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add any additional fields you want to store in the stocks table -->
    <div class="form-group">
        <label for="additional_field">Additional Field (e.g., prod_pic):</label>
        <input type="text" name="additional_field" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Add Stock</button>
</form>

<script>
    // JavaScript for table filtering
    document.getElementById('search').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let rows = document.getElementById('itemsTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        for (let row of rows) {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        }
    });
</script>
