<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>DoubleMorgan:Bank Statement</title>
</head>

<div class="container">
    @include('components.alert')
</div>

<body>
    <div class="container mt-5">
        <h1>Bank Statement</h1>
        <form action="/create-transaction" method="POST">
            @csrf
            <div class="row">

                <!-- <input type="text" name="amount"> -->

                <div class="form-group col">
                    <label for="transactionType">Transaction Type:</label>
                    <select class="form-control" id="transactionType" name="transactionType">
                        <option value="debit">Debit</option>
                        <option value="credit">Credit</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="amount">Amount:</label>
                    <input type="text" class="form-control" name="amount">
                </div>
            </div>
            <button class="btn btn-primary" id="submitBtn">Submit</button>
            <a class="btn btn-success" href="{{ route('transactions.pdf') }}" target="_blank">Generate PDF</a>

        </form>
        <hr>
        <h4>Total Balance : <span id="balance">{{number_format($balanceAmount,2)}}</span></h4>
        <h4>Transaction History:</h4>

        <table class="table">
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Amount</th>
            </tr>
            @foreach($transactions as $transaction)

            <tr>
                <td>{{ $transaction->created_at }}</td>
                @if($transaction->type=="debit")
                <td class="text-danger">{{ $transaction->type }}</td>
                @else
                <td class="text-success">{{ $transaction->type }}</td>
                @endif
                <td>{{ $transaction->amount }}</td>
            </tr>
            @endforeach
        </table>

        <!-- <ul id="transactionList" class="list-group">
            @foreach($transactions as $transaction)
            @if($transaction->type=="debit")
            <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
                <strong>Debit : AED {{ $transaction->amount }}</strong>
            </div>
            @else
            <div class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show" role="alert">
                <strong>Credit : AED {{ $transaction->amount }}</strong>
            </div>
            @endif
            @endforeach
        </ul> -->
    </div>
    <!-- <script src="js/script.js"></script> -->
</body>
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const transactionType = document.getElementById("transactionType");
        const amount = document.getElementById("amount");
        const submitBtn = document.getElementById("submitBtn");
        const transactionList = document.getElementById("transactionList");
        const balanceSpan = document.getElementById("balance");

        let balance = 0;

        submitBtn.addEventListener("click", function() {
            const type = transactionType.value;
            const transactionAmount = parseFloat(amount.value);

            if (isNaN(transactionAmount)) {
                alert("Please enter a valid amount.");
                return;
            }

            if (0 >= transactionAmount) {
                alert("Transaction must be greater than 0");
                return;
            }

            if (type === "debit") {
                balance -= transactionAmount;
            } else if (type === "credit") {
                balance += transactionAmount;
            }

            balanceSpan.textContent = balance.toFixed(2);

            const listItem = document.createElement("li");
            listItem.className = `list-group-item ${type === "debit" ? "list-group-item-danger" : "list-group-item-success"}`;
            listItem.textContent = `${type.toUpperCase()}: AED ${transactionAmount.toFixed(2)}`;
            transactionList.appendChild(listItem);

            amount.value = "";
        });

    });
</script> -->

</html>