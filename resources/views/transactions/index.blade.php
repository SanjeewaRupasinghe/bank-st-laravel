<!DOCTYPE html>
<html>
<head>
    <title>Transaction History</title>
    <!-- Include your CSS and Bootstrap links here -->
</head>
<body>
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
    <a href="{{ route('transactions.pdf') }}" target="_blank">Generate PDF</a>
</body>
</html>
