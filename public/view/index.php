<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title><?php echo $title; ?></title>
</head>

<body>
    <div class="container">
        <?php if (isset($_SESSION['errors'])):?>
            <?php foreach($_SESSION['errors'] as $key=>$data):?>
                <?php foreach($_SESSION['errors'][$key] as $val):?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $val; ?>
                    </div>
                <?php endforeach;?>
            <?php endforeach;?>
        <?php endif;?>
        <?php if (isset($_SESSION['success'])):?>
            <?php foreach($_SESSION['success'] as $val):?>
                <div class="alert alert-success" role="alert">
                    <?php echo $val; ?>
                </div>
            <?php endforeach;?>
        <?php endif;?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-5"><i>Send Happy New Year Greetings</i></h1>
                <hr>
                <form method="POST" action="/send">
                    <div class="data-block-parent">
                        <div class="row data-block mt-1 mb-2">
                            <div class="col">
                                <input type="emai" class="form-control" placeholder="emai" name='email[]'>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="name" name='name[]'>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" id="add-email">Add field</button>
                        <button type="submit" class="btn btn-success" id="add-email">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#add-email').on('click', function() {
                $("form .data-block:first-child").clone().appendTo(".data-block-parent");
            });
        })
    </script>
</body>

</html>