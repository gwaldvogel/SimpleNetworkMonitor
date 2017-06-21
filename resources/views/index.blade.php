<!DOCTYPE html>
<html lang="en">
<head>
    <title>Network Monitor</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body class="nav-md @stack('bodyClasses')">
    <div class="row" style="margin: 15px 0px">
        <div class="col-md-12" id="statusPanel">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-bottom: 20px;">
                <a href="https://github.com/gwaldvogel/SimpleNetworkMonitor">Powered by SimpleNetworkMonitor</a>
        </div>
    </div>
    <script src="{{ url('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script>
        function updateFromApi() {
            $.get('{{ url('/api/status') }}', function(data) {
                $('#statusPanel').html('');
                for(i = 0; i < data.length; ++i)
                {
                    $('#statusPanel').html($('#statusPanel').html()
                        + '<div class="col-md-4"><div class="alert '
                        + (data[i].status ? 'alert-success' : 'alert-danger')
                        + '" role="alert" style="text-overflow: ellipsis; overflow: hidden;">'
                        + '<h4 style="text-overflow: ellipsis; white-space:nowrap; margin-bottom: 0;">'
                        + data[i].ip + ':' + data[i].port + '</h4>'
                        + '<br><i>' + data[i].name + '</i>'
                        + '<br>Status since: ' + new Date(data[i].time).toLocaleString()
                        + '<br>' + data[i].error
                        + '</div></div>');
                }
                console.log('Reloaded at ' + new Date().toLocaleString());
            });
            setTimeout(updateFromApi, 1000);
        }
        $(document).ready(function() {
            updateFromApi();
        });
    </script>
</body>
</html>