<?php


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Create
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="create" method="post">
                    <input type="text" name="number">
                    <input type="text" name="prefix">
                    <input type="text" name="name">
                    <select name="select"> <!--Supplement an id here instead of using 'name'-->
                        <option value="value1">Значение 1</option>
                        <option value="value2" selected>Значение 2</option>
                        <option value="value3">Значение 3</option>
                    </select>
                    <button type="submit">send</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Number</th>
        <th scope="col">Country</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($phones as $phone): ?>
        <tr>
            <th scope="row">1</th>
            <td><?php echo $phone['number'] ?></td>
            <td><?php echo $phone['name'] ?></td>
            <input type="hidden" name="id" id="<?php echo $phone['id'] ?>" value="<?php echo $phone['id'] ?>">
            <td><a href="site/delete/<?php echo $phone['id'] ?>">Delete</a>
                <button type="button" class="btn btn-primary updateModal" data-toggle="modal" value="<?php echo $phone['id'] ?>"  data-target="#updateModal">
                    Update
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>




<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="site/update/" method="post" class="update_form">
                    <input type="text" name="number">
                    <input type="text" name="id">
                    <input type="text" name="prefix">
                    <input type="text" name="name">
                    <select name="select"> <!--Supplement an id here instead of using 'name'-->
                        <option value="value1">Значение 1</option>
                        <option value="value2" selected>Значение 2</option>
                        <option value="value3">Значение 3</option>
                    </select>
                    <button type="submit">send</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<form class="form-inline">
    <div class="form-group mb-2">
        <label for="staticEmail2" class="sr-only">Email</label>
        <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="inputPassword2" class="sr-only">search</label>
        <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
</form>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

<script>

    // $('#ok').on('click', function (){
    //     alert(2)
    // })

$('.updateModal').on('click',function (){
    let id = $(this).attr('value')
    $('.update_form').attr('action', 'site/update/' + id)
    console.log(id)
})
</script>
</body>
</html>

