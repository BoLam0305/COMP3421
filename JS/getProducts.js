let imgCount = 0;

async function getFoods() {
    let card = document.getElementById('foodCard0');
    let wrapper = document.getElementById('cardWrapper');
    let loader = document.getElementById('loadingWrapper');
    let outerWrapper = document.getElementById('foodOuterWrapper');
    let allfoodBtn = document.getElementById('allBtn');
    let cardClone = card.cloneNode(true);
    let collectionHead = document.getElementById('collectionHead');
    let carousel = document.getElementById('hlCarouselWrapper');

    card.setAttribute('style', 'display: none');

    // Get the foods from the database
    fetch('../phpFunctions/queryProducts.php', {
        method: 'POST'
    }).then(response => response.text()).then(async (response) => {
        console.log(response);
        // Parse the response
        let json = JSON.parse(response);
        let foodName, foodID, foodImage, foodPrice;

        if (Object.keys(json).length === 0) {
            collectionHead.innerText = 'Oops, there\'s no foods available at the moment, please check back later.';
            loader.remove();
            allfoodBtn.innerText = 'No foods Available';
            outerWrapper.setAttribute('style', 'display: block');
        } else {
            await setCarouselHighLight(json);
            for (let i in json) {
                // Prevent the old card from being overwritten by the new one
                // Don't ask me why this works, I don't know
                if (i > 0) {
                    let j = i - 1;
                    card = document.getElementById(`foodCard${j}`);
                    cardClone = card.cloneNode(true);
                }

                // check whether the card has a login button or an order button
                let isLoginButtonExist = cardClone.querySelector('#LoginBtn');
                let isOrderButtonExist = cardClone.querySelector('#OrderBtn');

                // Put the json's element into variables
                foodName = json[i].productName;
                foodID = json[i].productID;
                foodPrice = json[i].Price;
                foodImage = json[i].productImage;

                // reset all stock labels
                cardClone.querySelector('#label-InStock').setAttribute('style', 'display: none');
                cardClone.querySelector('#label-LowStock').setAttribute('style', 'display: none');
                cardClone.querySelector('#label-SoldOut').setAttribute('style', 'display: none');

                cardClone.querySelector('#foodImage').src = `../img/${foodImage}`;

                if (isLoginButtonExist){
                    cardClone.querySelector('#LoginBtn').classList.remove('disabled');
                    cardClone.querySelector('#LoginBtn').innerText = 'Login to Order';
                } else if (isOrderButtonExist) {
                    cardClone.querySelector('#OrderBtn').classList.remove('disabled');
                    cardClone.querySelector('#OrderBtn').innerText = 'Order';
                    cardClone.querySelector('#OrderBtn').setAttribute('item', foodID);
                }

                // set the product's stock label
                if (json[i].Stock === 'In Stock') {
                    cardClone.querySelector('#label-InStock').setAttribute('style', 'display: block');
                } else if (json[i].Stock === 'Low Stock') {
                    cardClone.querySelector('#label-LowStock').setAttribute('style', 'display: block');
                } else {
                    cardClone.querySelector('#label-SoldOut').setAttribute('style', 'display: block');
                    if (isLoginButtonExist){
                        cardClone.querySelector('#LoginBtn').classList.add('disabled');
                        cardClone.querySelector('#LoginBtn').innerText = 'Sold Out';
                    } else if (isOrderButtonExist) {
                        cardClone.querySelector('#OrderBtn').classList.add('disabled');
                        cardClone.querySelector('#OrderBtn').innerText = 'Sold Out';
                    }
                }

                // Append the food card to the cardWrapper
                cardClone.setAttribute('id', 'foodCard' + i);
                cardClone.setAttribute('style', 'display: block');
                cardClone.querySelector('#foodName').innerText = foodName;
                cardClone.querySelector('#price').innerText = foodPrice;

                if (isOrderButtonExist)
                    cardClone.setAttribute('onclick', `addItemToCart(${foodID})`);

                wrapper.appendChild(cardClone);
            }

            loader.remove();
            outerWrapper.setAttribute('style', 'display: block');
            carousel.setAttribute('style', 'display: block');
        }
    }).catch(error => console.log(error));
}

async function setCarouselHighLight(items) {
    let highLightedItems = [];
    let indicators = document.getElementById('hlCarousel-indicators');
    let carouselItems = document.getElementById('hlCarousel-inner');

    // loop over the items object and get the highlighted items
    for (let i in items) {
        if (items[i].isPromoted === 1) {
            highLightedItems.push(items[i]);
        }
    }

    // loop over the highlighted items and set the carousel indicators and items
    for (let i in highLightedItems) {
        let index = Number(i);
        let banner = highLightedItems[i].productImage;
        console.log(banner)

        // create a new indicator and append it to the indicators
        let indicator = document.createElement('button');
        indicator.setAttribute('type', 'button');
        indicator.setAttribute('data-bs-target', '#hlCarousel');
        indicator.setAttribute('data-bs-slide-to', `${index}`);
        indicator.setAttribute('aria-label', `Slide ${index + 1}`);

        if (index === 0) {
            indicator.setAttribute('aria-current', 'true');
            indicator.classList.add('active');
        }

        indicators.appendChild(indicator);

        // create a new inner item and append it to the carousel items
        let carouselItem = document.createElement('div');
        let img = document.createElement('img');
        let caption = document.createElement('div');
        let captionTitle = document.createElement('h5');

        carouselItem.classList.add('carousel-item');

        if (index === 0) {
            carouselItem.classList.add('active');
        }
        img.setAttribute('src', `../img/${banner}`);
        img.classList.add('d-block', 'w-100', 'h-50', 'hlImage');
        carouselItem.appendChild(img);

        caption.classList.add('carousel-caption', 'd-none', 'd-md-block');
        captionTitle.innerText = `Featured: ${highLightedItems[i].productName}`;
        caption.appendChild(captionTitle);
        carouselItem.appendChild(caption);
        carouselItems.appendChild(carouselItem);
    }
}

function addItemToCart(id) {
    let formData = new FormData();
    formData.append('id', id);

    fetch('../phpFunctions/addProductToCart.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text()).then(response => {
        if(response === 'Item added to cart'){
            alert('Item had been added to cart successfully');
        } else if (response === 'Out of stock') {
            alert('Item is out of stock, please try again later.');
        } else {
            alert('There was an error adding the item to cart, please try again later.');
        }
        console.log(response);
    }).catch(error => console.log(error));
}