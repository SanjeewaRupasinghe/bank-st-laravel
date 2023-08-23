<h2>Transaction History</h2>
<table>
    <thead>
        <tr>
            <th>Type</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->type }}</td>
            <td>{{ $transaction->amount }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p>Total Balance: {{ $balance }}</p>
