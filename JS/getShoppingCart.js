window.addEventListener('load', async () => {
    await fetch('../../phpFunctions/getShoppingCart.php', {
        method: 'GET',
    }).then(response => response.text()).then(async (response) => {
        console.log(response);
        let shoppingCart = JSON.parse(response);
        let spinner = document.getElementById('loadingWrapper');
        let cartContainer = document.getElementById('cartContainer');
        let tableRowContainer = document.getElementById('tableRowContainer');
        let shoppingCartRow = document.getElementById('shoppingCartRows');
        let totalCartPrice = document.getElementById('totalPrice');
        let rowClone = shoppingCartRow.cloneNode(true);
        let itemName, itemPrice, itemQuantity, itemID, itemTotalPrice, orderTotal = 0;

        // If shopping cart is empty, fire error
        if (shoppingCart.error === "No items in cart") {
            await fireError();
            return;
        }

        for (let i = 0; i < shoppingCart.length; i++) {
            if (i > 0) {
                let j = i - 1;
                shoppingCartRow = document.getElementById(`shoppingCartRows${j}`);
                rowClone = shoppingCartRow.cloneNode(true);
            }

            itemName = shoppingCart[i].productName;
            itemPrice = shoppingCart[i].price;
            itemTotalPrice = shoppingCart[i].totalPrice;
            itemQuantity = shoppingCart[i].quantity;
            itemID = shoppingCart[i].productID;

            rowClone.querySelector('#cartItemID').innerText = itemID
            rowClone.querySelector('#cartItemName').innerText = itemName;
            rowClone.querySelector('#cartItemTotalPrice').innerText = itemTotalPrice;
            rowClone.querySelector('#cartItemPrice').innerText = itemPrice;
            rowClone.querySelector('#itemQty').innerText = itemQuantity;

            rowClone.querySelector('#increaseItem')
                .setAttribute('onclick', `modifyOrder(event, 'increase', ${itemID})`);
            rowClone.querySelector('#decreaseItem')
                .setAttribute('onclick', `modifyOrder(event, 'decrease', ${itemID})`);
            rowClone.querySelector('#cartRemoveItem')
                .setAttribute('onclick', `modifyOrder(event, 'remove', ${itemID})`);

            rowClone.setAttribute('id', `shoppingCartRows${i}`);
            rowClone.setAttribute('class', 'shoppingCartRows');
            rowClone.setAttribute('style', 'display: table-row');

            orderTotal += itemTotalPrice;
            tableRowContainer.appendChild(rowClone);
        }
        totalCartPrice.innerText = orderTotal;

        spinner.remove();
        cartContainer.setAttribute('style', 'display: block');

        console.log(shoppingCart);
    }).catch((error) => { console.log(error) });
});

const fireError = async (message) => {
    await Swal.fire({
        title: 'Error',
        html: `Your shopping cart is empty. <br><br> Please add items to your cart before checking out.`,
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Return to Home Page',
        allowOutsideClick: false,
        allowEscapeKey: false,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../home.php';
        }
    });
}
