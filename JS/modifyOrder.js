const modifyOrder = async (e, action, productID) => {
    const targetRow = e.target.closest('.shoppingCartRows');
    let itemQty = targetRow.querySelector('#itemQty');
    const itemPrice = targetRow.querySelector('#cartItemPrice');
    const itemTotal = targetRow.querySelector('#cartItemTotalPrice');
    const orderTotal = document.querySelector('#totalPrice');

    let formData = new FormData();
    formData.append('productID', productID);
    formData.append('action', action);

    if (action === 'increase') {
        const response = await executeFetch(formData);
        if (response.status === true) {
            itemQty.innerText = parseInt(itemQty.innerText) + 1;
            itemTotal.innerText = parseInt(itemQty.innerText) * parseInt(itemPrice.innerText);
            orderTotal.innerText = parseInt(orderTotal.innerText) + parseInt(itemPrice.innerText);
        } else { return; }
    }

    if (action === 'decrease') {
        if (parseInt(itemQty.innerText) === 1) {
            const confirmationResults = await fireAlert(
                'Confirmation required',
                'Please confirm if you want to remove this item from your cart',
                'warning',
                "Confirm",
                true
            );
            if (confirmationResults) {
                const response = await executeFetch(formData);
                if (response === true) {
                    targetRow.remove();
                    orderTotal.innerText = parseInt(orderTotal.innerText) - parseInt(itemPrice.innerText);
                }
            } else { return; }
        } else {
            const response = await executeFetch(formData);
            if (response.status === true) {
                itemQty.innerText = parseInt(itemQty.innerText) - 1;
                itemTotal.innerText = parseInt(itemQty.innerText) * parseInt(itemPrice.innerText);
                orderTotal.innerText = parseInt(orderTotal.innerText) - parseInt(itemPrice.innerText);
            } else { return; }
        }
    }

    if (action === 'remove') {
        const confirmationResults = await fireAlert(
            'Confirmation required',
            'Please confirm if you want to remove this item from your cart',
            'warning',
            "Confirm",
            true
        );
        if (confirmationResults) {
            const response = await executeFetch(formData);
            if (response.status === true) {
                targetRow.remove();
                orderTotal.innerText = parseInt(orderTotal.innerText) - parseInt(itemTotal.innerText);
            } else { return; }
        }
    }

    await checkEmptyCart();
}

const fireAlert = async (title, text, icon, buttonText, showCancel) => {
    const result = await Swal.fire({
        title: title,
        html: text,
        icon: icon,
        showCancelButton: showCancel,
        confirmButtonText: buttonText || "Confirm",
        allowOutsideClick: false,
        allowEscapeKey: false,
    });
    return result.isConfirmed;
}

const checkEmptyCart = async () => {
    const cartRows = document.querySelectorAll('.shoppingCartRows');
    if (cartRows.length === 0) {
        const dialogResults = await fireAlert(
            "Your cart is empty",
            "Please add some items to your cart before proceeding to checkout, ",
            "info",
            "Continue shopping",
            false
        );

        if (dialogResults) {
            window.location.href = "../../index.php";
        }
    }
}

const executeFetch = async (formData) => {
    const response = await fetch("../../phpFunctions/doModifyOrder.php", {
        method: 'POST',
        body: formData
    });

    const responseJson = await response.json();
    if (responseJson.status !== 'success') {
        await fireAlert(
            'Error',
            'There was an error while trying to update your cart. Please try again later.',
            'error',
            false
        );
        return false;
    }
    return true;
}
