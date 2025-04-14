<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>edit product</h1>
    <div>
        @if($errors -> any())
        <ul>
            @foreach($errors->all() as $error)            
                <li>{{ $error }}</li>            
            @endforeach
        </ul>
        @endif
    </div>
    <form method = "post" action="{{route('products.store', $products->id)}}"> 
        @csrf
        @method('PUT')
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" value="{{ $products->name }}">
        </div>       
        <div>
            <label>Description</label>
            <input type="text" name="description" placeholder="Description" value="{{ $products->description }}">
        </div>
        <div>
            <label>Price</label>
            <input type="text" name="price" placeholder="Price" value="{{ $products->price }}">
        </div>
        <div>
            <label>Stock</label>
            <input type="text" name="stock" placeholder="Stock" value="{{ $products->stock }}">
        </div>
        <div>
            <input type="submit" value="Update Product">
        </div>      
    </form>
</body>
</html>