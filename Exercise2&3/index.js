// init data
let currentIndex = 1;
const left_arrow = document.getElementById('arrow-left');
const right_arrow = document.getElementById('arrow-right');
const imagesBig = [
    {src: '../images/image1.jpg', alt: 'The cat and the book 1'},
    {src: '../images/image2.jpg', alt: 'The cat look at window'},
    {src: '../images/image3.jpg', alt: 'The cat hiding'},
    {src: '../images/image4.jpg', alt: 'The cat looking up'},
    {src: '../images/image5.jpg', alt: 'The cat sleeping'},
    {src: '../images/image6.jpg', alt: 'The cat boring'},
    {src: '../images/image7.jpg', alt: 'The cat look at x-max tree'},
    {src: '../images/image8.jpg', alt: 'The cat climbing tree'}
];

const imagesSmall = [
    {src: 'images/image1-small.jpg'},
    {src: 'images/image2-small.jpg'},
    {src: 'images/image3-small.jpg'},
    {src: 'images/image4-small.jpg'},
    {src: 'images/image5-small.jpg'},
    {src: 'images/image6-small.jpg'},
    {src: 'images/image7-small.jpg'},
    {src: 'images/image8-small.jpg'}
];
createHTML();
// init image
imageSlide(currentIndex);

load_small_image(imagesSmall);
left_arrow.addEventListener('click', () => {
    imageSlide(currentIndex -= 1);
});

right_arrow.addEventListener('click', () => {
    imageSlide(currentIndex += 1);
});

function nextImage(direction) {
    imageSlide(currentIndex += direction);
}

function currentSlide(n) {
    imageSlide(currentIndex = n);
}

function imageSlide(n) {
    let images = document.getElementsByClassName("imageBig-container");
    let smallImages = document.getElementsByClassName("imageSmall-container");
    if (n > images.length) {
        currentIndex = 1;
    }
    if (n < 1) {
        currentIndex = images.length;
    }
    for (let i = 0; i < images.length; i++) {
        let imgElement = images[i];
        images[i].style.display = "none";
    }

    for (let i = 0; i < smallImages.length; i++) {
        smallImages[i].classList.remove("active");
    }
    images[currentIndex - 1].children[0].setAttribute('src', imagesBig[currentIndex - 1].src);
    images[currentIndex - 1].children[1].innerHTML = imagesBig[currentIndex - 1].alt;
    images[currentIndex - 1].style.display = "block";
    images[currentIndex - 1].children[0].style.display = "block";
    smallImages[currentIndex - 1].classList.add("active");
}

function createHTML() {
    let mainContainer = document.getElementById("mainContainer2");

    // Drop all child element
    mainContainer.innerHTML = '';

    //Create based on the number of Big image
    for (let i = 0; i < imagesBig.length; i++) {
        let divElement = document.createElement("div");
        divElement.classList.add("imageBig-container");

        let imgElement = document.createElement("img");

        let altElement = document.createElement("div");
        altElement.classList.add("semi-opaque-box");

        imgElement.setAttribute('src', imagesBig[i].src);
        divElement.appendChild(imgElement);
        divElement.appendChild(altElement);
        mainContainer.appendChild(divElement);
    }

    //Create based on the number of Small image
    let thumbnailsElement = document.getElementById("thumbnails2");
    thumbnailsElement.innerHTML = '';

    //Create based on the number of Big image
    for (let i = 0; i < imagesSmall.length; i++) {
        let divElement = document.createElement("div");
        divElement.classList.add("imageSmall-container");
        divElement.classList.add("active");

        let imgElement = document.createElement("img");

        imgElement.setAttribute('src', imagesSmall[i].src);
        divElement.appendChild(imgElement);
        thumbnailsElement.appendChild(divElement);
    }

}

function load_small_image() {
    let smallImages = document.getElementsByClassName("imageSmall-container");
    for (let i = 0; i < imagesSmall.length; i++) {
        smallImages[i].children[0].setAttribute('src', imagesSmall[i].src);
    }
}