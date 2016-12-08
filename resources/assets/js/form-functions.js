window.setUsePotion = function(potionId){
    document.querySelector('#use-potion-form [name=potion_id]').value = potionId;
    document.querySelector('#use-potion-form').submit();
}

window.setPotion = function(potionId, amount) {
    amount = amount ? amount : 1;

    document.querySelector('#potions-form [name=potion_id]').value = potionId;
    document.querySelector('#potions-form [name=amount]').value = amount;
    document.querySelector('#potions-form').submit();
}