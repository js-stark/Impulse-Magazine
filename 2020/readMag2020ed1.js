// References to DOM Elements
const prevBtn = document.querySelector("#prev-btn");
const nextBtn = document.querySelector("#next-btn");
const book = document.querySelector("#book");

const paper1 = document.querySelector("#p1");
const paper2 = document.querySelector("#p2");
const paper3 = document.querySelector("#p3");
const paper4 = document.querySelector("#p4");
const paper5 = document.querySelector("#p5");
const paper6 = document.querySelector("#p6");
const paper7 = document.querySelector("#p7");
const paper8 = document.querySelector("#p8");

// Event Listener
prevBtn.addEventListener("click", goPrevPage);
nextBtn.addEventListener("click", goNextPage);

// Current Location
let currentLocation = 1;

// Paper Logic for the year 2020ed1

let numOfPapers2020ed1 = 10;
let maxLocation2020ed1 = numOfPapers2020ed1 + 1;

function openBook() {
    book.style.transform = "translateX(50%)";
    prevBtn.style.transform = "translateX(5rem) translateY(0rem)";
    nextBtn.style.transform = "translateX(-5rem) translateY(0rem)";
}

function closeBook(isAtBeginning) {
    if(isAtBeginning) {
        book.style.transform = "translateX(0%)";
    } else {
        book.style.transform = "translateX(100%)";
    }
    
    prevBtn.style.transform = "translateX(0px)";
    nextBtn.style.transform = "translateX(0px)";
}

function goNextPage() {
    if(currentLocation < maxLocation2020ed1) {
        switch(currentLocation) {
            case 1:
                openBook();
                paper1.classList.add("flipped");
                paper1.style.zIndex = 10;
                break;
            case 2:
                paper2.classList.add("flipped");
                paper2.style.zIndex = 20;
                break;
            case 3:
                paper3.classList.add("flipped");
                paper3.style.zIndex = 30;
                break;
            case 4:
                paper4.classList.add("flipped");
                paper4.style.zIndex = 40;
                break;
            case 5:
                paper5.classList.add("flipped");
                paper5.style.zIndex = 50;
                break;
            case 6:
                paper6.classList.add("flipped");
                paper6.style.zIndex = 60;
                break;
            case 7:
                paper7.classList.add("flipped");
                paper7.style.zIndex = 70;
                break;
            case 8:
                paper8.classList.add("flipped");
                paper8.style.zIndex = 80;
                closeBook(false);
                break;
            default:
                throw new Error("unkown state");
        }
        currentLocation++;
    }
}

function goPrevPage() {
    if(currentLocation > 1) {
        switch(currentLocation) {
            case 2:
                closeBook(true);
                paper1.classList.remove("flipped");
                paper1.style.zIndex = 100;
                break;
            case 3:
                paper2.classList.remove("flipped");
                paper2.style.zIndex = 90;
                break;
            case 4:
                openBook();
                paper3.classList.remove("flipped");
                paper3.style.zIndex = 80;
                break;
            case 5:
                openBook();
                paper4.classList.remove("flipped");
                paper4.style.zIndex = 70;
                break;
            case 6:
                openBook();
                paper5.classList.remove("flipped");
                paper5.style.zIndex = 60;
                break;
            case 7:
                openBook();
                paper6.classList.remove("flipped");
                paper6.style.zIndex = 50;
                break;
            case 8:
                openBook();
                paper7.classList.remove("flipped");
                paper7.style.zIndex = 40;
                break;
            case 9:
                openBook();
                paper8.classList.remove("flipped");
                paper8.style.zIndex = 30;
                break;
            
            default:
                throw new Error("unkown state");
        }

        currentLocation--;
    }
}