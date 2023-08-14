<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" type="image/png" href=".././assets/img/favicon-32x32.png">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link href="./assets/styles/home.css" rel="stylesheet">

</head>
<body>

<div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="counter">
                        <div class="counter-icon">
                            <i class="fa fa-globe"></i>
                        </div>
                        <h3>Teletrabajo</h3>
                        <span class="counter-value">1963</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter pink">
                        <div class="counter-icon">
                            <i class="fa fa-rocket"></i>
                        </div>
                        <h3>Permiso especial Ley TEA</h3>
                        <span class="counter-value">1854</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter orange">
                        <div class="counter-icon">
                            <i class="fa fa-briefcase"></i>
                        </div>
                        <h3>Brand Building</h3>
                        <span class="counter-value">1756</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter purple">
                        <div class="counter-icon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <h3>Responsive Design</h3>
                        <span class="counter-value">1823</span>
                    </div>
                </div>
            </div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
 <script>
    $(document).ready(function(){
    $('.counter-value').each(function(){
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        },{
            duration: 3500,
            easing: 'swing',
            step: function (now){
                $(this).text(Math.ceil(now));
            }
        });
    });
});
 </script>
</body>
</html>