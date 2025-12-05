<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/dashboardStyle.css">
    <title>Add/Edit Products</title>
</head>

<body class="content">
    <main>
        <div class="page container" id="addEditProduct">
            <h2 class="my-4">Add /Edit Product</h2>
            <div class="mx-5 m-auto rounded-3 bg-bage py-3 px-3 shadow">
                <form action="#">
                    <div class="row mb-3">
                        <div class=" col">
                            <label for="pName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="pName" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class=" col">
                            <label for="pDisc" class="form-label">Discription</label>
                            <textarea name="" id="pDisc" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class=" col-3">
                            <label for="pPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="pPrice" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class=" col-4">
                            <label for="pImg" class="form-label">Price</label>
                            <input type="file" class="form-control" id="pImg" required>
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-1 rounded bg-green text-white mb-3">Save</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>