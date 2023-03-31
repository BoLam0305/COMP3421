let method ='';

const checkOutCart = async () => {
    const formData = new FormData();
    formData.append('method', method);

    await fetch('../../phpFunctions/doCheckOut.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text()).then(async (response) => {
        console.log(response);
        let message = JSON.parse(response);
        if(message.message === "Checkout success"){
            await fireReceipt(message.orderID, message.orderNotices.exceedStock, message.orderNotices.outOfStock);
        } else if (message.status === "error"){
            await fireCheckoutError(message.message, message.action, message.actionText);
        }
        console.log(message);
    }).catch((error) => { console.log(error) });
}

const setMethod = (m) => {
    const confirm = document.getElementById('confirmPaymentBtn');
    confirm.removeAttribute('disabled');
    method = m;
}

const fireReceipt = async (orderID, exceedStockNotices, outStockNotices) => {
    let noticesHTML = exceedStockNotices || outStockNotices || '';
    let itemString = '';

    // append the notices to the HTML if there are any
    if (noticesHTML !== '') {
        noticesHTML = `<br><br><br><h4>Special Notices Regarding Your Order</h4><br>
                        The following items does not have enough stock to fulfill your order, 
                        the items below and order total had been adjusted accordingly.<br><br>`;

        for (let key in exceedStockNotices) {
            itemString += `<li>Quantity of item ${exceedStockNotices[key].productName} 
                            had been set to ${exceedStockNotices[key].Avail_Stock} </li>`;
        }

        for (let key in outStockNotices) {
            itemString += `<li>Item ${outStockNotices[key].productName} was out of stock and
                            had been removed from your order </li>`;
        }

        noticesHTML += `<ul>${itemString}</ul>`;
        noticesHTML += `We apologize for the inconvenience caused.`;
    }

    await Swal.fire({
        title: 'Your order has been placed.',
        html: `Show the Number Below at the Counter to Collect your Order.<br><br>
                <h3>ORDER: #${orderID}</h3><br>
                Thank you for shopping with us. ${noticesHTML}`,
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Return to Home Page'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../home.php';
        }
    });
}

const fireCheckoutError = async (message, action, btnText) => {
    await Swal.fire({
        title: 'Error',
        html: message,
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: btnText || 'Close'
    }).then((result) => {
        if (result.isConfirmed && action === 'redirect') {
            window.location.href = '../home.php';
        } else if (result.isConfirmed) {
            Swal.close();
        }
    });
}

// add a page onload event listener
window.addEventListener('load', () => {
    console.log('Page loaded');
});