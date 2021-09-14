<div>
    <form>
        <button type="button" wire:click="decrease">-</button>
        <input type="number" id="number" wire:model="quantity" min="1" wire:change="updateCart" />
        <button type="button" wire:click="increase">+</button>
    </form>
</div>
