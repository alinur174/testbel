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
<div class="d-flex justify-content-center my-5">
    <button type="button" class="btn btn-primary" data-toggle="modal" style="width: 200px;height: 38px"
            data-target="#exampleModal">
        Create
    </button>
    <form class="form-inline" action="site/search" method="post">
        <div class="form-group mx-sm-3 mb-2">
            <label for="inputPassword2" class="sr-only">search</label>
            <input type="text" class="form-control" id="input_search" placeholder="Name">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
    </form>
</div>

<?php
if ($_SESSION['error']):
    ?>
    <div class="container">
        <div class="mb-4">
            <span>such number already exists</span>
        </div>
    </div>
<?php endif; ?>
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
                <form action="create" method="post" id="create">
                    <input type="text" placeholder="number" class="number" name="number">
                    <input type="text" name="name" placeholder="name">
                    <select name="prefix"> <!--Supplement an id here instead of using 'name'-->
                        <?php foreach ($this->prefixList as $value): ?>
                            <option value="<?php echo $value ?>">+ <?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Number</th>
            <th scope="col">Name</th>
            <th scope="col">Prefix</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0, $size = count($phones); $i < $size; $i++): ?>
            <?php ?>
            <tr>
                <td><?php echo $phones[$i]['number'] ?></td>
                <td><?php echo $phones[$i]['name'] ?></td>
                <td><?php echo $phones[$i]['prefix'] ?></td>
                <input type="hidden" name="id" id="<?php echo $phone['id'] ?>" value="<?php echo $phone['id'] ?>">
                <td><a class="btn btn-dark" href="site/delete/<?php echo $phones[$i]['id'] ?>">Delete</a>
                    <button type="button" class="btn btn-primary updateModal" data-toggle="modal"
                            value="<?php echo $phones[$i]['id'] ?>" data-target="#updateModal">
                        Update
                    </button>
                </td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</div>

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
                <form action="site/update/" method="post" id="update" class="update_form">
                    <input type="text" placeholder="number" name="number">
                    <input type="text" name="name" placeholder="name">
                    <select name="prefix" class="select_prefix"> <!--Supplement an id here instead of using 'name'-->
                        <?php foreach ($this->prefixList as $value): ?>
                            <option value="<?php echo $value ?>">+ <?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div id="test"></div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

<script>

    $('#input_search').on('keyup', function () {
        let tableClone = $('table tbody').clone()
        let name = $('#input_search').val()
        $.ajax({
            url: 'site/search',
            type: 'POST',
            data: {'name': name}
        }).done(function (d) {
            if (!isEmpty(d)) {
                let data = JSON.parse(d)
                console.log(data)
                $('table tbody').html(`<td>${data[0].number}</td><td>${data[0].name}</td><td>${data[0].prefix}</td>`)
            }else{
                console.log(2)
                console.log(tableClone.clone())
                $('table tbody').replaceWith(tableClone.clone())
            }
        })
    })


    $('.updateModal').on('click', function () {
        let id = $(this).attr('value')
        $('.update_form').attr('action', 'site/update/' + id)

    })


    $('form#update').on('submit', (e) => {
        let name = $("form#update input[name='name']").val();
        let number = $("form#update input[name='number']").val();
        if (name == '' || number == '') {
            e.preventDefault()
            alert('fill in the fields')
        }
    })

    $('form#create').on('submit', (e) => {
        let name = $("form#create input[name='name']").val();
        let number = $("form#create input[name='number']").val();
        if (name == '' || number == '') {
            e.preventDefault()
            alert('fill in the fields')
        }
    })
    function isEmpty(strIn)
    {
        if (strIn === undefined)
        {
            return true;
        }
        else if(strIn == null)
        {
            return true;
        }
        else if(strIn == "")
        {
            return true;
        }else if(strIn == "[]")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

</script>
<style>
    .select_prefix {
        width: 178px;
    }


</style>
</body>
</html>

