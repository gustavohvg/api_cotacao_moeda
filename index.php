<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- icons  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>

    <title>API Cotação de moeda</title>
</head>
<body class="py-5 container">
<h3>API Cotação de moeda</h3>

<div class="d-flex flex-row flex-wrap" style="gap: 10px">
    <label class="form-group flex-grow-1">
        <span>De</span>
        <select class="custom-select" id="coin-from-option" onchange="getCotationCoin()">
            <option value="BTC">Bitcoin</option>
            <option value="USD" selected>Dólar Americano</option>
            <option value="EUR">Euro</option>
            <option value="BRL">Real Brasileiro</option>
        </select>
    </label>
    <label class="form-group flex-grow-1">
        <span>Para</span>
        <select class="custom-select" id="coin-to-option" onchange="getCotationCoin()">
            <option value="BTC">Bitcoin</option>
            <option value="USD">Dólar Americano</option>
            <option value="EUR">Euro</option>
            <option value="BRL" selected>Real Brasileiro</option>
        </select>
    </label>
</div>

<label class="form-group">
    <input class="form-control" type="number" disabled id="value-cotation">
</label>

<p id="create_date"></p>

<button type="button" class="btn btn-sm btn-primary" onclick="getCotationCoin()">
    atualizar
</button>

<script type="text/javascript">
    function getCotationCoin(fromCoin = $("#coin-from-option").val(), toCoin = $("#coin-to-option").val()) {
        if (fromCoin === toCoin){
            $("#value-cotation").val('');
            alert("moeda não encontrada "+fromCoin+"-"+toCoin);
        }
        $.ajax({
            url: "https://economia.awesomeapi.com.br/json/last/"+fromCoin+"-"+toCoin,
            method: "GET",
            success: function (data) {
                if (data.message){
                    $("#value-cotation").val('');
                    alert(data.message);
                } else {
                    var keyFromTo = fromCoin+toCoin;
                    $("#value-cotation").val(data[keyFromTo]["bid"]);
                    $("#create_date").html('atualizado em: <b>'+data[keyFromTo]["create_date"])+'</b>';
                }
            }
        });
    }
    getCotationCoin();
</script>
</body>
</html>