const item = document.querySelectorAll('.item')

function showItens(num) {
    const clickedSpan = item[num]
    const nextUl = clickedSpan.nextElementSibling
    
    if(nextUl.style.display === 'none' || nextUl.style.display === '') {
        nextUl.style.display = 'block'
    } else {
        nextUl.style.display = 'none'
    }
    
}
