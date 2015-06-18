
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prueba Fedegolf</title>
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript">
    $(function(){
        $("#btnTest").bind('click',function(){
            $.ajax({
                    url: 'http://190.60.227.26/fedegolf/WebService.asmx/getIndiceXJugador',
                    type: 'POST',
                    data: "{nombres:'felipe', apellidos:'', codJugador:'', codClub:'', limit:20, offset:0, cedula:''}",
                    async: true,
                    headers: {"key":"f3D3g01f"},
                    contentType: "application/json",
                    dataType: 'json',
                    success: function (data) {
                        console.info(data)
                        response = $.parseJSON(data.d);
                        $("#response").html(response);
                    }
                });
            });

        $("#getScoreByJugador").bind('click',function(){
            $.ajax({
                url: 'http://54.149.89.5:49187/WebService.asmx/getScoreByJugador',
                //url: 'http://190.60.227.26/fedegolf/WebService.asmx/getScoreByJugador',
                type: 'POST',
                data: "{codJugador:'83'}",
                async: true,
                headers: {"key":"f3D3g01f"},
                contentType: "application/json",
                dataType: 'json',
                success: function (data) {
                    response = $.parseJSON(data.d);
                    console.log(response);
                    $("#response").html(response);
                }
            });
        });

    });
    </script>
</head>
<body>
    <button id="btnTest">Probar Servicio</button>
    <button id="getScoreByJugador">getScoreByJugador</button>
    <div id="response"></div>
</body>
</html>