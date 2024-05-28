<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;


class HomeController extends Controller
{
    // public function index()
    // {
    //     $is_role_exists = DB::select("SELECT COUNT(*) as cnt FROM `model_has_roles` WHERE model_id = ".auth()->id());

    //     if ($is_role_exists[0]->cnt)
    //         return view('pages.dashboard');
    //     else
    //         return view('welcome');
    // }

    public function index()
    {
        $userId = auth()->id();

        $hasRoles = DB::table('model_has_roles')
            ->where('model_id', $userId)
            ->exists();

        if ($hasRoles) {
            return view('pages.dashboard');
        } else {
            return view('welcome');
        }
    }
    public function getClientData($id)
    {
        return DB::table('clients')
            ->join('companies', 'clients.id', '=', 'companies.client_id')
            ->join('branches', 'companies.id', '=', 'branches.company_id')
            ->select(
                'clients.id',
                'clients.first_name',
                'clients.last_name',
                'clients.father_name',
                'clients.first_name as client_name',
                'companies.company_name',
                'companies.company_location',
                'companies.raxbar',
                'branches.contract_apt',
                'branches.contract_date',
                'branches.branch_kubmetr',
                'branches.generate_price',
                'branches.payment_type',
                'branches.percentage_input',
                'branches.installment_quarterly'
            )
            ->where('clients.id', $id)
            ->first();
    }
    
    public function generateDocx($id)
    {
        $clientData = $this->getClientData($id);
    
        if (!$clientData) {
            // Handle the case where no data is found
            return response()->json(['error' => 'Client not found'], 404);
        }
    
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        
        // Define styles
        $phpWord->addTitleStyle(1, array('size' => 16, 'bold' => true, 'color' => '1B2232', 'underline' => 'single'), array('align' => 'center'));
        $phpWord->addTitleStyle(2, array('size' => 14, 'bold' => true, 'color' => '1B2232'), array('align' => 'left'));
        $phpWord->addFontStyle('paragraphStyle', array('name' => 'Times New Roman', 'size' => 12, 'color' => '1B2232', 'spaceAfter' => 240));
    
        // Add a section to the document
        $section = $phpWord->addSection();
    
        // Example of adding client data to the document
        $main = "<h1>Бинонинг (иншоотнинг) щаватлар сони белгиланган параметрлардан оширилганда кушимча щурилишига архитектура-режалаштириш ТОПШИРИГИ берилгани учун белгиланган кушимча йигим туловини амалга ошириш тУгрисидаги 2-сонли шартнома</h1>";
        $clientInfo = "<p>Client Name: " . $clientData->first_name . " " . $clientData->last_name . "</p>";
        $clientInfo .= "<p>Company Name: " . $clientData->company_name . "</p>";
        // Add more client-related data as needed
        
        $step_0 = "<p>”Тошкент Инвест компанияси” акциядорлик жамияти (кейинги Уринларда  Компания) номидан Устав асосида иш юритувчи Компания Бошкарув раиси Шакиров Б.А бир тарафдан, Закирова Фарохат Синатуллаевна (кейинги Уринларда — Инвестор) номидан устав асосида иш юритувчи Закирова Фарохат Синатуллаевна, иккинчи тарафдан, биргаликда Тарафлар, алохида эса Тараф деб номланувчилар мазкур шартномани Узбекистон Республикаси Президентининг 2023 йил 26 июлдаги ПК-236-сон “Тошкент шахрида давлат ва тадбиркорлик субъектлари Уртасида узаро манфаатли хамкорлик асосида инвестиция лойихаларини амалга ошириш ва шахар инфратузилмасини яхшилаш бУйича хукукий экспериментни утказиш чора-тадбирлари тугрисида”ги карори, Вазирлар Махкамасининг 2024 йил 25 мартдаги 149-сон карори билан тасдикланган ”Тошкент гпахрида мухандислик-коммуникация тармоклари ва транспорт инфратузилмасини яратиш  харажатларининг бир кисмини шахарсозлик фаолияти объектини куриш ёки реконструкция килишни лойихалаштириш учун архитектура-режалаштириш топширигини ишлаб чикиш бУйича тулов кийматига киритиш тартиби тУгрисида”ги низом асосида куйидагилар хакида имзоладилар:</p>";
        $title_0 = "1. Шартнома предмети";
        $step_1 = "<p>1.1. Компания Узбекистон Республикаси Президентининг 2023 йил 26 июлдаги ”Тошкент шахрини 2030 йилга кадар ижтимоий-иктисодий ривожлантириш чора-тадбирлари тУгрисида”ги ПФ-112-сон Фармонига мувофик Тошкент шахри хокимлиги хузуридаги Тошкент шахрини ривожлантириш жамгармаси (кейинги Уринларда Жамгарма) маблагларини тасарруф этиш, хисоби ва хисоботини юритиш ваколати асосида мазкур шартномага мувофик, бинонинг (иншоотнинг) каватлар сони белгиланган параметрлардан оширилганда кушимча курилишига архитектура-режалаштириш топшириги (кеЙинги Уринларда — АРТ) берилиши учун белгиланган кУшимча йигим (кейинги Уринларда — Иигим) тулови Жамгарма томонидан мазкур шартнома асосида уз вактида кабул килиб олинишини ташкил КИЛИШ, Инвестор эса мазкур шартномада белгиланган Иигим туловини тегишли муддатларда ва хажмларда амалга ошириш мажбуриятини олади.</p>";
        $title_1 = "Иигим тулови микдори, тулаш муддатлари ва шартлари";
        $step_2 = "<p>2.1. Иигим микдори Узбекистон Республикаси Президентћнинг 2023 йил 26 июлдаги ПК-236-сон ”Тошкент шахрида давлат ва тадбиркорлик субъектлари Уртасида узаро манфаатли хамкорлик асосида инвестиция лойихаларини амалга ошириш ва шахар инфратузилмасини яхшилаш бУйича хукукий экспериментни утказиш чора-тадбирлари тУгрисида”ги карори хамда Вазирлар Махкамасинининг 2024 йил 25 мартдаги 149-сон карори билан тасдикланган ”Тошкент шахрида мухандислик-коммуникация тармоклари ва транспорт инфратузилмасини яратиш харажатларининг бир кисмини шахарсозлик фаолияти объектини куриш ёки реконструкция килишни лойихалаштириш учун АРТни ишлаб чикиш бУйича тулов кийматига киритиш тартиби тУгрисида”ги низомга мувофик, жами курилиш хажмининг хар бир куб метри учун базавий хисоблаш микдорининг 1 баравари микдорида хамда АРТ берилган лойихавий бино (ИНШООТ) каватлар сони белгиланган параметрлардан оширилганлиги юзасидан лойиха-смета хужжатлари экспертиза хулосаси асосида хисоблаб чикилган ва 6360 (олти минг уч юз олтимуш) куб метр хажм учун 2.162.400.000 (икки миллиард бир юз олтимуш икки миллион турт юз минг ) сумни ташкил этади.</p>";
        $step_3 = "<p>2.2. Инвестор йигим микдорини тулик хажмда Жамгарма хисоб ракамига утказиш йУли билан куйидаги тартибда тУланади: — 20 (йигирма) фоизи 432.480.000 (турт юз уттиз икки миллион турт юз саксон минг) сум микдоридаги олдиндан туловни мазкур шартнома имзоланган санадан бошлаб З (уч) иш кунидан кечиктирмаган холда амалга оширади; — йигимнинг колган 80 (саксон) фоизи 1.729.920.000 (бир миллиард йетти юз йигирма туккиз миллион туккиз юз йигирма минг) сум микдордаги къшимча туловни куп каватли турар жой биноси (иншооти) куриб битказилгунга кадар, аммо 2023 йил 1 ноябрдан кечиктирмасдан куйидаги мухлатларда амалга оширади.</p>";
        $step_4 = "<p>2.3. Иигимнинг колган 80 (саксон) фоизини тулашда Инвестор тУловларни икки хил шаклда амалга ошириши мумкин: — уз маблаглари хисобидан ёки — Жамгарманинг ваколатли тижорат банки (кейинги Уринларда — Банк) оркали къшимча кафиллик хати олиш йУли билан. Къшимча кафиллик хати асосида Жамгарма, Инвестор ва Банк ушбу шартномада назарда тутилган харакатларни амалга оширадилар.</p>";
        $step_5 = "<p>2.4. Инвестор томонидан Йигим суммаси тУланганидан сунг куйидаги холатларда Иигим суммаси тУланган хажми кайтарилмайди: — Инвесторга нисбатан амалдаги конунчилик хужжатларида белгиланган тартибга мувофик банкротлик тартиботи жорий килинганида; — Инвестор уз хохишига ва (ёки) суд карорига кура тугатилган хамда фаолияти вактинчалик тухтатиб турилганда; — Инвестор уз хохишига, суд карори ёки хукук-тартибот органларининг талабига кура АРТ берилган лойихавий бинонинг (ИНШООТНИНГ) курилишини тУхтатганда ва (ёки) курилишидан воз кечганда; — Инвестор уз хохишига, суд карори ёки хукук-тартибот органларининг талабига кура АРТ берилган лойихавий бинога (иншоотга) бУлган хукукларни хар кандай усул билан бошка шахсларга Утказганда, топширганда ёки бошка шахсларнинг фойдасига воз кечганда; — Иигим тулаш мажбурияти бажарилиши билан боглик бУлган хар кандай мажбуриятлари бажарилмаган бошка лолларда.</p>";
    
        // Add HTML content to the section with styling
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $main, false, false);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $clientInfo, false, false);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<h2>' . $title_0 . '</h2>', false, false);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $step_0, false, false);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<h2>' . $title_1 . '</h2>', false, false);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $step_1, false, false);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<h2>' . $title_1 . '</h2>', false, false);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $step_2, false, false);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $step_3, false, false);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $step_4, false, false);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $step_5, false, false);
    
        // Create the writer
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    
        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
            // Handle the exception if needed
        }
    
        return response()->download(storage_path('helloWorld.docx'));
    }
    
    
}
