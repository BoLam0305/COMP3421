let imgCount = 0;

async function getFoods() {
    let card = document.getElementById('foodCard0');
    let wrapper = document.getElementById('cardWrapper');
    let loader = document.getElementById('loadingWrapper');
    let outerWrapper = document.getElementById('foodOuterWrapper');
    let allfoodBtn = document.getElementById('allBtn');
    let cardClone = card.cloneNode(true);
    let collectionHead = document.getElementById('collectionHead');

    card.setAttribute('style', 'display: none');

    // Get the foods from the database
    fetch('../phpFunctions/queryProducts.php', {
        method: 'POST'
    }).then(response => response.text()).then(async (response) => {
        console.log(response);
        // Parse the response
        let json = JSON.parse(response);
        console.log(json);
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

                // Put the json's element into variables
                foodName = json[i].productName;
                foodID = json[i].productID;
                foodPrice = json[i].Price;

                // reset all stock labels
                cardClone.querySelector('#label-InStock').setAttribute('style', 'display: none');
                cardClone.querySelector('#label-LowStock').setAttribute('style', 'display: none');
                cardClone.querySelector('#label-SoldOut').setAttribute('style', 'display: none');
                cardClone.querySelector('#viewBtn').classList.remove('disabled');
                cardClone.querySelector('#viewBtn').innerText = 'Add to Cart';

                // set the product's stock label
                if (json[i].Stock === 'In Stock') {
                    cardClone.querySelector('#label-InStock').setAttribute('style', 'display: block');
                } else if (json[i].Stock === 'Low Stock') {
                    cardClone.querySelector('#label-LowStock').setAttribute('style', 'display: block');
                } else {
                    cardClone.querySelector('#viewBtn').classList.add('disabled');
                    cardClone.querySelector('#label-SoldOut').setAttribute('style', 'display: block');
                    cardClone.querySelector('#viewBtn').innerText = 'Sold Out';
                }

                // append the image to the card independently
                getImageByID(json[i].productID, cardClone, json.length);

                // Append the food card to the cardWrapper
                cardClone.setAttribute('id', 'foodCard' + i);
                cardClone.setAttribute('style', 'display: block');
                cardClone.querySelector('#foodName').innerText = foodName;
                cardClone.querySelector('#price').innerText = foodPrice;

                cardClone.querySelector('#viewBtn').href = `foodDetails.php?foodID=${foodID}`;
                wrapper.appendChild(cardClone);
            }
        }
    }).catch(error => console.log(error));
}

function getImageByID(productID, cardClone, totalImageCount) {
    let loader = document.getElementById('loadingWrapper');
    let outerWrapper = document.getElementById('foodOuterWrapper');
    const searchParams = new URLSearchParams();
    searchParams.append('productID', productID);

    // fetch only the image from the database
    fetch('../phpFunctions/queryImage.php', {
        method: 'POST',
        body: searchParams
    }).then(response => response.text()).then(response => {
        // append the image to the card
        cardClone.querySelector('#foodImage').src = `data:image/png;base64,${response}`;

        // increment the image count
        imgCount++;

        // if the image count is equal to the total image count, remove the loader and enable the view all button
        if (imgCount === totalImageCount) {
            loader.remove();
            outerWrapper.setAttribute('style', 'display: block');
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
        // img.setAttribute('src', `data:image/png;base64,${highLightedItems[i].productImage}`);
        img.setAttribute('src', `sample-image.jpg`);
        img.classList.add('d-block');
        img.classList.add('w-100');
        img.classList.add('hlImage');
        carouselItem.appendChild(img);

        caption.classList.add('carousel-caption');
        caption.classList.add('d-none');
        caption.classList.add('d-md-block');
        captionTitle.innerText = `Featured: ${highLightedItems[i].productName}`;
        caption.appendChild(captionTitle);
        carouselItem.appendChild(caption);
        carouselItems.appendChild(carouselItem);
    }
}