<p>Total Balance: {{ $balance }}</p>
<h2>Transaction History</h2>
<table style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 40;">Date</th>
            <th style="width: 30;">Type</th>
            <th style="width: 30;">Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td style="width: 40;">{{ $transaction->created_at }}</td>
            <td style="width: 40;">{{ $transaction->type }}</td>
            <td style="width: 40;">{{ $transaction->amount }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
