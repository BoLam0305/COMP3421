let method ='';

const checkOutCart = async () => {
    const formData = new FormData();
    console.log(method);
    formData.append('method', '');

    await fetch('../../phpFunctions/doCheckOut.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text()).then(async (response) => {
        console.log(response);
        let message = JSON.parse(response);

        if(message.message === "Checkout success"){
            await fireReceipt(message.orderID);
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

const fireError = async (message) => {
    await Swal.fire({
        title: 'Error',
        html: message,
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Return to Home Page'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../home.php';
        }
    });
}

// add a page onload event listener
window.addEventListener('load', () => {
    console.log('Page loaded');
}