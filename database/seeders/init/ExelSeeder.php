<?php
namespace Database\Seeders\init;

use App\Models\Branch;
use App\Models\Client;
use App\Models\Company;
use App\Models\Products;
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
        $exelData = json_decode(file_get_contents(__DIR__ . "/../references/exel.json"));
        echo "Exel::inserting" . PHP_EOL;
        
        foreach ($exelData as $item) {
            $clientData = [
                'contact' => $item->contact ?? null,
                'client_description' => isset($item->client_description) ? $item->client_description : null,

                'company_name' => $item->company_name ?? null,

            ];

            $client = Client::create($clientData);
            
            $payed_date = null;
            if (isset($item->payed_date)) {
                try {
                    $payed_date = new \DateTime($item->payed_date);
                    $payed_date = $payed_date->format('Y-m-d H:i:s');
                } catch (\Exception $e) {
                    $payed_date = null;
                }
            }

            $branchData = [
                'client_id' => $client->id ?? null,
                'application_number' => $item->application_number ?? null,
                'branch_kubmetr' => $item->branch_kubmetr ?? null,
                'generate_price' => $item->generate_price ?? null,
                'first_payment_percent' => $item->first_payment_percent ?? null,
                'payed_sum' => isset($item->payed_sum) ? $item->payed_sum : null,
                'payed_date' => $payed_date,
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
