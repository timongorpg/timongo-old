window.blinkTitle = function(newText) {
    var title = document.querySelector('title');
    var oldText = title.innerHTML;

    setTimeout(function(){
        title.innerHTML = title.innerHTML == oldText ? newText : oldText;

        blinkTitle(oldText);
    }, 1500);
}