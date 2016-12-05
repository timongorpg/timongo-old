window.setUsePotion = function(potionId){
    document.querySelector('#use-potion-form [name=potion_id]').value = potionId;
    document.querySelector('#use-potion-form').submit();
}

window.setPotion = function(potionId) {
    document.querySelector('#potions-form [name=potion_id]').value = potionId;
    document.querySelector('#potions-form').submit();
}