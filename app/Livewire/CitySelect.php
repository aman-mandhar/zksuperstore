<?php

namespace App\Livewire;

use Livewire\Component;

class CitySelect extends Component
{
    public $selectedCity;

    public function render()
    {
        $cities = [
            'Amritsar',
            'Ludhiana',
            'Jalandhar',
            'Patiala',
            'Bathinda',
            'Pathankot',
            'Mohali',
            'Hoshiarpur',
            'Moga',
            'Firozpur',
            'Sangrur',
            'Barnala',
            'Faridkot',
            'Fatehgarh Sahib',
            'Rupnagar',
            'Gurdaspur',
            // Add more cities as needed
        ];

        return view('livewire.city-select', compact('cities'));
    }
}
