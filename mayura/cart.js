if(document.readyState == 'loading'){
    document.addEventListener('DOMContentLoaded',ready)
}else{
    ready()
}
function ready(){
    //remove button
    var removeCartItemButtons = document.getElementsByClassName('btn-remove')
    for(var i=0;i<removeCartItemButtons.length;i++){
        var button = removeCartItemButtons[i]
        button.addEventListener('click',removeCartItem)
    }
    
    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for(var i=0;i<quantityInputs.length;i++){
        var input = quantityInputs[i]
        input.addEventListener('change',quantityChanged)
    }

    var addToCartButtons = document.getElementsByClassName('btn-add')
    for(var i=0;i<addToCartButtons.length;i++){
        var button = addToCartButtons[i]
        button.addEventListener('click',addToCart)
        
    }

    document.getElementsByClassName('btn-purchase')[0].addEventListener('click',purchaseClicked)
    document.getElementsByClassName('btn-remove-all')[0].addEventListener('click',removeAllClicked)
}

function removeAllClicked(){
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while(cartItems.hasChildNodes){
        cartItems.removeChild(cartItems.firstChild)
        updateCartSubTotal()
    }
    
}

function purchaseClicked(){
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while(cartItems.hasChildNodes){
        cartItems.removeChild(cartItems.firstChild)
        updateCartSubTotal()
    }
    
    
}

function updateCartSubTotal(){
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var total =0
    for(var i=0;i<cartRows.length;i++){
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('$',''))
        var quantity = quantityElement.value
        total =total +( price * quantity)
    }
    total = Math.round(total*100)/100
    document.getElementsByClassName('cart-sub-total-price')[0].innerText ='$'+ total
    updateCartTax(total);
}

function updateCartTax(subtotal){
    var tax = subtotal * (10/100)
    document.getElementsByClassName('cart-tax-price')[0].innerText ='$'+ tax
    updateCartTotal(tax,subtotal)
}

function updateCartTotal(tax,subtotal){
    var total = tax + subtotal
    document.getElementsByClassName('cart-total-price')[0].innerText ='$'+ total
}

function removeCartItem(event){
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove();
    updateCartSubTotal()
}

function quantityChanged(event){
    var input = event.target
    if(isNaN(input.value) || input.value<=0){
        input.value = 1
    }
    updateCartSubTotal()
}

function addToCart(event){
    var button = event.target
    var shopItem = button.parentElement
    var title = shopItem.getElementsByClassName('shop-item')[0].innerText
    var price = shopItem.getElementsByClassName('price')[0].innerText
    var imageSrc = shopItem.getElementsByClassName('machine-img')[0].src
    addItemToCart(title,price,imageSrc)
    updateCartSubTotal()
}

function addItemToCart(title,price,imageSrc){
    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    cartRow.innerText = title
    var cartItems = document.getElementsByClassName('cart-items')[0]
    var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
    for(var i=0;i<cartItemNames.length;i++){
        if(cartItemNames[i].innerHTML==title)
        {
            alert('item already added')
            return
        }  
    }
    var cartRowContents = `
        <div class="cart-item cart-column">
            <img class="cart-item-image" src="${imageSrc}" width="100" height="100">
            <span class="cart-item-title">${title}</span>
        </div>
        <span class="cart-price cart-column">${price}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="1">
            <button class="btn btn-remove" type="button">REMOVE</button>
        </div>
        `
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    cartRow.getElementsByClassName('btn-remove')[0].addEventListener('click',removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change',quantityChanged)
}
