let imgCount = 0;

function getFoods() {
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
    }).then(response => response.text()).then(response => {
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
    let allfoodBtn = document.getElementById('allBtn');
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
            allfoodBtn.classList.remove('disabled');
            allfoodBtn.innerText = 'View All foods';
            outerWrapper.setAttribute('style', 'display: block');
        }
    }).catch(error => console.log(error));
}