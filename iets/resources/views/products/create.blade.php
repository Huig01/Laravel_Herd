<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create a new product</h1>
    <div>
        @if($errors -> any())
        <ul>
            @foreach($errors->all() as $error)            
                <li>{{ $error }}</li>            
            @endforeach
        </ul>
        @endif
    </div>
    <form method = "post" action="{{ route('products.store', 0) }}"> 
        @csrf
        @method('PUT')
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Name">
        </div>       
        <div>
            <label>Description</label>
            <input type="text" name="description" placeholder="Description">
        </div>
        <div>
            <label>Price</label>
            <input type="text" name="price" placeholder="Price">
        </div>
        <div>
            <label>Stock</label>
            <input type="text" name="stock" placeholder="Stock">
        </div>
        <div>
            <input type="submit" value="Save a new Product">
        </div>      
    </form>
</body>
</html>