<table class="table">
    <thead>
        <tr>
            <th>S/N</th>
            <th>ITEM DESCRIPTION</th>
            <th>AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        @foreach($breakdown as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <!-- Formats it properly with Nigerian Naira currency styling -->
                <td>₦{{ number_format($item['amount'], 2) }}</td>
            </tr>
        @endforeach
        <tr class="font-bold">
            <td colspan="2">CUMULATIVE TOTAL:</td>
            <td>₦{{ number_format($totalFee, 2) }}</td>
        </tr>
    </tbody>
</table>