<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $fakedata = '[{
            "name": "Fran Ellsbury",
            "email": "fellsbury0@reddit.com",
            "address": "06 Sherman Street",
            "mobile": "6156143635",
            "scheme_id": "5095739828",
            "lat": -6.8843479,
            "lng": 108.7927679
          }, {
            "name": "Antonino Gentile",
            "email": "agentile1@geocities.jp",
            "address": "9823 Meadow Ridge Hill",
            "mobile": "4805780855",
            "scheme_id": "2308650419",
            "lat": 40.767544,
            "lng": 114.886335
          }, {
            "name": "Quillan Castagne",
            "email": "qcastagne2@networkadvertising.org",
            "address": "585 Fulton Way",
            "mobile": "5741412729",
            "scheme_id": "8466607188",
            "lat": 56.0488224,
            "lng": 39.0652818
          }, {
            "name": "Fidel Harbage",
            "email": "fharbage3@aboutads.info",
            "address": "914 Fairfield Trail",
            "mobile": "2424271977",
            "scheme_id": "7199949049",
            "lat": -22.5698961,
            "lng": -49.0817124
          }, {
            "name": "Veradis Rathe",
            "email": "vrathe4@disqus.com",
            "address": "1855 Ridgeway Place",
            "mobile": "6574836203",
            "scheme_id": "0122979303",
            "lat": 9.97788,
            "lng": -84.762933
          }, {
            "name": "Nannie Tenney",
            "email": "ntenney5@imdb.com",
            "address": "0048 Forest Plaza",
            "mobile": "3792432026",
            "scheme_id": "8411461637",
            "lat": 12.4537943,
            "lng": 102.2290442
          }, {
            "name": "Elli Ellse",
            "email": "eellse6@people.com.cn",
            "address": "32874 Crescent Oaks Avenue",
            "mobile": "3662445368",
            "scheme_id": "4535613354",
            "lat": 42.58063,
            "lng": 20.31619
          }, {
            "name": "Chicky Rubinovitch",
            "email": "crubinovitch7@histats.com",
            "address": "127 Riverside Crossing",
            "mobile": "8249027059",
            "scheme_id": "5779662134",
            "lat": 43.3755098,
            "lng": 16.6309128
          }, {
            "name": "Barri Rowswell",
            "email": "browswell8@printfriendly.com",
            "address": "3 Sundown Avenue",
            "mobile": "7752860397",
            "scheme_id": "2662294175",
            "lat": 14.871038,
            "lng": -24.6949966
          }, {
            "name": "Gilberta Rackley",
            "email": "grackley9@uiuc.edu",
            "address": "839 Nelson Alley",
            "mobile": "3463340740",
            "scheme_id": "1354061004",
            "lat": -8.6212427,
            "lng": 122.5146439
          }, {
            "name": "Brandtr Shinn",
            "email": "bshinna@moonfruit.com",
            "address": "5486 Sage Pass",
            "mobile": "8125647284",
            "scheme_id": "1859464335",
            "lat": 33.8446231,
            "lng": 36.5499837
          }, {
            "name": "Jany Morey",
            "email": "jmoreyb@princeton.edu",
            "address": "14179 Di Loreto Park",
            "mobile": "7965381816",
            "scheme_id": "3753469971",
            "lat": 14.6287391,
            "lng": 121.0577928
          }, {
            "name": "Wilow Domone",
            "email": "wdomonec@wordpress.com",
            "address": "69 Gerald Circle",
            "mobile": "6232275886",
            "scheme_id": "8975189619",
            "lat": 29.391849,
            "lng": 118.031547
          }, {
            "name": "Philippe Doeg",
            "email": "pdoegd@dailymotion.com",
            "address": "33925 Bowman Hill",
            "mobile": "3936401924",
            "scheme_id": "1439311129",
            "lat": 36.304147,
            "lng": 139.978334
          }, {
            "name": "Karlan Eisenberg",
            "email": "keisenberge@cloudflare.com",
            "address": "49 Old Shore Park",
            "mobile": "3234441614",
            "scheme_id": "5813941746",
            "lat": 41.2471491,
            "lng": 71.5427212
          }, {
            "name": "Melitta McHarry",
            "email": "mmcharryf@livejournal.com",
            "address": "29 Quincy Plaza",
            "mobile": "2895383246",
            "scheme_id": "1021237108",
            "lat": 45.2879358,
            "lng": -72.1547927
          }, {
            "name": "Enid Gritten",
            "email": "egritteng@rediff.com",
            "address": "432 Forest Crossing",
            "mobile": "3706081699",
            "scheme_id": "2441981412",
            "lat": 18.278467,
            "lng": 100.179649
          }, {
            "name": "Corny Faiers",
            "email": "cfaiersh@hc360.com",
            "address": "58382 Magdeline Place",
            "mobile": "4578270220",
            "scheme_id": "6884167599",
            "lat": 5.799059,
            "lng": -75.907993
          }, {
            "name": "Zebulen Bancroft",
            "email": "zbancrofti@census.gov",
            "address": "33 Dottie Junction",
            "mobile": "3062509343",
            "scheme_id": "0499962443",
            "lat": 58.4705978,
            "lng": 41.5474702
          }, {
            "name": "Kessiah Sumption",
            "email": "ksumptionj@usatoday.com",
            "address": "6535 Havey Crossing",
            "mobile": "4477110185",
            "scheme_id": "1226254888",
            "lat": 50.4351008,
            "lng": 15.2414232
          }, {
            "name": "Fara Akitt",
            "email": "fakittk@booking.com",
            "address": "4039 Washington Road",
            "mobile": "7939395930",
            "scheme_id": "5548121790",
            "lat": 28.225095,
            "lng": 116.549282
          }, {
            "name": "Franklyn Sweetmore",
            "email": "fsweetmorel@xrea.com",
            "address": "63 Magdeline Trail",
            "mobile": "1846208090",
            "scheme_id": "8107763807",
            "lat": 29.237137,
            "lng": 91.773134
          }, {
            "name": "Etheline Guiett",
            "email": "eguiettm@adobe.com",
            "address": "5873 Saint Paul Hill",
            "mobile": "8739359613",
            "scheme_id": "5531605153",
            "lat": 54.632212,
            "lng": 23.9452683
          }, {
            "name": "Oralee Kearns",
            "email": "okearnsn@baidu.com",
            "address": "505 Bunker Hill Court",
            "mobile": "8986665656",
            "scheme_id": "9943808276",
            "lat": 57.8512804,
            "lng": 45.7788684
          }, {
            "name": "Arny O\' Culligan",
            "email": "aoo@buzzfeed.com",
            "address": "7 Oriole Circle",
            "mobile": "3794894689",
            "scheme_id": "9993483044",
            "lat": 4.693039,
            "lng": -73.51997
          }, {
            "name": "Cos Dodding",
            "email": "cdoddingp@squidoo.com",
            "address": "10 Blaine Crossing",
            "mobile": "2564038741",
            "scheme_id": "0580970299",
            "lat": 13.9051904,
            "lng": -89.5002027
          }, {
            "name": "Nicoline Knowling",
            "email": "nknowlingq@webs.com",
            "address": "3 Del Mar Place",
            "mobile": "1169774326",
            "scheme_id": "6497325808",
            "lat": -17.5969817,
            "lng": -44.7267221
          }, {
            "name": "Creight Holdron",
            "email": "choldronr@census.gov",
            "address": "143 Trailsway Hill",
            "mobile": "5203296251",
            "scheme_id": "1344729371",
            "lat": 37.4449168,
            "lng": 127.1388684
          }, {
            "name": "Merrill Trevethan",
            "email": "mtrevethans@feedburner.com",
            "address": "8 Fuller Pass",
            "mobile": "7886967151",
            "scheme_id": "7339736085",
            "lat": 54.9173747,
            "lng": 73.4361761
          }, {
            "name": "Arlen Goodlett",
            "email": "agoodlettt@wired.com",
            "address": "8361 5th Point",
            "mobile": "6442390975",
            "scheme_id": "1841455105",
            "lat": 54.9907148,
            "lng": 36.2483787
          }, {
            "name": "Munmro Fossitt",
            "email": "mfossittu@g.co",
            "address": "72482 Debs Drive",
            "mobile": "7387378833",
            "scheme_id": "1640840850",
            "lat": -6.8008183,
            "lng": 107.1781769
          }, {
            "name": "Locke Sessuns",
            "email": "lsessunsv@wiley.com",
            "address": "186 Calypso Circle",
            "mobile": "3933995592",
            "scheme_id": "6919532352",
            "lat": -13.8117019,
            "lng": -171.940524
          }, {
            "name": "Dorri Kerford",
            "email": "dkerfordw@mapy.cz",
            "address": "24721 Emmet Avenue",
            "mobile": "3333921724",
            "scheme_id": "7713815767",
            "lat": 9.016675,
            "lng": -10.59317
          }, {
            "name": "Cazzie Lodge",
            "email": "clodgex@blinklist.com",
            "address": "9 Kingsford Place",
            "mobile": "8554518782",
            "scheme_id": "5917720312",
            "lat": 15.3775935,
            "lng": -88.0240796
          }, {
            "name": "Gaylene Raun",
            "email": "grauny@altervista.org",
            "address": "2 Westend Court",
            "mobile": "8126799757",
            "scheme_id": "1406630470",
            "lat": 36.6512,
            "lng": 117.120095
          }, {
            "name": "Marcy Heinke",
            "email": "mheinkez@macromedia.com",
            "address": "24 Almo Parkway",
            "mobile": "9646647796",
            "scheme_id": "6832946767",
            "lat": 48.294118,
            "lng": 4.0675057
          }, {
            "name": "Purcell Lowen",
            "email": "plowen10@alibaba.com",
            "address": "22 Banding Plaza",
            "mobile": "2154479191",
            "scheme_id": "7266018552",
            "lat": 53.5862715,
            "lng": 16.3876584
          }, {
            "name": "Delcina McLaine",
            "email": "dmclaine11@nytimes.com",
            "address": "31 Nova Way",
            "mobile": "1216365276",
            "scheme_id": "6591049312",
            "lat": 43.363668,
            "lng": 88.311099
          }, {
            "name": "Eugene Monget",
            "email": "emonget12@microsoft.com",
            "address": "77393 Prairieview Park",
            "mobile": "4064736160",
            "scheme_id": "0773621318",
            "lat": 59.9477092,
            "lng": 10.8219787
          }, {
            "name": "Eyde Cellier",
            "email": "ecellier13@chronoengine.com",
            "address": "9368 Washington Avenue",
            "mobile": "3806280207",
            "scheme_id": "2690907712",
            "lat": 34.2869441,
            "lng": -4.6605581
          }, {
            "name": "Alfred Connerly",
            "email": "aconnerly14@dedecms.com",
            "address": "619 Hermina Hill",
            "mobile": "2409299034",
            "scheme_id": "6518225947",
            "lat": 26.648393,
            "lng": 110.153093
          }, {
            "name": "Cleo Harbron",
            "email": "charbron15@apple.com",
            "address": "650 Grayhawk Point",
            "mobile": "5295889253",
            "scheme_id": "6762072356",
            "lat": -0.677334,
            "lng": 34.779603
          }, {
            "name": "Clem Woolmer",
            "email": "cwoolmer16@answers.com",
            "address": "4 Dayton Park",
            "mobile": "8553665741",
            "scheme_id": "2297849648",
            "lat": 22.951554,
            "lng": 112.10915
          }, {
            "name": "Emyle Geldeard",
            "email": "egeldeard17@yahoo.com",
            "address": "9130 Sheridan Court",
            "mobile": "8721697977",
            "scheme_id": "2750232589",
            "lat": -6.235617,
            "lng": 38.693748
          }, {
            "name": "Quinn Palfreman",
            "email": "qpalfreman18@pinterest.com",
            "address": "21694 Armistice Hill",
            "mobile": "6019450566",
            "scheme_id": "9434991927",
            "lat": 43.247343,
            "lng": 0.06251
          }, {
            "name": "Tillie Wilkison",
            "email": "twilkison19@webs.com",
            "address": "1 Gateway Center",
            "mobile": "7936509800",
            "scheme_id": "2403773573",
            "lat": 4.974252,
            "lng": -74.291386
          }, {
            "name": "Archie Brownrigg",
            "email": "abrownrigg1a@theglobeandmail.com",
            "address": "4233 Fairfield Center",
            "mobile": "6598720873",
            "scheme_id": "5799273907",
            "lat": -7.3268042,
            "lng": 108.7971149
          }, {
            "name": "Mair Chicco",
            "email": "mchicco1b@ebay.co.uk",
            "address": "1653 Sachtjen Pass",
            "mobile": "1296250144",
            "scheme_id": "6034513278",
            "lat": 50.4217341,
            "lng": 2.8830762
          }, {
            "name": "Anson Sesons",
            "email": "asesons1c@tinypic.com",
            "address": "4362 Eliot Circle",
            "mobile": "1652024685",
            "scheme_id": "2875897527",
            "lat": -6.2736138,
            "lng": 106.6717451
          }, {
            "name": "Jerald Stawell",
            "email": "jstawell1d@mtv.com",
            "address": "32 Oak Crossing",
            "mobile": "9993019397",
            "scheme_id": "9866003957",
            "lat": 10.5308066,
            "lng": 105.1609838
          }]';

          $clientsArr = json_decode($fakedata, true);

        for($i = 0; $i < 50; $i++){
            DB::table('clients')->insert([
                'name' => $clientsArr[$i]['name'],
                'email' => $clientsArr[$i]['email'],
                'address' => $clientsArr[$i]['address'],
                'mobile' => $clientsArr[$i]['mobile'],
                'scheme_id' => $clientsArr[$i]['scheme_id'],
                'lat' => $clientsArr[$i]['lat'],
                'lng' => $clientsArr[$i]['lng']
            ]);
          }
    }
}
