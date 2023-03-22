window.addEventListener('load', async () => {
    await fetch('../../phpFunctions/getShoppingCart.php', {
        method: 'GET',
    }).then(response => response.text()).then(async (response) => {
        console.log(response);
        let shoppingCart = JSON.parse(response);
        let tableRowContainer = document.getElementById('tableRowContainer');
        let shoppingCartRow = document.getElementById('shoppingCartRows');
        let totalCartPrice = document.getElementById('totalPrice');
        let rowClone = shoppingCartRow.cloneNode(true);
        let itemName, itemPrice, itemQuantity, itemTotalPrice = 0;

        for (let i = 0; i < shoppingCart.length; i++) {
            if (i > 0) {
                let j = i - 1;
                shoppingCartRow = document.getElementById(`shoppingCartRows${j}`);
                rowClone = shoppingCartRow.cloneNode(true);
            }

            itemName = shoppingCart[i].productName;
            itemPrice = shoppingCart[i].totalPrice;
            itemQuantity = shoppingCart[i].quantity;

            rowClone.querySelector('#cartItemID').innerText = i+1;
            rowClone.querySelector('#cartItemName').innerText = itemName;
            rowClone.querySelector('#cartItemPrice').innerText = itemPrice;
            rowClone.querySelector('#cartItemQuantity').innerText = itemQuantity;

            rowClone.setAttribute('id', `shoppingCartRows${i}`);
            rowClone.setAttribute('style', 'display: table-row');

            itemTotalPrice += itemPrice;
            tableRowContainer.appendChild(rowClone);
        }
        totalCartPrice.innerText = `Total: $${itemTotalPrice}`;

        console.log(shoppingCart);
    }).catch((error) => { console.log(error) });

});
