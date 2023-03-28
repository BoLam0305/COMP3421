const modifyOrder = async (e, action, productID) => {
    const targetRow = e.target.closest('.shoppingCartRows');
    let itemQty = targetRow.querySelector('#itemQty');
    const itemPrice = targetRow.querySelector('#cartItemPrice');
    const itemTotal = targetRow.querySelector('#cartItemTotalPrice');
    const orderTotal = document.querySelector('#totalPrice');

    console.log(targetRow);
    console.log(itemQty);
    console.log(itemPrice);
    console.log(itemTotal);
    console.log(orderTotal);

    if (action === 'increase') {
        itemQty.innerText = parseInt(itemQty.innerText) + 1;
        itemTotal.innerText = parseInt(itemQty.innerText) * parseInt(itemPrice.innerText);
        orderTotal.innerText = parseInt(orderTotal.innerText) + parseInt(itemPrice.innerText);
    }

    if (action === 'decrease') {
        if (parseInt(itemQty.innerText) === 1) {
            const confirmationResults = await fireConfirm();
            if (confirmationResults) { targetRow.remove(); }
        } else {
            itemQty.innerText = parseInt(itemQty.innerText) - 1;
            itemTotal.innerText = parseInt(itemQty.innerText) * parseInt(itemPrice.innerText);
        }
        orderTotal.innerText = parseInt(orderTotal.innerText) - parseInt(itemPrice.innerText);
    }

    if (action === 'remove') {
        const confirmationResults = await fireConfirm();
        if (confirmationResults) { targetRow.remove(); }
        orderTotal.innerText = parseInt(orderTotal.innerText) - parseInt(itemPrice.innerText);
    }
}

const fireConfirm = async () => {
    const result = await Swal.fire({
        title: 'Confirmation required',
        text: 'Please confirm if you want to remove this item from your cart',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
    });
    return result.isConfirmed;
};

const queryResults = async (query) => {

}
