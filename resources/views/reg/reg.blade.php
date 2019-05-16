<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>111111111</h3>
    <input type="submit" id="qq">
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    
    <script>
        $('#qq').click(function(){
            $.ajax({
                url:'http://www.lument.com/Reg',
                dataType:'JSONP',
            })
        })
    </script>
</body>
</html>