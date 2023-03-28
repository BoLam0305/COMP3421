const modifyOrder = async (e, action, productID) => {
    let itemQty = e.target.parentElement.parentElement.querySelector('#itemQty');
    const targetRow = e.target.closest('.shoppingCartRows');

    if (action === 'increase') {
        itemQty.innerText = parseInt(itemQty.innerText) + 1;
    }

    if (action === 'decrease') {
        if (parseInt(itemQty.innerText) === 1) {
            const confirmationResults = await fireConfirm();

            if (confirmationResults) { targetRow.remove(); }
        } else {
            itemQty.innerText = parseInt(itemQty.innerText) - 1;
        }
    }

    if (action === 'remove') {
        const confirmationResults = await fireConfirm();

        if (confirmationResults) { targetRow.remove(); }
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
