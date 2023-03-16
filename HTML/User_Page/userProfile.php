<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="../CSS/index.css"> -->
    <link rel="stylesheet" href="../CSS/userProfile.css">
    <?php include_once 'header.php'; ?>
</head>

<body>
    <div class="content">
        <section style="background-color: #eee;">
            <div class="container py-5">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 100%;">
                                <h5 class="my-3">John Smith</h5>
                                <p class="text-muted mb-1">Full Stack Developer</p>
                                <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form action="" class="form_control">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-center">Your Information</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">Full Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0" type="text" name="1">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">Email</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0" type="text" name="2">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">Phone</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0" type="text" name="3">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">Mobile</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0" type="text" name="4">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">Address</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0" type="text" name="5">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" value="Submit" class="button-36" role="button">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include_once 'footer.php';
        ?>
    </div>
</body>

</html>