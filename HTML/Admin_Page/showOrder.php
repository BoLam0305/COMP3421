<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Management</title>

    <!--local CSS-->
    <link href="../../CSS/Admin_Page/left-menu.css" rel="stylesheet">
    <link href="../../CSS/Admin_Page/right-management.css" rel="stylesheet">
    <link href="../../CSS/Admin_Page/add_modam.css" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <!--Bosstrap-->
    <script src="https://kit.fontawesome.com/ceae024db6.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--local Js-->
    <script src="../../JS/Admin_Page/showOrder.js"></script>
    <script src="../../JS/Admin_Page/completeOrder.js"></script>

    <script>
        function completeOrder(order) {
            var form_data = new FormData();
            form_data.append('orderID', order.value);
            form_data.append('status', 'Complete');
            fetch('../../phpFunctions/completeOrder.php', {
                method: 'POST',
                body: form_data
            }).then(response => response.text()).then(async (response) => {
                console.log(response);
            });
            order.parentNode.parentNode.parentElement.remove();
        }
        $(document).ready(function() {
            var interval;
            $("#loopcheck").click(function() {
                if ($('#loopcheck').is(":checked")) {
                    interval = setInterval(loadOrders, 5000);
                    console.log(interval);
                } else {
                    window.clearInterval(interval);
                    console.log(interval);
                }
            });
        });
        // setInterval(loadOrders, 5000);
    </script>


    <!--Bosstrap-->
    <script src="https://kit.fontawesome.com/ceae024db6.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <?php include_once '../header.php'; ?>
    <?php
    extract($_SESSION);
    if (isset($email)) {
        if ($Identity != 'admin') {
            header('Location: ../User_Page/login.php');
        }
    } else {
        header('Location: ../User_Page/login.php');
    }

    ?>
</head>

<body>
    <div id="main-container" class="row" style="margin: 5% !important;">
        <div class="col-12 d-flex justify-content-center"><input type="checkbox" id="loopcheck">In Real Time</div>
        <div id="right-content" class="col-12">
            <div class="row orders">

            </div>
        </div>
    </div>

</body>

</html>