<?php

namespace App\Services\Supplier;

use App\Models\Supplier;

class SupplierServices
{
    public function index($search, string $fetchType = "get")
    {
        $paginate = 10;
        if (!empty($search) || $fetchType === "get") {
            $paginate = 0;
        }
        return Supplier::when(
            $search,
            function ($query) use ($search) {
                $query->where('company_name', 'like', "%" . $search . "%")
                ->orWhere('email','like',"%{$search}%")
                ->orWhere('phone','like',"%{$search}%")
                ->orWhere('district','like',"%{$search}%")
                ->orWhere('city','like',"%{$search}%");
            }
        )->latest('id')
        ->paginate($paginate)
        ->withQueryString();
    }

    public function store(array $data): object{
        return Supplier::create($data);
    }
    public function update(array $data, object $supplier): bool{
        return $supplier->update($data);
    }
}
