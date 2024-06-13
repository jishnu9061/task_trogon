
<!DOCTYPE html>
<html>
<head>
    <title>Discount Calculator</title>
</head>
<body>
    <h1>Calculate Discount</h1>
    <form id="discountForm">
        <label for="customerType">Customer Type:</label>
        <input type="text" id="customerType" name="customerType" required>
        <br>
        <label for="amount">Amount:</label>
        <input type="number" step="0.01" id="amount" name="amount" required>
        <br>
        <button type="submit">Calculate</button>
    </form>

    <h2>Result</h2>
    <p id="result"></p>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#discountForm').on('submit', function(event) {
            event.preventDefault();
            var customerType = $('#customerType').val();
            var amount = $('#amount').val();

            $.ajax({
                url: '/calculate-discount',
                type: 'GET',
                data: {
                    customerType: customerType,
                    amount: amount
                },
                success: function(response) {
                    $('#result').html(
                        'Original Amount: $' + response.originalAmount + '<br>' +
                        'Discounted Amount: $' + response.discountedAmount + '<br>' +
                        'You saved: $' + response.savings
                    );
                },
                error: function(xhr) {
                    $('#result').html('Error: ' + xhr.responseJSON.error);
                }
            });
        });
    </script>
</body>
</html>
