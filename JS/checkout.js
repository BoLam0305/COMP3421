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
            await fireReceipt(message.orderID);
        } else if (message.error){
            await fireCheckoutError(message.error);
        }
        console.log(message);
    }).catch((error) => { console.log(error) });
}

const setMethod = (m) => {
    const confirm = document.getElementById('confirmPaymentBtn');
    confirm.removeAttribute('disabled');

    method = m;
}

const fireReceipt = async (orderID) => {
    await Swal.fire({
        title: 'Your order has been placed.',
        html: `Show the Number Below at the Counter to Collect your Order.<br><br>
                <h3>ORDER: #${orderID}</h3><br>
                Thank you for shopping with us.`,
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Return to Home Page'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../home.php';
        }
    });
}

const fireCheckoutError = async (message) => {
    await Swal.fire({
        title: 'Error',
        html: message,
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Close'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.close();
        }
    });
}

// add a page onload event listener
window.addEventListener('load', () => {
    console.log('Page loaded');
});