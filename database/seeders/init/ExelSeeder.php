<?php

namespace Database\Seeders\init;

use App\Models\Branch;
use App\Models\Client;
use App\Models\Company;
use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regions;

class ExelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exelData = json_decode(file_get_contents(__DIR__."/../references/exel.json"));
        echo "Exel::inserting".PHP_EOL;
        foreach ($exelData as $item) {
            $clientData = [
                'application_number' => $item->application_number ?? null,
                'contact' => $item->contact ?? null,
                'client_description' => isset($item->client_description) ? $item->client_description : null,
            ];
        
            $client = Client::create($clientData);
        
            $companyData = [
                'client_id' => $client->id,
                'company_name' => $item->company_name ?? null,
            ];
        
            $company = Company::create($companyData);
        
            $branchData = [
                'company_id' => $company->id ?? null,
                // 'location' => $item->branch_location ?? null,
                'branch_kubmetr' => $item->branch_kubmetr ?? null,
                'generate_price' => $item->generate_price ?? null,
                'first_payment_percent' => $item->first_payment_percent ?? null,
                'payed_sum' => isset($item->payed_sum) ? $item->payed_sum : null,
                'payed_date' => isset($item->payed_date) ? $item->payed_date : null,
                'contract_apt' => $item->contract_apt ?? null,
            ];
        
            $branch = Branch::create($branchData);
        
            $productData = [
                'client_id' => $client->id,
                'user_id' => 1,
                'minimum_wage' => $item->minimum_wage ?? null,
            ];
        
            $product = Products::create($productData);
        }
        
    }
}
