## About Template

This is ready admin panel template with
- [Laravel 8](https://laravel.com/docs/8.x)
- [Laravel-permissions (Spatie.be)](https://spatie.be/docs/laravel-permission/v3/introduction)
- [Authorization laravel/ui](https://github.com/laravel/ui)

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## DB

<img src="./db.png"/>

## Iframe

<iframe src="https://dbdiagram.io/d/664f2659f84ecd1d22f46bcf" width="100" height="100" style="margin: auto; display: flex;justify-content: center; width: 100%; height: 900px;" frameborder="0"></iframe>


## bugs clean code qlsh kere
```
cdn lani ob tashash kere
table ga exel qoshish kere +++
multi company create qlsh kere +++
database skeletini korb chqsh kere 

composer require maatwebsite/excel +++

php artisan make:export ProductsExport --model=Products


bolib tolanadigan kvartllar soni +++

1) mi to'lanishi kerak bo'gan miqdor * Bo'lib to'lash foizi oldindan = 

input polya tuzutsh kere +++

Yurik: Kompanya nomi,Raxbar FIO, Passport datas(nullable), ID-CARD,  Manzili, Xisobvaraq, Bank kodi, CTIR, OKED,  Xizmat korstavchi bank, TEL,

Fizik: FIO, Manzili, Passport datas, Tel,ID-CARD,

bank kod = 5 +++

mestapalojenya comp keermas ++++
 
Юридический реквизит = xisob raqam +++

Jamg'arma Rekviztlari = keremas +++

id passport radio blan qoshish kere +++

enter btn = disabled +++

accardion default open +++

naxt va rasrochka option qoysh kere naxt boganda foiz kratdgan input disable bolsh kere +++

yashash manzili +++

Passport sanasi = type +++

shulani products/show ga chqazsh kere +++

product edit fix qlish kere +++

request history qlish kere +++

file upload qilish kere +++

product showga table chqazsh kere kredit xoblab beradgan +++

familya imya otchestva +++

file upload ui chiroyli qlish kere +++

blade digi textlani jsondan chqab qilish kere +++

product edit textlani fix qlish kere +++

multiple doc download qilish kere branch xar xil qilib exelgayam shu +++

role permissionlani korvorsh kere +++

edit blade ga xamma value lani chqash kere +++

audit logs user friendly qilish kere +++

edit input laga date qoshish kere +++

edit mijoz_turi eski datani olishi +++

passport_date -> datetime-local x : datetime true +++

cache audit logs fix qlish kere +++

INN = 9 required +++

OKED = 5 required +++

doljnest || F.I.O +++

yuridik rekvizit -> bank shot +++

period fix qilish kere +++

product show id fix qlish kere +++

product->address -> yuridik address chqash kere +++

Bank Shot = 20 required +++

applicatoin_num qatta bolshi kere ? Branch +++

edit blade ga add accardion qlish kere +++

inn fizikga chqash kere +++

kubmetr fload insert qlsh kere  +++

fizik uchun address +++

daily backup qilish kere schedule blan +++

branch_location qoshish kere  +++

metrkub qurilish xajmi (m^3) +

obshiy summa (so'm) +

sonlani orasini ochish kere +

pinfl = 14 +

seria = 9 +

$table->bigInteger('document_number'); // Changed to bigInteger  +++

php artisan make:migration change_document_number_type_in_credit_transactions_table +++

edit qvotganda branch_kubmetrga float kiritib bomyapti +++

pasport_date = date qlsh kere +++

product add / edit qvotganda validatsalani check qb chiqish kere +++

textlani fix qilish kere +++

debugbar json unsave qlsh kere +++

yurik_pdf qlsh kere ken validatsa +++

Company name, platej descriptoin, data, inn : tip keremas +++

edit boganda calc script qlish kere +++ 
 
generate_price not changeble bop qogan fix qlsh kere  +++

INN = minimum & maximum = 9 +++

exel da N_ keremas +++

word : fizik => [
    oked keremas
    pinfl passport => pinfl
    passport seriya chqmadi
    full_name pasida chqazish kere
    float sonlani fixed() qilish kere
] +++

modal window hamma userga chqshi kere where auth()->user()->id = views.user_id toxtaw kere +++

.0000 lani ob tashash kere +++

Mijoz_turi keremas +++

mesta raspalajenya xato chqazvotti +++

bazadigi data ni import qilish kere columnlani toglab chqb push qvorsh kere +++

constructionsda faqat role constructions uchun role chqish kere +++  

constructionsda kim ko'rganini chqazish kere +++

Modal window optimizatsiya qilish kere +++

consttuctionga search qoshish kere +++

agar view table da user_id && branch_id && status == bosa update qlsh kere alohida create qmasdan +++

middlware qoshish kere qurilishga +++

modalkada correct value la chqazsh kere +++

modalkada summalani orasini ochish kere +++

constrcutions ga text lani fix qb chqish kere +++

construction show digi 000 000 lani fix qilish kere +++

product show dayam 000 000 sonlani fix qlish kere with optimal way +++

company_name and branch_name word ga qoshish kere +++

product index/show add some beauty +++

product raspnsive qlsh kere +++

platejka pinned qlsh kere +++

chat qlsh kere +++

Transactionlani payed date blan solishtrib fix qilish kere +++

ob serverga user_id relation qlsh kere +++

categoryni modelda relation qlsh kere client blan +++

client da with blan categoryni obchqsh kere +++

product index ga categoryni obchqish kere +++

constructions da obyektlani construction num blan ajratib qoyish kere +++

product add qvotganda error bosa old value lani chqazb qoysh kere +++

remove accardion ochishi keremas agar bitta bosa +++

edit ga stir chqazb qoysh kere +++

full backupni obturb localda mysql baza yasavolb columnlani toglab olib productionga qoysh kere +++

blade clean qilish kere 

optimize history queries

file lani clients lagamas branch laga ulash kere

percentage ga butun son kiradgan qiliish kere 

https://krt.mos.ru/ shunaqa qlsh kere locationlani

```

## New Tasks

```
categorya qoshish kere = ['ruxsatnoma', 'Apz','Kengash'] seeder qlinsin tanlashda select  option blan chqsin +++

Qurilish va Apz da yaratilingan voqt keremas created_at orniga contact tushadi & kontakt eski orniga nomer zayevlenya va tepadgi categorya tushadi +++

company history dan uniqe ni obtashash kere +++

xar file uchun alohida input fields bo'lishi kere va alohida user friendly qlish kere with labels +++

product add qvotganda fizikda stir chqsin & input type lanyam fix qilish kere +++

statistika qoshish kere 

telegram bot qilish kere zayavka qoldirish uchun 

toshkentinvest.uz ni copy qilib dashboardga ulash kere va bu katalog sayt boladi ichida news, blog, post, form , va bowqa malumotla boladi

```

## GJP Tasks

```
Kmz fayldan location oqvolsh kere

Gjp uchun alohida baza qlish kere

Google dan api olib markers la qoyish kere rayonlaga 

berilmoqchi bogan xamma dannini bazaga seed qilish kere

maps_details = [
    rayonlani ustiga bosganda:  obyektlani xajmi qurilgan uylarni va varcha narsalarni total counti kere boladi

    obyektni ustiga bosganda:  aynan shuni xajmi chiqishi kere va uni ichidagi uylarning soni chqishi kere

    obkyekt ichidagi markerni bosganda: aynan shu binoning xajmi info lari chqishi kere boladi
]

```

## Client mobile
```
branch ga obyektning joylashuvi ni qoshish kere +++

product edit ni fix qilish kere kafetsient scriptlari bilan +++

product add ni fix qilish kere kafetsient scriptlari bilan +++

```


<a href="https://wordtohtml.net/">https://wordtohtml.net/</a>

shu sayt blan word ni html qvolamza

```
composer require maatwebsite/excel
```

composer require barryvdh/laravel-debugbar

php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"--tag="config"

composer require yajra/laravel-datatables-oracle

```

php artisan make:command ClearOptimizeCache

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ClearOptimizeCache extends Command
{
    protected $signature = 'cache:clear-optimize';

    protected $description = 'Clear the optimized cache';

    public function handle()
    {
        $this->info('Clearing optimized cache...');
        Artisan::call('optimize:clear');
        $this->info('Optimized cache cleared successfully.');
    }
}

app/Console/Kernel.php
protected $commands = [
    \App\Console\Commands\ClearOptimizeCache::class,
];


Route::get('/clear-optimize-cache', function () {
    \Artisan::call('cache:clear-optimize');
    return 'Optimized cache cleared successfully.';
});


<form action="/clear-optimize-cache" method="GET">
    <button type="submit">Clear Optimized Cache</button>
</form>

```

```
C:\xampp\mysql\bin\mysqldump.exe -u root -p invest > C:\Users\user\Desktop\invest\invest-update\storage\app\backups\backup-test.sql

composer require irazasyed/telegram-bot-sdk

direktor nomi chqmyapti


```


## Permission
```
        "spatie/laravel-permission": "5.0"
```

```
 /usr/local/bin/php /home/t123379/public_html/invest.teamdevs.uz/artisan db:backup>/dev/null 2>&1
 ```

 https://extract.me/

'notification_num' => 'Номер уведомления', => nomer razreshenya bogan !

## for space
```
 <tr>
    <td>@lang('cruds.branches.fields.payed_sum')</td>
    <td colspan="2" id="payedSumCell">{{ $b->payed_sum }}</td>
</tr>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function formatNumberWithSpaces(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }

        var payedSumElement = document.getElementById('payedSumCell');
        var payedSumValue = payedSumElement.textContent;

        payedSumElement.textContent = formatNumberWithSpaces(payedSumValue);
    });
</script>
```

```
composer require shuchkin/simplexlsx

```

```
php artisan make:migration change_document_number_type_in_credit_transactions_table

 public function up()
    {
        Schema::table('credit_transactions', function (Blueprint $table) {
            $table->dropColumn('document_number');
        });

        Schema::table('credit_transactions', function (Blueprint $table) {
            $table->bigInteger('document_number')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_transactions', function (Blueprint $table) {
            $table->dropColumn('document_number');
        });

        Schema::table('credit_transactions', function (Blueprint $table) {
            $table->integer('document_number')->after('id');
        });
    }

    php artisan migrate

```

```
APT = Apz uchun 

"ГОРОД ТАШКЕНТ",  => reklama

```

## Create custom route 

```
php artisan make:middleware ConstructionMiddleware

<!-- app/http/kernel.php -->

protected $routeMiddleware = [
    'construction' => \App\Http\Middleware\ConstructionMiddleware::class,
];

<!-- Route service provider -->

 public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('construction')
                ->namespace($this->namespace)
                ->group(base_path('routes/construction.php'));
        });
    }

    040176
```

```
composer require symfony/mailer
```

```
php artisan make:migration add_apz_columns_to_branches_table --table=branches

 public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->string('apz_raqami')->nullable()->after('branch_type');
            $table->date('apz_sanasi')->nullable()->after('apz_raqami');
            $table->text('kengash')->nullable()->after('apz_sanasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn(['apz_raqami', 'apz_sanasi', 'kengash']);
        });
    }

    712100261
 ```

 ## if storage undeletable 
 ```
 unlink storage
 
 rm storage

ls -l storage

 ```

 ## seed class
 ```
php artisan db:seed --class=Database\Seeders\init\CategorySeeder
```
```
php artisan make:migration add_category_id_to_clients_table --table=clients

 public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }

```

php artisan db:seed --class=Database\\Seeders\\init\\ExelSeeder