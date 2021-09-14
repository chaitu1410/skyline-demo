function addItemToCart(id, userId) {
    var cart = localStorage.getItem("cart");
    if (cart) {
        var obj = JSON.parse(cart);
    }
    else {
        var obj = [
            {
                "userId": userId,
                "items": [id]
            }
        ];

    }
}

function updateItemInCart(id, quantity) {

}

function getItemsFromCart(userId) {

}

function getItemCount(userId) {

}