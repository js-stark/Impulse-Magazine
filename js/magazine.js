let book = document.querySelector(".book");
let firstHalf = document.querySelector(".first-half");
let secondHalf = document.querySelector(".second-half");


book.addEventListener('click',()=>{
    book.classList.toggle("flip");
});

firstHalf.addEventListener('mouseenter',()=>{
    book.classList.add("rotateLeft");
})
firstHalf.addEventListener('mouseout',()=>{
    book.classList.remove("rotateLeft");
})
secondHalf.addEventListener('mouseenter',()=>{
    book.classList.add("rotateRight");
})
secondHalf.addEventListener('mouseout',()=>{
    book.classList.remove("rotateRight");
})