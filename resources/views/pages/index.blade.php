<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trogon</title>
    <style>
        #item-list {
            list-style-type: none;
            padding: 0;
        }

        #item-list li {
            padding: 8px;
            margin: 4px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <h1>Items</h1>
    <ul id="item-list"></ul>
    <p id="error-message" style="color: red; display: none;">Failed to load items. Please try again later.</p>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/get-products',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        console.log(response.data.products);
                        var items = response.data.products;
                        var itemList = $('#item-list');
                        itemList.empty();
                        $.each(items, function(index, item) {
                            var listItem = $('<li></li>').text(item.name);
                            itemList.append(listItem);
                        });
                    } else {
                        $('#error-message').text('Error: ' + response.message).show();
                    }
                },
                error: function(xhr, status, error) {
                    $('#error-message').text('Failed to load items. Please try again later.').show();
                }
            });
        });
    </script>
</body>

</html>
