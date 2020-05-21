<?php


namespace mlsdmitry\LocaleInitializer;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\nbt\tag\StringTag;
use pocketmine\utils\Config;

class LocaleInitializer extends \pocketmine\plugin\PluginBase implements Listener
{
    /** @var Config $config */
    private $players;

    public function onEnable()
    {
        $this->players = new Config($this->getDataFolder() . DIRECTORY_SEPARATOR . 'players.yml', Config::YAML);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $get_language = function ($code) {
            # http://wiki.openstreetmap.org/wiki/Nominatim/Country_Codes
            $arr = array(
                'ad' => 'ca',
                'ae' => 'ar',
                'af' => 'fa,ps',
                'ag' => 'en',
                'ai' => 'en',
                'al' => 'sq',
                'am' => 'hy',
                'an' => 'nl,en',
                'ao' => 'pt',
                'aq' => 'en',
                'ar' => 'es',
                'as' => 'en,sm',
                'at' => 'de',
                'au' => 'en',
                'aw' => 'nl,pap',
                'ax' => 'sv',
                'az' => 'az',
                'ba' => 'bs,hr,sr',
                'bb' => 'en',
                'bd' => 'bn',
                'be' => 'nl,fr,de',
                'bf' => 'fr',
                'bg' => 'bg',
                'bh' => 'ar',
                'bi' => 'fr',
                'bj' => 'fr',
                'bl' => 'fr',
                'bm' => 'en',
                'bn' => 'ms',
                'bo' => 'es,qu,ay',
                'br' => 'pt',
                'bq' => 'nl,en',
                'bs' => 'en',
                'bt' => 'dz',
                'bv' => 'no',
                'bw' => 'en,tn',
                'by' => 'be,ru',
                'bz' => 'en',
                'ca' => 'en,fr',
                'cc' => 'en',
                'cd' => 'fr',
                'cf' => 'fr',
                'cg' => 'fr',
                'ch' => 'de,fr,it,rm',
                'ci' => 'fr',
                'ck' => 'en,rar',
                'cl' => 'es',
                'cm' => 'fr,en',
                'cn' => 'zh',
                'co' => 'es',
                'cr' => 'es',
                'cu' => 'es',
                'cv' => 'pt',
                'cw' => 'nl',
                'cx' => 'en',
                'cy' => 'el,tr',
                'cz' => 'cs',
                'de' => 'de',
                'dj' => 'fr,ar,so',
                'dk' => 'da',
                'dm' => 'en',
                'do' => 'es',
                'dz' => 'ar',
                'ec' => 'es',
                'ee' => 'et',
                'eg' => 'ar',
                'eh' => 'ar,es,fr',
                'er' => 'ti,ar,en',
                'es' => 'es,ast,ca,eu,gl',
                'et' => 'am,om',
                'fi' => 'fi,sv,se',
                'fj' => 'en',
                'fk' => 'en',
                'fm' => 'en',
                'fo' => 'fo',
                'fr' => 'fr',
                'ga' => 'fr',
                'gb' => 'en,ga,cy,gd,kw',
                'gd' => 'en',
                'ge' => 'ka',
                'gf' => 'fr',
                'gg' => 'en',
                'gh' => 'en',
                'gi' => 'en',
                'gl' => 'kl,da',
                'gm' => 'en',
                'gn' => 'fr',
                'gp' => 'fr',
                'gq' => 'es,fr,pt',
                'gr' => 'el',
                'gs' => 'en',
                'gt' => 'es',
                'gu' => 'en,ch',
                'gw' => 'pt',
                'gy' => 'en',
                'hk' => 'zh,en',
                'hm' => 'en',
                'hn' => 'es',
                'hr' => 'hr',
                'ht' => 'fr,ht',
                'hu' => 'hu',
                'id' => 'id',
                'ie' => 'en,ga',
                'il' => 'he',
                'im' => 'en',
                'in' => 'hi,en',
                'io' => 'en',
                'iq' => 'ar,ku',
                'ir' => 'fa',
                'is' => 'is',
                'it' => 'it,de,fr',
                'je' => 'en',
                'jm' => 'en',
                'jo' => 'ar',
                'jp' => 'ja',
                'ke' => 'sw,en',
                'kg' => 'ky,ru',
                'kh' => 'km',
                'ki' => 'en',
                'km' => 'ar,fr',
                'kn' => 'en',
                'kp' => 'ko',
                'kr' => 'ko,en',
                'kw' => 'ar',
                'ky' => 'en',
                'kz' => 'kk,ru',
                'la' => 'lo',
                'lb' => 'ar,fr',
                'lc' => 'en',
                'li' => 'de',
                'lk' => 'si,ta',
                'lr' => 'en',
                'ls' => 'en,st',
                'lt' => 'lt',
                'lu' => 'lb,fr,de',
                'lv' => 'lv',
                'ly' => 'ar',
                'ma' => 'ar',
                'mc' => 'fr',
                'md' => 'ru,uk,ro',
                'me' => 'srp,sq,bs,hr,sr',
                'mf' => 'fr',
                'mg' => 'mg,fr',
                'mh' => 'en,mh',
                'mk' => 'mk',
                'ml' => 'fr',
                'mm' => 'my',
                'mn' => 'mn',
                'mo' => 'zh,en,pt',
                'mp' => 'ch',
                'mq' => 'fr',
                'mr' => 'ar,fr',
                'ms' => 'en',
                'mt' => 'mt,en',
                'mu' => 'mfe,fr,en',
                'mv' => 'dv',
                'mw' => 'en,ny',
                'mx' => 'es',
                'my' => 'ms,zh,en',
                'mz' => 'pt',
                'na' => 'en,sf,de',
                'nc' => 'fr',
                'ne' => 'fr',
                'nf' => 'en,pih',
                'ng' => 'en',
                'ni' => 'es',
                'nl' => 'nl',
                'no' => 'nb,nn,no,se',
                'np' => 'ne',
                'nr' => 'na,en',
                'nu' => 'niu,en',
                'nz' => 'en,mi',
                'om' => 'ar',
                'pa' => 'es',
                'pe' => 'es',
                'pf' => 'fr',
                'pg' => 'en,tpi,ho',
                'ph' => 'en,tl',
                'pk' => 'en,ur',
                'pl' => 'pl',
                'pm' => 'fr',
                'pn' => 'en,pih',
                'pr' => 'es,en',
                'ps' => 'ar,he',
                'pt' => 'pt',
                'pw' => 'en,pau,ja,sov,tox',
                'py' => 'es,gn',
                'qa' => 'ar',
                're' => 'fr',
                'ro' => 'ro',
                'rs' => 'sr',
                'ru' => 'ru',
                'rw' => 'rw,fr,en',
                'sa' => 'ar',
                'sb' => 'en',
                'sc' => 'fr,en,crs',
                'sd' => 'ar,en',
                'se' => 'sv',
                'sg' => 'en,ms,zh,ta',
                'sh' => 'en',
                'si' => 'sl',
                'sj' => 'no',
                'sk' => 'sk',
                'sl' => 'en',
                'sm' => 'it',
                'sn' => 'fr',
                'so' => 'so,ar',
                'sr' => 'nl',
                'st' => 'pt',
                'ss' => 'en',
                'sv' => 'es',
                'sx' => 'nl,en',
                'sy' => 'ar',
                'sz' => 'en,ss',
                'tc' => 'en',
                'td' => 'fr,ar',
                'tf' => 'fr',
                'tg' => 'fr',
                'th' => 'th',
                'tj' => 'tg,ru',
                'tk' => 'tkl,en,sm',
                'tl' => 'pt,tet',
                'tm' => 'tk',
                'tn' => 'ar',
                'to' => 'en',
                'tr' => 'tr',
                'tt' => 'en',
                'tv' => 'en',
                'tw' => 'zh',
                'tz' => 'sw,en',
                'ua' => 'uk',
                'ug' => 'en,sw',
                'um' => 'en',
                'us' => 'en,es',
                'uy' => 'es',
                'uz' => 'uz,kaa',
                'va' => 'it',
                'vc' => 'en',
                've' => 'es',
                'vg' => 'en',
                'vi' => 'en',
                'vn' => 'vi',
                'vu' => 'bi,en,fr',
                'wf' => 'fr',
                'ws' => 'sm,en',
                'ye' => 'ar',
                'yt' => 'fr',
                'za' => 'zu,xh,af,st,tn,en',
                'zm' => 'en',
                'zw' => 'en,sn,nd'
            );
            #----
            $code = strtolower($code);
            if ($code == 'eu') {
                return 'en_GB';
            } elseif ($code == 'ap') { # Asia Pacific
                return 'en_US';
            } elseif ($code == 'cs') {
                return 'sr_RS';
            }
            #----
            if ($code == 'uk') {
                $code = 'gb';
            }
            if (array_key_exists($code, $arr)) {
                if (strpos($arr[$code], ',') !== false) {
                    $new = explode(',', $arr[$code]);
                    $loc = array();
                    foreach ($new as $key => $val) {
                        $loc[] = $val . '_' . strtoupper($code);
                    }
                    return implode(',', $loc); # string; comma-separated values 'en_GB,ga_GB,cy_GB,gd_GB,kw_GB'
                } else {
                    return $arr[$code] . '_' . strtoupper($code); # string 'en_US'
                }
            }
            return 'en_US';
        };

        $p = $event->getPlayer();
//        $request = 'http://ip-api.com/json/' . $p->getAddress() . '?fields=status,message,countryCode';
        $request = 'http://ip-api.com/json/' . '176.59.12.36' . '?fields=status,message,countryCode';
        $json = json_decode(file_get_contents($request), true);
        echo $request . PHP_EOL;
        if ($json['status'] == "success") {
            $country = $json['countryCode'];
        } else
            $country = false;
        if (!$country) {
            $event->setCancelled();
        }
        if (!$this->players->exists($p->getUniqueId()->toString())) {
            $this->players->set($p->getUniqueId()->toString(), $get_language($country));
        }

        $this->players->save();
        // set Lang tag
        $p->namedtag->setString('lang', $this->players->get($p->getUniqueId()->toString()));
    }
}