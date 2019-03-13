<?php
/**
 * @author Amin Mahmoudi (MasterkinG)
 * @copyright	Copyright (c) 2019 - 2022, MsaterkinG32 Team, Inc. (https://masterking32.com)
 * @link	https://masterking32.com
 * @Description : It's not masterking32 framework !
 **/
$error_msg = "";
$success_msg = "";
function get_config($name)
{
    global $config;
    if(!empty($name))
    {
        if(isset($config[$name]))
        {
            return $config[$name];
        }
    }
    return false;
}
function RandomNameGenerator($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return ucfirst($randomString);
}

function error_msg($input = false)
{
    global $error_error;
    if(!empty($error_error))
    {
        echo "<p class=\"alert alert-danger\">$error_error</p>";
    }elseif(!empty($input))
    {
        $error_error = $input;
    }
}
function success_msg($input = false)
{
    global $success_msg;
    if(!empty($success_msg))
    {
        echo "<p class=\"alert alert-success\">$success_msg</p>";
    }elseif(!empty($input))
    {
        $success_msg = $input;
    }
}
function GetRaceID($race)
{
    switch( $race )
    {
        case "HUMAN":
            return 1;
        case "ORC":
            return 2;
        case "DWARF":
            return 3;
        case "NIGHTELF":
            return 4;
        case "SCOURGE":
            return 5;
        case "TAUREN":
            return 6;
        case "GNOME":
            return 7;
        case "TROLL":
            return 8;
        case "BLOODELF":
            return 10;
        case "DRAENEI":
            return 11;
        default:
            exit( "error" );
    }
}
function GetClassID($class)
{
    switch( $class )
    {
        case "WARRIOR":
            return 1;
        case "PALADIN":
            return 2;
        case "HUNTER":
            return 3;
        case "ROGUE":
            return 4;
        case "PRIEST":
            return 5;
        case "DEATHKNIGHT":
            return 6;
        case "SHAMAN":
            return 7;
        case "MAGE":
            return 8;
        case "WARLOCK":
            return 9;
        case "DRUID":
            return 11;
        default:
            exit( "<br>YOUR CHARACTER CLASS IS NOT BLIZZLIKE FOR 3.3.5a<br>" );
    }
}

function GetSkillID($skill, $locale)
{
    switch( $locale )
    {
        case "FRFR":
            switch( $skill )
            {
                case "EPÉES":
                    return 43;
                case "HACHES":
                    return 44;
                case "ARCS":
                    return 45;
                case "ARMES À FEU":
                    return 46;
                case "MASSE":
                    return 54;
                case "EPÉES À DEUX MAINS":
                    return 55;
                case "DÉFENSE":
                    return 95;
                case "SECOURISME":
                    return 129;
                case "BÂTONS":
                    return 136;
                case "MASSES À DEUX MAINS":
                    return 160;
                case "MAINS NUES":
                    return 162;
                case "FORGE":
                    return 164;
                case "TRAVAIL DU CUIR":
                    return 165;
                case "ALCHIMIE":
                    return 171;
                case "HACHES À DEUX MAINS":
                    return 172;
                case "DAGUES":
                    return 173;
                case "ARMES DE JET":
                    return 176;
                case "HERBORISTERIE":
                    return 182;
                case "CUISINE":
                    return 185;
                case "MINAGE":
                    return 186;
                case "COUTURE":
                    return 197;
                case "INGÉNIERIE":
                    return 202;
                case "ARBALÈTES":
                    return 226;
                case "BAGUETTES":
                    return 228;
                case "ARMES D'HAST":
                    return 229;
                case "ARMURE EN PLAQUES":
                    return 293;
                case "ENCHANTEMENT":
                    return 333;
                case "PÊCHE":
                    return 356;
                case "DÉPEÇAGE":
                    return 393;
                case "MAILLES":
                    return 413;
                case "CUIR":
                    return 414;
                case "TISSU":
                    return 415;
                case "BOUCLIER":
                    return 433;
                case "ARMES DE PUGILAT":
                    return 473;
                case "CROCHETAGE":
                    return 633;
                case "JOAILLERIE":
                    return 755;
                case "CALLIGRAPHIE":
                    return 773;
                case "RUNEFORGER":
                    return 776;
                default:
                    return -1;
            }
    }
    switch( $locale )
    {
        case "DEDE":
            switch( $skill )
            {
                case "SCHWERTER":
                    return 43;
                case "AXTE":
                    return 44;
                case "BOGEN":
                    return 45;
                case "SCHUSSWAFFEN":
                    return 46;
                case "STREITKOLBEN":
                    return 54;
                case "ZWEIHANDSCHWERTER":
                    return 55;
                case "VERTEIDIGUNG":
                    return 95;
                case "ERSTE HILFE":
                    return 129;
                case "STABE":
                    return 136;
                case "ZWEIHANDSTREITKOLBEN":
                    return 160;
                case "UNBEWAFFNET":
                    return 162;
                case "SCHMIEDEKUNST":
                    return 164;
                case "LEDERVERARBEITUNG":
                    return 165;
                case "ALCHEMIE":
                    return 171;
                case "ZWEIHANDAXTE":
                    return 172;
                case "DOLCHE":
                    return 173;
                case "WURFWAFFEN":
                    return 176;
                case "KRAUTERKUNDE":
                    return 182;
                case "KOCHKUNST":
                    return 185;
                case "BERGBAU":
                    return 186;
                case "SCHNEIDEREI":
                    return 197;
                case "INGENIEURSKUNST":
                    return 202;
                case "ARMBRUSTE":
                    return 226;
                case "ZAUBERSTABE":
                    return 228;
                case "STANGENWAFFEN":
                    return 229;
                case "PLATTENPANZER":
                    return 293;
                case "VERZAUBERKUNST":
                    return 333;
                case "ANGELN":
                    return 356;
                case "KURSCHNEREI":
                    return 393;
                case "SCHWERE RUSTUNG":
                    return 413;
                case "LEDER":
                    return 414;
                case "STOFF":
                    return 415;
                case "SCHILD":
                    return 433;
                case "FAUSTWAFFEN":
                    return 473;
                case "SCHLOSSKNACKEN":
                    return 633;
                case "JUWELENSCHLEIFEN":
                    return 755;
                case "INSCHRIFTENKUNDE":
                    return 773;
                case "RUNEN SCHMIEDEN":
                    return 776;
                default:
                    return -1;
            }
    }
    switch( $locale )
    {
        case "RURU":
            switch( $skill )
            {
                case "МЕЧИ":
                    return 43;
                case "ТОПОРЫ":
                    return 44;
                case "ЛУКИ":
                    return 45;
                case "ОГНЕСТРЕЛЬНОЕ ОРУЖИЕ":
                    return 46;
                case "ДРОБЯЩЕЕ ОРУЖИЕ":
                    return 54;
                case "ДВУРУЧНЫЕ МЕЧИ":
                    return 55;
                case "ЗАЩИТА":
                    return 95;
                case "ПЕРВАЯ ПОМОЩЬ":
                    return 129;
                case "ПОСОХИ":
                    return 136;
                case "ДВУРУЧНОЕ ДРОБЯЩЕЕ ОРУЖИЕ":
                    return 160;
                case "РУКОПАШНЫЙ БОЙ":
                    return 162;
                case "КУЗНЕЧНОЕ ДЕЛО":
                    return 164;
                case "КОЖЕВНИЧЕСТВО":
                    return 165;
                case "АЛХИМИЯ":
                    return 171;
                case "ДВУРУЧНЫЕ ТОПОРЫ":
                    return 172;
                case "КИНЖАЛЫ":
                    return 173;
                case "МЕТАТЕЛЬНОЕ ОРУЖИЕ":
                    return 176;
                case "ТРАВНИЧЕСТВО":
                    return 182;
                case "КУЛИНАРИЯ":
                    return 185;
                case "ГОРНОЕ ДЕЛО":
                    return 186;
                case "ПОРТНЯЖНОЕ ДЕЛО":
                    return 197;
                case "ИНЖЕНЕРНОЕ ДЕЛО":
                    return 202;
                case "АРБАЛЕТЫ":
                    return 226;
                case "ЖЕЗЛЫ":
                    return 228;
                case "ДРЕВКОВОЕ ОРУЖИЕ":
                    return 229;
                case "ЛАТЫ":
                    return 293;
                case "НАЛОЖЕНИЕ ЧАР":
                    return 333;
                case "РЫБНАЯ ЛОВЛЯ":
                    return 356;
                case "СНЯТИЕ ШКУР":
                    return 393;
                case "КОЛЬЧУЖНЫЕ ДОСПЕХИ":
                    return 413;
                case "КОЖАНЫЕ ДОСПЕХИ":
                    return 414;
                case "ТКАНЕВЫЕ ДОСПЕХИ":
                    return 415;
                case "ЩИТ":
                    return 433;
                case "КИСТЕВОЕ ОРУЖИЕ":
                    return 473;
                case "ВЗЛОМ":
                    return 633;
                case "ЮВЕЛИРНОЕ ДЕЛО":
                    return 755;
                case "НАЧЕРТАНИЕ":
                    return 773;
                case "КОВКА РУН":
                    return 776;
                default:
                    return -1;
            }
    }
    switch( $locale )
    {
        case "ESES":
            switch( $skill )
            {
                case "ESPADAS":
                    return 43;
                case "HACHAS":
                    return 44;
                case "ARCOS":
                    return 45;
                case "ARMAS DE FUEGO":
                    return 46;
                case "MAZAS":
                    return 54;
                case "ESPADAS DE DOS MANOS":
                    return 55;
                case "DEFENSA":
                    return 95;
                case "PRIMEROS AUXILIOS":
                    return 129;
                case "BASTONES":
                    return 136;
                case "MAZAS DE DOS MANOS":
                    return 160;
                case "SIN ARMAS":
                    return 162;
                case "HERRERÍA":
                    return 164;
                case "PELETERÍA":
                    return 165;
                case "ALQUIMIA":
                    return 171;
                case "HACHAS DE DOS MANOS":
                    return 172;
                case "DAGAS":
                    return 173;
                case "ARMAS ARROJADIZAS":
                    return 176;
                case "HERBORISTERÍA":
                    return 182;
                case "COCINA":
                    return 185;
                case "MINERÍA":
                    return 186;
                case "SASTRERÍA":
                    return 197;
                case "INGENIERÍA":
                    return 202;
                case "BALLESTAS":
                    return 226;
                case "VARITAS":
                    return 228;
                case "ARMAS DE ASTA":
                    return 229;
                case "MALLA DE PLACAS":
                    return 293;
                case "ENCANTAMIENTO":
                    return 333;
                case "PESCA":
                    return 356;
                case "DESOLLAR":
                    return 393;
                case "MALLA":
                    return 413;
                case "CUERO":
                    return 414;
                case "TELA":
                    return 415;
                case "ESCUDO":
                    return 433;
                case "ARMAS DE PUÑO":
                    return 473;
                case "GANZÚA":
                    return 633;
                case "JOYERÍA":
                    return 755;
                case "INSCRIPCIÓN":
                    return 773;
                case "FORJA DE RUNAS":
                    return 776;
                default:
                    return -1;
            }
    }
    switch( $locale )
    {
        case "ENUS":
        case "ENGB":
            switch( $skill )
            {
                case "SWORDS":
                    return 43;
                case "AXES":
                    return 44;
                case "BOWS":
                    return 45;
                case "GUNS":
                    return 46;
                case "MACES":
                    return 54;
                case "TWO-HANDED SWORDS":
                    return 55;
                case "DEFENSE":
                    return 95;
                case "FIRST AID":
                    return 129;
                case "STAVES":
                    return 136;
                case "TWO-HANDED MACES":
                    return 160;
                case "UNARMED":
                    return 162;
                case "BLACKSMITHING":
                    return 164;
                case "LEATHERWORKING":
                    return 165;
                case "ALCHEMY":
                    return 171;
                case "TWO-HANDED AXES":
                    return 172;
                case "DAGGERS":
                    return 173;
                case "THROWN":
                    return 176;
                case "HERBALISM":
                    return 182;
                case "COOKING":
                    return 185;
                case "MINING":
                    return 186;
                case "TAILORING":
                    return 197;
                case "ENGINEERING":
                    return 202;
                case "CROSSBOWS":
                    return 226;
                case "WANDS":
                    return 228;
                case "POLEARMS":
                    return 229;
                case "PLATE MAIL":
                    return 293;
                case "ENCHANTING":
                    return 333;
                case "FISHING":
                    return 356;
                case "SKINNING":
                    return 393;
                case "MAIL":
                    return 413;
                case "LEATHER":
                    return 414;
                case "CLOTH":
                    return 415;
                case "SHIELD":
                    return 433;
                case "FIST WEAPONS":
                    return 473;
                case "LOCKPICKING":
                    return 633;
                case "JEWELCRAFTING":
                    return 755;
                case "INSCRIPTION":
                    return 773;
                case "RUNEFORGING":
                    return 776;
                default:
                    return -1;
            }
    }
}

function parse_chardump($file_loc)
{
    @$chardump_data = file_get_contents($file_loc);
    @$chardump_data = str_replace('CHD_CLIENT = "','',$chardump_data);
    @$chardump_data = str_replace('"','',$chardump_data);
    @$chardump_decoded = base64_decode($chardump_data);
    @$chardump_json = json_decode($chardump_decoded, true);
    $char_data = array();
    if(!empty($chardump_json))
    {
        if(!empty($chardump_json["player"]["name"]))
        {
            $char_data["honor"] = (!empty($chardump_json["player"]["honor"]) ? $chardump_json["player"]["honor"] : 0);
            $char_data["kills"] = (!empty($chardump_json["player"]["kills"]) ? $chardump_json["player"]["kills"] : 0);
            $char_data["level"] = (!empty($chardump_json["player"]["level"]) ? $chardump_json["player"]["level"] : 0);
            $char_data["name"] = (!empty($chardump_json["player"]["name"]) ? $chardump_json["player"]["name"] : "DumpChar");
            $char_data["race"] = (!empty($chardump_json["player"]["race"]) ? strtoupper($chardump_json["player"]["race"]) : "BLOODELF");
            $char_data["raceid"] = GetRaceID($char_data["race"]);
            $char_data["class"] = (!empty($chardump_json["player"]["class"]) ? strtoupper($chardump_json["player"]["class"]) : "PALADIN");
            $char_data["classid"] = GetClassID($char_data["class"]);
            $char_data["money"] = (!empty($chardump_json["player"]["money"]) ? strtoupper($chardump_json["player"]["money"]) : "PALADIN");
            $char_data["locale"] = (!empty($chardump_json["global"]["locale"]) ? $chardump_json["global"]["locale"] : "enUS");
            $char_data["realmlist"] = (!empty($chardump_json["global"]["realmlist"]) ? $chardump_json["global"]["realmlist"] : "realmlist");
            $char_data["createtime"] = (!empty($chardump_json["global"]["createtime"]) ? $chardump_json["global"]["createtime"] : "1500000000");
            $char_data["clientbuild"] = (!empty($chardump_json["global"]["clientbuild"]) ? $chardump_json["global"]["clientbuild"] : "123");
            $char_data["realm"] = (!empty($chardump_json["global"]["realm"]) ? $chardump_json["global"]["realm"] : "NONE");
            $char_data["gender"] = (!empty($chardump_json["player"]["gender"]) ? ($chardump_json["player"]["gender"] - 2 == 1 ? 1 : 0) : 0);
            $char_data["title"] = array();
            if(!empty($chardump_json["title"]))
            {
                foreach($chardump_json["title"] as $title_value)
                {
                    $char_data["title"][] = $title_value;
                }
            }
            $char_data["bank_items"] = array();
            if(!empty($chardump_json["bank"]))
            {
                foreach($chardump_json["bank"] as $bank_bag)
                {
                    foreach($bank_bag as $bank_bag_item)
                    {
                        if(!empty($bank_bag_item["I"]))
                        {
                            $item_array["id"] = $bank_bag_item["I"];
                            $item_array["count"] = 1;
                            if(!empty($bank_bag_item["N"]))
                            {
                                $item_array["count"] = $bank_bag_item["N"];
                            }
                            $char_data["bank_items"][] = $item_array;
                        }
                    }
                }
            }
            $char_data["inventory"] = array();
            if(!empty($chardump_json["inventory"]))
            {
                foreach($chardump_json["inventory"] as $inventory_item)
                {
                    if(!empty($inventory_item["I"]))
                    {
                        $item_array["id"] = $inventory_item["I"];
                        $item_array["count"] = 1;
                        if(!empty($inventory_item["N"]))
                        {
                            $item_array["count"] = $inventory_item["N"];
                        }
                        $char_data["inventory"][] = $item_array;
                    }
                }
            }
            $char_data["bag"] = array();
            if(!empty($chardump_json["bag"]))
            {
                foreach($chardump_json["bag"] as $bag_item)
                {
                    foreach($bag_item as $a_bag_item)
                    {
                        if(!empty($a_bag_item["I"]))
                        {
                            $item_array["id"] = $a_bag_item["I"];
                            $item_array["count"] = 1;
                            if(!empty($a_bag_item["N"]))
                            {
                                $item_array["count"] = $a_bag_item["N"];
                            }
                            $char_data["bag"][] = $item_array;
                        }
                    }
                }
            }
            $char_data["currency"] = array();
            if(!empty($chardump_json["currency"]))
            {
                foreach($chardump_json["currency"] as $currency_item => $currency_count)
                {
                    if(!empty($currency_item) && !empty($currency_count))
                    {
                        $item_array["id"] = $currency_item;
                        $item_array["count"] = $currency_count;
                        $char_data["currency"][] = $item_array;
                    }
                }
            }
            $char_data["mounts"] = array();
            if(!empty($chardump_json["mount"]))
            {
                foreach($chardump_json["mount"] as $mount)
                {
                    if(!empty($mount))
                    {
                        $char_data["mounts"][] = $mount;
                    }
                }
            }
            return $char_data;
        }
    }
    return false;
}
function RemoteCommandWithSOAP($realmid, $COMMAND) {
    $realmlist = get_config('realmlists');
    $conn = new SoapClient(NULL, array(
        'location' => "http://".$realmlist[$realmid]['soap_host'].":".$realmlist[$realmid]['soap_port']."/",
        'uri'      => $realmlist[$realmid]['soap_uri'],
        'style'    => SOAP_RPC,
        'login'    => $realmlist[$realmid]['soap_user'],
        'password' => $realmlist[$realmid]['soap_pass']
    ));
    try
    {
        $conn->executeCommand(new SoapParam($COMMAND, 'command'));
    } catch (Exception $e) {
        //die("Something went wrong! An administrator has been noticed and will send your order as soon as possible.");
    }
    unset($conn);
}