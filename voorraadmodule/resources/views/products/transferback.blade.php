<!-- transfer.blade.php -->
<form action="{{ route('product.validate') }}" method="POST">
    @csrf
    <input type="hidden" name="owner" value="{{ $owner }}">
    <input type="hidden" name="product" value="{{ $product }}">


    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" min="1" max="{{ $quantity }}">

    <!-- Input fields for warehouse selection -->
    <label for="warehouse">Choose a Warehouse:</label>
    <select name="warehouse" id="warehouse">
        @foreach($warehouses as $warehouse)
            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
        @endforeach
    </select>



    <button type="submit">Transfer</button>
</form>

<script>
    document.getElementById('quantity').addEventListener('input', function () {
        var maxQuantity = {{ $quantity }};
        if (parseInt(this.value) > maxQuantity) {
            this.value = maxQuantity;
        }
    });
</script>