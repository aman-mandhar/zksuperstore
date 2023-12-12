<?php


namespace App\Http\Livewire;

use Livewire\Component;

class CustomStockTransfer extends Component
{
    public $salePrice;
    public $type;
    public $measure = 0;
    public $totNoOfItems = 0;

    public function mount($salePrice, $type)
    {
        $this->salePrice = $salePrice;
        $this->type = $type;
    }

    public function render()
    {
        $totalAmount = $this->type === 'Loose' ? $this->salePrice * $this->measure : $this->salePrice * $this->totNoOfItems;

        return view('livewire.stock-transfer', [
            'totalAmount' => $totalAmount,
        ]);
    }
}
