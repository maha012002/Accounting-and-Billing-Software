{extends file="$tpl_admin_layout"}

{block name="content"}
    <div class="row">


        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Localisation']}</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" name="localisation" method="post" action="{$_url}settings/lc-post/">


                        <div class="form-group">
                            <label for="tzone">{$_L['Timezone']}</label>
                            <select name="tzone" id="tzone">
                                {foreach $tlist as $value => $label}
                                    <option value="{$value}"
                                            {if $_c['timezone'] eq $value}selected="selected" {/if}>{$label}</option>
                                {/foreach}


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="country">{$_L['Default Country']}</label>
                            <select name="country" id="country">
                                <option value="">{$_L['Select Country']}</option>
                                {$countries}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="df">{$_L['Date Format']}</label>
                            <select class="form-control" name="df" id="df">
                                <option value="d/m/Y" {if $_c['df'] eq 'd/m/Y'} selected="selected" {/if}>{date('d/m/Y')}</option>
                                <option value="d.m.Y" {if $_c['df'] eq 'd.m.Y'} selected="selected" {/if}>{date('d.m.Y')}</option>
                                <option value="d-m-Y" {if $_c['df'] eq 'd-m-Y'} selected="selected" {/if}>{date('d-m-Y')}</option>
                                <option value="m/d/Y" {if $_c['df'] eq 'm/d/Y'} selected="selected" {/if}>{date('m/d/Y')}</option>
                                <option value="Y/m/d" {if $_c['df'] eq 'Y/m/d'} selected="selected" {/if}>{date('Y/m/d')}</option>
                                <option value="Y-m-d" {if $_c['df'] eq 'Y-m-d'} selected="selected" {/if}>{date('Y-m-d')}</option>


                            </select>
                        </div>


                        <div class="form-group">
                            <label for="lan">{$_L['Default_Language']}</label>
                            <select class="form-control" name="lan" id="lan">



                                {foreach $languages as $language}
                                    <option value="{$language['iso_code']}" {if $_c['language'] eq $language['iso_code']} selected="selected" {/if}>{$language['name']}</option>
                                {/foreach}








                                {*<option value="chinese" {if $_c['language'] eq 'chinese'} selected="selected" {/if}>*}
                                {*汉语/漢語*}
                                {*</option>*}
                                {*<option value="croatian" {if $_c['language'] eq 'croatian'} selected="selected" {/if}>*}
                                {*Croatian*}
                                {*</option>*}
                                {*<option value="czech" {if $_c['language'] eq 'czech'} selected="selected" {/if}>Čeština*}
                                {*</option>*}
                                {*<option value="danish" {if $_c['language'] eq 'danish'} selected="selected" {/if}>Dansk*}
                                {*</option>*}
                                {*<option value="dutch" {if $_c['language'] eq 'dutch'} selected="selected" {/if}>Dutch*}
                                {*</option>*}
                                {*<option value="en-us" {if $_c['language'] eq 'en-us'} selected="selected" {/if}>English*}
                                {*</option>*}
                                {*<option value="farsi" {if $_c['language'] eq 'farsi'} selected="selected" {/if}>فارسی*}
                                {*</option>*}
                                {*<option value="french" {if $_c['language'] eq 'french'} selected="selected" {/if}>Français*}
                                {*</option>*}
                                {*<option value="german" {if $_c['language'] eq 'german'} selected="selected" {/if}>Deutsch*}
                                {*</option>*}
                                {*<option value="hungarian" {if $_c['language'] eq 'hungarian'} selected="selected" {/if}>*}
                                {*Hungarian*}
                                {*</option>*}
                                {*<option value="italian" {if $_c['language'] eq 'italian'} selected="selected" {/if}>*}
                                {*Italiano*}
                                {*</option>*}
                                {*<option value="indonesian" {if $_c['language'] eq 'indonesian'} selected="selected" {/if}>*}
                                {*Bahasa Indonesia*}
                                {*</option>*}
                                {*<option value="norwegian" {if $_c['language'] eq 'norwegian'} selected="selected" {/if}>*}
                                {*Norsk*}
                                {*</option>*}
                                {*<option value="portuguese-br" {if $_c['language'] eq 'portuguese-br'} selected="selected" {/if}>*}
                                {*Português (Brasil)*}
                                {*</option>*}
                                {*<option value="portuguese-pt" {if $_c['language'] eq 'portuguese-pt'} selected="selected" {/if}>*}
                                {*Português (Portugal)*}
                                {*</option>*}
                                {*<option value="russian" {if $_c['language'] eq 'russian'} selected="selected" {/if}>*}
                                {*Русский*}
                                {*</option>*}
                                {*<option value="spanish" {if $_c['language'] eq 'spanish'} selected="selected" {/if}>*}
                                {*Español*}
                                {*</option>*}
                                {*<option value="swedish" {if $_c['language'] eq 'swedish'} selected="selected" {/if}>*}
                                {*Svenska*}
                                {*</option>*}
                                {*<option value="thai" {if $_c['language'] eq 'thai'} selected="selected" {/if}>*}
                                {*ภาษาไทย*}
                                {*</option>*}
                                {*<option value="turkish" {if $_c['language'] eq 'turkish'} selected="selected" {/if}>*}
                                {*Türkçe*}
                                {*</option>*}
                                {*<option value="ukranian" {if $_c['language'] eq 'ukranian'} selected="selected" {/if}>*}
                                {*Українська*}
                                {*</option>*}

                                {*<option value="serbian" {if $_c['language'] eq 'serbian'} selected="selected" {/if}>*}
                                {*Serbian*}
                                {*</option>*}

                                {*<option value="so_so">Af-Soomaali</option>*}
                                {*<option value="af_za">Afrikaans</option>*}
                                {*<option value="ak_gh">Akan</option>*}
                                {*<option value="ig_ng">Asụsụ Igbo</option>*}
                                {*<option value="ay_bo">Aymar aru</option>*}
                                {*<option value="az_az">Azərbaycan dili</option>*}
                                {*<option value="id_id">Bahasa Indonesia</option>*}
                                {*<option value="ms_my">Bahasa Melayu</option>*}
                                {*<option value="jv_id">Basa Jawa</option>*}
                                {*<option value="cx_ph">Bisaya</option>*}
                                {*<option value="bs_ba">Bosanski</option>*}
                                {*<option value="br_fr">Brezhoneg</option>*}
                                {*<option value="ca_es">Català</option>*}
                                {*<option value="cs_cz">Čeština</option>*}
                                {*<option value="ck_us">Cherokee</option>*}
                                {*<option value="ny_mw">Chichewa</option>*}
                                {*<option value="co_fr">Corsu</option>*}
                                {*<option value="cy_gb">Cymraeg</option>*}
                                {*<option value="da_dk">Dansk</option>*}
                                {*<option value="se_no">Davvisámegiella</option>*}
                                {*<option value="de_de">Deutsch</option>*}
                                {*<option value="yo_ng">èdè Yorùbá</option>*}
                                {*<option value="et_ee">Eesti</option>*}
                                {*<option value="en_in">English (India)</option>*}
                                {*<option value="en_pi">English (Pirate)</option>*}
                                {*<option value="en_gb">English (UK)</option>*}
                                {*<option value="en_ud">English (Upside Down)</option>*}
                                {*<option value="en_us">English (US)</option>*}
                                {*<option value="es_la">Español</option>*}
                                {*<option value="es_co">Español (Colombia)</option>*}
                                {*<option value="es_ES">Español (España)</option>*}
                                {*<option value="eo_EO">Esperanto</option>*}
                                {*<option value="eu_ES">Euskara</option>*}
                                {*<option value="tl_PH">Filipino</option>*}
                                {*<option value="fo_FO">Føroyskt</option>*}
                                {*<option value="fr_CA">Français (Canada)</option>*}
                                {*<option value="fr_FR">Français (France)</option>*}
                                {*<option value="fy_NL">Frysk</option>*}
                                {*<option value="ga_IE">Gaeilge</option>*}
                                {*<option value="gl_ES">Galego</option>*}
                                {*<option value="gn_PY">Guarani</option>*}
                                {*<option value="ha_NG">Hausa</option>*}
                                {*<option value="hr_HR">Hrvatski</option>*}
                                {*<option value="rw_RW">IkiKinyarwanda</option>*}
                                {*<option value="nd_ZW">isiNdebele</option>*}
                                {*<option value="xh_ZA">isiXhosa</option>*}
                                {*<option value="zu_ZA">isiZulu</option>*}
                                {*<option value="is_IS">Íslenska</option>*}
                                {*<option value="it_IT">Italiano</option>*}
                                {*<option value="sw_KE">Kiswahili</option>*}
                                {*<option value="ku_TR">Kurdî (Kurmancî)</option>*}
                                {*<option value="lv_LV">Latviešu</option>*}
                                {*<option value="fb_LT">Leet Speak</option>*}
                                {*<option value="lt_LT">Lietuvių</option>*}
                                {*<option value="li_NL">Limburgs</option>*}
                                {*<option value="ln_CD">Lingála</option>*}
                                {*<option value="la_VA">lingua latina</option>*}
                                {*<option value="lg_UG">Luganda</option>*}
                                {*<option value="hu_HU">Magyar</option>*}
                                {*<option value="mg_MG">Malagasy</option>*}
                                {*<option value="mt_MT">Malti</option>*}
                                {*<option value="nl_NL">Nederlands</option>*}
                                {*<option value="nl_BE">Nederlands (België)</option>*}
                                {*<option value="nb_NO">Norsk (bokmål)</option>*}
                                {*<option value="nn_NO">Norsk (nynorsk)</option>*}
                                {*<option value="uz_UZ">O'zbek</option>*}
                                {*<option value="pl_PL">Polski</option>*}
                                {*<option value="pt_BR">Português (Brasil)</option>*}
                                {*<option value="pt_PT">Português (Portugal)</option>*}
                                {*<option value="ff_NG">Pulaar-Fulfulde</option>*}
                                {*<option value="qu_PE">Qhichwa</option>*}
                                {*<option value="ro_RO">Română</option>*}
                                {*<option value="rm_CH">Rumantsch</option>*}
                                {*<option value="sc_IT">Sardu</option>*}
                                {*<option value="sn_ZW">Shona</option>*}
                                {*<option value="sq_AL">Shqip</option>*}
                                {*<option value="sz_pl">ślōnskŏ gŏdka</option>*}
                                {*<option value="sk_sk">Slovenčina</option>*}
                                {*<option value="sl_si">Slovenščina</option>*}
                                {*<option value="fi_fi">Suomi</option>*}
                                {*<option value="sv_se">Svenska</option>*}
                                {*<option value="vi_vn">Tiếng Việt</option>*}
                                {*<option value="tl_st">tlhIngan-Hol</option>*}
                                {*<option value="tr_tr">Türkçe</option>*}
                                {*<option value="tk_tm">Türkmen</option>*}
                                {*<option value="wo_sn">Wolof</option>*}
                                {*<option value="zz_tr">Zaza</option>*}
                                {*<option value="el_gr">Ελληνικά</option>*}
                                {*<option value="gx_gr">Ἑλληνική ἀρχαία</option>*}
                                {*<option value="be_by">Беларуская</option>*}
                                {*<option value="bg_bg">Български</option>*}
                                {*<option value="kk_kz">Қазақша</option>*}
                                {*<option value="mk_mk">Македонски</option>*}
                                {*<option value="mn_mn">Монгол</option>*}
                                {*<option value="ru_ru">Русский</option>*}
                                {*<option value="sr_rs">Српски</option>*}
                                {*<option value="tt_ru">Татарча</option>*}
                                {*<option value="tg_tj">Тоҷикӣ</option>*}
                                {*<option value="uk_ua">Українська</option>*}
                                {*<option value="ka_ge">ქართული</option>*}
                                {*<option value="hy_am">Հայերեն</option>*}
                                {*<option value="yi_de">ייִדיש</option>*}
                                {*<option value="he_il">עברית</option>*}
                                {*<option value="ur_pk">اردو</option>*}
                                {*<option value="ar_ar">العربية</option>*}
                                {*<option value="ps_af">پښتو</option>*}
                                {*<option value="fa_ir">فارسی</option>*}
                                {*<option value="cb_iq">کوردیی ناوەندی</option>*}
                                {*<option value="sy_sy">ܐܪܡܝܐ</option>*}
                                {*<option value="am_et">አማርኛ</option>*}
                                {*<option value="ne_np">नेपाली</option>*}
                                {*<option value="mr_in">मराठी</option>*}
                                {*<option value="sa_in">संस्कृतम्</option>*}
                                {*<option value="hi_in">हिन्दी</option>*}
                                {*<option value="as_in">অসমীয়া</option>*}
                                {*<option value="bn_bd">বাংলা</option>*}
                                {*<option value="pa_in">ਪੰਜਾਬੀ</option>*}
                                {*<option value="gu_in">ગુજરાતી</option>*}
                                {*<option value="or_in">ଓଡ଼ିଆ</option>*}
                                {*<option value="ta_in">தமிழ்</option>*}
                                {*<option value="te_in">తెలుగు</option>*}
                                {*<option value="kn_in">ಕನ್ನಡ</option>*}
                                {*<option value="ml_in">മലയാളം</option>*}
                                {*<option value="si_lk">සිංහල</option>*}
                                {*<option value="th_th">ภาษาไทย</option>*}
                                {*<option value="lo_la">ພາສາລາວ</option>*}
                                {*<option value="km_kh">ភាសាខ្មែរ</option>*}
                                {*<option value="ko_kr">한국어</option>*}
                                {*<option value="zh_tw">中文(台灣)</option>*}
                                {*<option value="zh_cn">中文(简体)</option>*}
                                {*<option value="zh_hk">中文(香港)</option>*}
                                {*<option value="ja_jp">日本語</option>*}
                                {*<option value="ja_ks">日本語(関西)</option>*}

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cformat">{$_L['Currency Format']}</label>
                            <select class="form-control" name="cformat" id="cformat">
                                <option value="1" {if ($_c['dec_point'] eq '.') AND ($_c['thousands_sep'] eq '')} selected="selected" {/if}>
                                    1234.56
                                </option>
                                <option value="2" {if ($_c['dec_point'] eq '.') AND ($_c['thousands_sep'] eq ',')} selected="selected" {/if}>
                                    1,234.56
                                </option>
                                <option value="3" {if ($_c['dec_point'] eq ',') AND ($_c['thousands_sep'] eq '')} selected="selected" {/if}>
                                    1234,56
                                </option>
                                <option value="4" {if ($_c['dec_point'] eq ',') AND ($_c['thousands_sep'] eq '.')} selected="selected" {/if}>
                                    1.234,56
                                </option>
                            </select>
                        </div>

                        {*<div class="form-group">*}
                        {*<label for="dec_point">Decimal Point</label>*}
                        {*<input type="text" class="form-control" id="dec_point" name="dec_point" value="{$_c['dec_point']}">*}

                        {*</div>*}
                        {*<div class="form-group">*}
                        {*<label for="thousands_sep">Thousands Separator</label>*}
                        {*<input type="text" class="form-control" id="thousands_sep" name="thousands_sep" value="{$_c['thousands_sep']}">*}

                        {*</div>*}


                        <div class="form-group">
                            <label for="home_currency">{$_L['Home Currency']}</label>
                            {*<input type="text" class="form-control" id="home_currency" name="home_currency"*}
                            {*value="{$_c['home_currency']}">*}



                            <select name="home_currency" id="home_currency">

                                {foreach $currencies as $currency}

                                    <option data-symbol="{$currency['symbol']}" value="{$currency['code']}" {if ($_c['home_currency'] eq $currency['code'])} selected="selected" {/if}>{$currency['symbol']} - {$currency['name']} [ {$currency['code']} ]</option>

                                {/foreach}


                            </select>


                        </div>

                        <div class="form-group">
                            <label for="currency_code">{$_L['Currency Symbol']}</label>
                            <input type="text" class="form-control" id="currency_code" name="currency_code"
                                   value="{$_c['currency_code']}">
                            <span class="help-block">{$_L['Keep it blank if currency code']}</span>
                        </div>

                        <div class="form-group">
                            <label for="currency_symbol_position">{$_L['Currency Symbol Position']}</label>
                            <select class="form-control" name="currency_symbol_position" id="currency_symbol_position">

                                <option value="p" {if ($_c['currency_symbol_position'] eq 'p')} selected="selected" {/if}>{$_L['Left']}</option>
                                <option value="s" {if ($_c['currency_symbol_position'] eq 's')} selected="selected" {/if}>{$_L['Right']}</option>




                            </select>
                        </div>

                        <div class="form-group">
                            <label for="currency_decimal_digits">{$_L['Currency Decimal Digits']}</label>
                            <select class="form-control" name="currency_decimal_digits" id="currency_decimal_digits">

                                <option value="false" {if ($_c['currency_decimal_digits'] eq 'false')} selected="selected" {/if}>0 (e.g. 100)</option>
                                <option value="true" {if ($_c['currency_decimal_digits'] eq 'true')} selected="selected" {/if}>2 (e.g. 100.00)</option>




                            </select>
                        </div>

                        <div class="form-group">
                            <label for="thousand_separator_placement">{$_L['Thousand Separator Placement']}</label>
                            <select class="form-control" name="thousand_separator_placement" id="thousand_separator_placement">

                                <option value="2" {if ($_c['thousand_separator_placement'] eq '2')} selected="selected" {/if}>2 (e.g. - 22,22,22,333)</option>
                                <option value="3" {if ($_c['thousand_separator_placement'] eq '3')} selected="selected" {/if}>3 (e.g. - 333,333,333)</option>
                                <option value="4" {if ($_c['thousand_separator_placement'] eq '4')} selected="selected" {/if}>4 (e.g. - 4,4444,4444)</option>




                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                    </form>

                </div>
            </div>


        </div>

        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Charset n Collation']}</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" name="localisation" method="post" action="{$_url}settings/lc-charset-post">


                        <div class="form-group">
                            <label for="coll">{$_L['Set Charset n Collation']}</label>
                            <select class="form-control" name="coll" id="coll">
                                <option value=""></option>
                                <optgroup label="armscii8" title="ARMSCII-8 Armenian">
                                    <option value="armscii8_bin"
                                            title="Armenian, Binary" {if $col eq 'armscii8_bin'} selected="selected" {/if}>
                                        armscii8_bin
                                    </option>
                                    <option value="armscii8_general_ci"
                                            title="Armenian, case-insensitive" {if $col eq 'armscii8_general_ci'} selected="selected" {/if}>
                                        armscii8_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="ascii" title="US ASCII">
                                    <option value="ascii_bin"
                                            title="West European (multilingual), Binary" {if $col eq 'ascii_bin'} selected="selected" {/if}>
                                        ascii_bin
                                    </option>
                                    <option value="ascii_general_ci"
                                            title="West European (multilingual), case-insensitive" {if $col eq 'ascii_general_ci'} selected="selected" {/if}>
                                        ascii_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="big5" title="Big5 Traditional Chinese">
                                    <option value="big5_bin"
                                            title="Traditional Chinese, Binary" {if $col eq 'big5_bin'} selected="selected" {/if}>
                                        big5_bin
                                    </option>
                                    <option value="big5_chinese_ci"
                                            title="Traditional Chinese, case-insensitive" {if $col eq 'big5_chinese_ci'} selected="selected" {/if}>
                                        big5_chinese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="binary" title="Binary pseudo charset">
                                    <option value="binary" title="Binary" {if $col eq 'binary'} selected="selected" {/if}>
                                        binary
                                    </option>
                                </optgroup>
                                <optgroup label="cp1250" title="Windows Central European">
                                    <option value="cp1250_bin"
                                            title="Central European (multilingual), Binary" {if $col eq 'cp1250_bin'} selected="selected" {/if}>
                                        cp1250_bin
                                    </option>
                                    <option value="cp1250_croatian_ci"
                                            title="Croatian, case-insensitive" {if $col eq 'cp1250_croatian_ci'} selected="selected" {/if}>
                                        cp1250_croatian_ci
                                    </option>
                                    <option value="cp1250_czech_cs"
                                            title="Czech, case-sensitive" {if $col eq 'cp1250_czech_cs'} selected="selected" {/if}>
                                        cp1250_czech_cs
                                    </option>
                                    <option value="cp1250_general_ci"
                                            title="Central European (multilingual), case-insensitive" {if $col eq 'cp1250_general_ci'} selected="selected" {/if}>
                                        cp1250_general_ci
                                    </option>
                                    <option value="cp1250_polish_ci"
                                            title="Polish, case-insensitive" {if $col eq 'cp1250_polish_ci'} selected="selected" {/if}>
                                        cp1250_polish_ci
                                    </option>
                                </optgroup>
                                <optgroup label="cp1251" title="Windows Cyrillic">
                                    <option value="cp1251_bin"
                                            title="Cyrillic (multilingual), Binary" {if $col eq ''} selected="selected" {/if}>
                                        cp1251_bin
                                    </option>
                                    <option value="cp1251_bulgarian_ci"
                                            title="Bulgarian, case-insensitive" {if $col eq 'cp1251_bulgarian_ci'} selected="selected" {/if}>
                                        cp1251_bulgarian_ci
                                    </option>
                                    <option value="cp1251_general_ci"
                                            title="Cyrillic (multilingual), case-insensitive" {if $col eq 'cp1251_general_ci'} selected="selected" {/if}>
                                        cp1251_general_ci
                                    </option>
                                    <option value="cp1251_general_cs"
                                            title="Cyrillic (multilingual), case-sensitive {if $col eq 'cp1251_general_cs'} selected="
                                            selected
                                    " {/if}">
                                    cp1251_general_cs
                                    </option>
                                    <option value="cp1251_ukrainian_ci"
                                            title="Ukrainian, case-insensitive" {if $col eq 'cp1251_ukrainian_ci'} selected="selected" {/if}>
                                        cp1251_ukrainian_ci
                                    </option>
                                </optgroup>
                                <optgroup label="cp1256" title="Windows Arabic">
                                    <option value="cp1256_bin"
                                            title="Arabic, Binary" {if $col eq 'cp1256_bin'} selected="selected" {/if}>
                                        cp1256_bin
                                    </option>
                                    <option value="cp1256_general_ci"
                                            title="Arabic, case-insensitive" {if $col eq 'cp1256_general_ci'} selected="selected" {/if}>
                                        cp1256_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="cp1257" title="Windows Baltic">
                                    <option value="cp1257_bin"
                                            title="Baltic (multilingual), Binary" {if $col eq 'cp1257_bin'} selected="selected" {/if}>
                                        cp1257_bin
                                    </option>
                                    <option value="cp1257_general_ci"
                                            title="Baltic (multilingual), case-insensitive" {if $col eq 'cp1257_general_ci'} selected="selected" {/if}>
                                        cp1257_general_ci
                                    </option>
                                    <option value="cp1257_lithuanian_ci"
                                            title="Lithuanian, case-insensitive" {if $col eq 'cp1257_lithuanian_ci'} selected="selected" {/if}>
                                        cp1257_lithuanian_ci
                                    </option>
                                </optgroup>
                                <optgroup label="cp850" title="DOS West European">
                                    <option value="cp850_bin"
                                            title="West European (multilingual), Binary" {if $col eq 'cp850_bin'} selected="selected" {/if}>
                                        cp850_bin
                                    </option>
                                    <option value="cp850_general_ci"
                                            title="West European (multilingual), case-insensitive" {if $col eq 'cp850_general_ci'} selected="selected" {/if}>
                                        cp850_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="cp852" title="DOS Central European">
                                    <option value="cp852_bin"
                                            title="Central European (multilingual), Binary" {if $col eq 'cp852_bin'} selected="selected" {/if}>
                                        cp852_bin
                                    </option>
                                    <option value="cp852_general_ci"
                                            title="Central European (multilingual), case-insensitive" {if $col eq 'cp852_general_ci'} selected="selected" {/if}>
                                        cp852_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="cp866" title="DOS Russian">
                                    <option value="cp866_bin"
                                            title="Russian, Binary" {if $col eq 'cp866_bin'} selected="selected" {/if}>
                                        cp866_bin
                                    </option>
                                    <option value="cp866_general_ci"
                                            title="Russian, case-insensitive" {if $col eq 'cp866_general_ci'} selected="selected" {/if}>
                                        cp866_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="cp932" title="SJIS for Windows Japanese">
                                    <option value="cp932_bin"
                                            title="Japanese, Binary" {if $col eq 'cp932_bin'} selected="selected" {/if}>
                                        cp932_bin
                                    </option>
                                    <option value="cp932_japanese_ci"
                                            title="Japanese, case-insensitive" {if $col eq 'cp932_japanese_ci'} selected="selected" {/if}>
                                        cp932_japanese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="dec8" title="DEC West European">
                                    <option value="dec8_bin"
                                            title="West European (multilingual), Binary" {if $col eq 'dec8_bin'} selected="selected" {/if}>
                                        dec8_bin
                                    </option>
                                    <option value="dec8_swedish_ci"
                                            title="Swedish, case-insensitive" {if $col eq 'dec8_swedish_ci'} selected="selected" {/if}>
                                        dec8_swedish_ci
                                    </option>
                                </optgroup>
                                <optgroup label="eucjpms" title="UJIS for Windows Japanese">
                                    <option value="eucjpms_bin"
                                            title="Japanese, Binary" {if $col eq 'eucjpms_bin'} selected="selected" {/if}>
                                        eucjpms_bin
                                    </option>
                                    <option value="eucjpms_japanese_ci"
                                            title="Japanese, case-insensitive" {if $col eq 'eucjpms_japanese_ci'} selected="selected" {/if}>
                                        eucjpms_japanese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="euckr" title="EUC-KR Korean">
                                    <option value="euckr_bin"
                                            title="Korean, Binary" {if $col eq 'euckr_bin'} selected="selected" {/if}>
                                        euckr_bin
                                    </option>
                                    <option value="euckr_korean_ci"
                                            title="Korean, case-insensitive" {if $col eq 'euckr_korean_ci'} selected="selected" {/if}>
                                        euckr_korean_ci
                                    </option>
                                </optgroup>
                                <optgroup label="gb2312" title="GB2312 Simplified Chinese">
                                    <option value="gb2312_bin"
                                            title="Simplified Chinese, Binary" {if $col eq 'gb2312_bin'} selected="selected" {/if}>
                                        gb2312_bin
                                    </option>
                                    <option value="gb2312_chinese_ci"
                                            title="Simplified Chinese, case-insensitive" {if $col eq 'gb2312_chinese_ci'} selected="selected" {/if}>
                                        gb2312_chinese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="gbk" title="GBK Simplified Chinese">
                                    <option value="gbk_bin"
                                            title="Simplified Chinese, Binary" {if $col eq 'gbk_bin'} selected="selected" {/if}>
                                        gbk_bin
                                    </option>
                                    <option value="gbk_chinese_ci"
                                            title="Simplified Chinese, case-insensitive" {if $col eq 'gbk_chinese_ci'} selected="selected" {/if}>
                                        gbk_chinese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="geostd8" title="GEOSTD8 Georgian">
                                    <option value="geostd8_bin"
                                            title="Georgian, Binary" {if $col eq 'geostd8_bin'} selected="selected" {/if}>
                                        geostd8_bin
                                    </option>
                                    <option value="geostd8_general_ci"
                                            title="Georgian, case-insensitive" {if $col eq 'geostd8_general_ci'} selected="selected" {/if}>
                                        geostd8_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="greek" title="ISO 8859-7 Greek">
                                    <option value="greek_bin"
                                            title="Greek, Binary" {if $col eq 'greek_bin'} selected="selected" {/if}>
                                        greek_bin
                                    </option>
                                    <option value="greek_general_ci"
                                            title="Greek, case-insensitive" {if $col eq 'greek_general_ci'} selected="selected" {/if}>
                                        greek_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="hebrew" title="ISO 8859-8 Hebrew">
                                    <option value="hebrew_bin"
                                            title="Hebrew, Binary" {if $col eq 'hebrew_bin'} selected="selected" {/if}>
                                        hebrew_bin
                                    </option>
                                    <option value="hebrew_general_ci"
                                            title="Hebrew, case-insensitive" {if $col eq 'hebrew_general_ci'} selected="selected" {/if}>
                                        hebrew_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="hp8" title="HP West European">
                                    <option value="hp8_bin"
                                            title="West European (multilingual), Binary" {if $col eq 'hp8_bin'} selected="selected" {/if}>
                                        hp8_bin
                                    </option>
                                    <option value="hp8_english_ci"
                                            title="English, case-insensitive" {if $col eq 'hp8_english_ci'} selected="selected" {/if}>
                                        hp8_english_ci
                                    </option>
                                </optgroup>
                                <optgroup label="keybcs2" title="DOS Kamenicky Czech-Slovak">
                                    <option value="keybcs2_bin"
                                            title="Czech-Slovak, Binary" {if $col eq 'keybcs2_bin'} selected="selected" {/if}>
                                        keybcs2_bin
                                    </option>
                                    <option value="keybcs2_general_ci"
                                            title="Czech-Slovak, case-insensitive" {if $col eq 'keybcs2_general_ci'} selected="selected" {/if}>
                                        keybcs2_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="koi8r" title="KOI8-R Relcom Russian">
                                    <option value="koi8r_bin"
                                            title="Russian, Binary" {if $col eq 'koi8r_bin'} selected="selected" {/if}>
                                        koi8r_bin
                                    </option>
                                    <option value="koi8r_general_ci"
                                            title="Russian, case-insensitive" {if $col eq 'koi8r_general_ci'} selected="selected" {/if}>
                                        koi8r_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="koi8u" title="KOI8-U Ukrainian">
                                    <option value="koi8u_bin"
                                            title="Ukrainian, Binary" {if $col eq 'koi8u_bin'} selected="selected" {/if}>
                                        koi8u_bin
                                    </option>
                                    <option value="koi8u_general_ci"
                                            title="Ukrainian, case-insensitive" {if $col eq 'koi8u_general_ci'} selected="selected" {/if}>
                                        koi8u_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="latin1" title="cp1252 West European">
                                    <option value="latin1_bin"
                                            title="West European (multilingual), Binary" {if $col eq 'latin1_bin'} selected="selected" {/if}>
                                        latin1_bin
                                    </option>
                                    <option value="latin1_danish_ci"
                                            title="Danish, case-insensitive" {if $col eq 'latin1_danish_ci'} selected="selected" {/if}>
                                        latin1_danish_ci
                                    </option>
                                    <option value="latin1_general_ci"
                                            title="West European (multilingual), case-insensitive" {if $col eq 'latin1_general_ci'} selected="selected" {/if}>
                                        latin1_general_ci
                                    </option>
                                    <option value="latin1_general_cs"
                                            title="West European (multilingual), case-sensitive" {if $col eq 'latin1_general_cs'} selected="selected" {/if}>
                                        latin1_general_cs
                                    </option>
                                    <option value="latin1_german1_ci"
                                            title="German (dictionary), case-insensitive" {if $col eq 'latin1_german1_ci'} selected="selected" {/if}>
                                        latin1_german1_ci
                                    </option>
                                    <option value="latin1_german2_ci"
                                            title="German (phone book), case-insensitive" {if $col eq 'latin1_german2_ci'} selected="selected" {/if}>
                                        latin1_german2_ci
                                    </option>
                                    <option value="latin1_spanish_ci"
                                            title="Spanish, case-insensitive" {if $col eq 'latin1_spanish_ci'} selected="selected" {/if}>
                                        latin1_spanish_ci
                                    </option>
                                    <option value="latin1_swedish_ci"
                                            title="Swedish, case-insensitive" {if $col eq 'latin1_swedish_ci'} selected="selected" {/if}>
                                        latin1_swedish_ci
                                    </option>
                                </optgroup>
                                <optgroup label="latin2" title="ISO 8859-2 Central European">
                                    <option value="latin2_bin"
                                            title="Central European (multilingual), Binary" {if $col eq 'latin2_bin'} selected="selected" {/if}>
                                        latin2_bin
                                    </option>
                                    <option value="latin2_croatian_ci"
                                            title="Croatian, case-insensitive" {if $col eq 'latin2_croatian_ci'} selected="selected" {/if}>
                                        latin2_croatian_ci
                                    </option>
                                    <option value="latin2_czech_cs"
                                            title="Czech, case-sensitive" {if $col eq 'latin2_czech_cs'} selected="selected" {/if}>
                                        latin2_czech_cs
                                    </option>
                                    <option value="latin2_general_ci"
                                            title="Central European (multilingual), case-insensitive" {if $col eq 'latin2_general_ci'} selected="selected" {/if}>
                                        latin2_general_ci
                                    </option>
                                    <option value="latin2_hungarian_ci"
                                            title="Hungarian, case-insensitive" {if $col eq 'latin2_hungarian_ci'} selected="selected" {/if}>
                                        latin2_hungarian_ci
                                    </option>
                                </optgroup>
                                <optgroup label="latin5" title="ISO 8859-9 Turkish">
                                    <option value="latin5_bin"
                                            title="Turkish, Binary" {if $col eq 'latin5_bin'} selected="selected" {/if}>
                                        latin5_bin
                                    </option>
                                    <option value="latin5_turkish_ci"
                                            title="Turkish, case-insensitive" {if $col eq 'latin5_turkish_ci'} selected="selected" {/if}>
                                        latin5_turkish_ci
                                    </option>
                                </optgroup>
                                <optgroup label="latin7" title="ISO 8859-13 Baltic">
                                    <option value="latin7_bin"
                                            title="Baltic (multilingual), Binary" {if $col eq 'latin7_bin'} selected="selected" {/if}>
                                        latin7_bin
                                    </option>
                                    <option value="latin7_estonian_cs"
                                            title="Estonian, case-sensitive" {if $col eq 'latin7_general_ci'} selected="selected" {/if}>
                                        latin7_estonian_cs
                                    </option>
                                    <option value="latin7_general_ci"
                                            title="Baltic (multilingual), case-insensitive" {if $col eq 'latin7_general_ci'} selected="selected" {/if}>
                                        latin7_general_ci
                                    </option>
                                    <option value="latin7_general_cs"
                                            title="Baltic (multilingual), case-sensitive" {if $col eq 'latin7_general_cs'} selected="selected" {/if}>
                                        latin7_general_cs
                                    </option>


                                </optgroup>
                                <optgroup label="macce" title="Mac Central European">
                                    <option value="macce_bin"
                                            title="Central European (multilingual), Binary" {if $col eq 'macce_bin'} selected="selected" {/if}>
                                        macce_bin
                                    </option>
                                    <option value="macce_general_ci"
                                            title="Central European (multilingual), case-insensitive" {if $col eq 'macce_general_ci'} selected="selected" {/if}>
                                        macce_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="macroman" title="Mac West European">
                                    <option value="macroman_bin"
                                            title="West European (multilingual), Binary" {if $col eq 'macroman_bin'} selected="selected" {/if}>
                                        macroman_bin
                                    </option>
                                    <option value="macroman_general_ci"
                                            title="West European (multilingual), case-insensitive" {if $col eq 'macroman_general_ci'} selected="selected" {/if}>
                                        macroman_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="sjis" title="Shift-JIS Japanese">
                                    <option value="sjis_bin"
                                            title="Japanese, Binary" {if $col eq 'sjis_bin'} selected="selected" {/if}>
                                        sjis_bin
                                    </option>
                                    <option value="sjis_japanese_ci"
                                            title="Japanese, case-insensitive" {if $col eq 'sjis_japanese_ci'} selected="selected" {/if}>
                                        sjis_japanese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="swe7" title="7bit Swedish">
                                    <option value="swe7_bin"
                                            title="Swedish, Binary" {if $col eq 'swe7_bin'} selected="selected" {/if}>
                                        swe7_bin
                                    </option>
                                    <option value="swe7_swedish_ci"
                                            title="Swedish, case-insensitive" {if $col eq 'swe7_swedish_ci'} selected="selected" {/if}>
                                        swe7_swedish_ci
                                    </option>
                                </optgroup>
                                <optgroup label="tis620" title="TIS620 Thai">
                                    <option value="tis620_bin" title="Thai, Binary">tis620_bin</option>
                                    <option value="tis620_thai_ci"
                                            title="Thai, case-insensitive" {if $col eq 'tis620_thai_ci'} selected="selected" {/if}>
                                        tis620_thai_ci
                                    </option>
                                </optgroup>
                                <optgroup label="ucs2" title="UCS-2 Unicode">
                                    <option value="ucs2_bin"
                                            title="Unicode (multilingual), Binary" {if $col eq 'ucs2_bin'} selected="selected" {/if}>
                                        ucs2_bin
                                    </option>
                                    <option value="ucs2_croatian_ci"
                                            title="Croatian, case-insensitive" {if $col eq 'ucs2_croatian_ci'} selected="selected" {/if}>
                                        ucs2_croatian_ci
                                    </option>
                                    <option value="ucs2_czech_ci"
                                            title="Czech, case-insensitive" {if $col eq 'ucs2_czech_ci'} selected="selected" {/if}>
                                        ucs2_czech_ci
                                    </option>
                                    <option value="ucs2_danish_ci"
                                            title="Danish, case-insensitive" {if $col eq 'ucs2_danish_ci'} selected="selected" {/if}>
                                        ucs2_danish_ci
                                    </option>
                                    <option value="ucs2_esperanto_ci"
                                            title="Esperanto, case-insensitive" {if $col eq 'ucs2_esperanto_ci'} selected="selected" {/if}>
                                        ucs2_esperanto_ci
                                    </option>
                                    <option value="ucs2_estonian_ci"
                                            title="Estonian, case-insensitive" {if $col eq 'ucs2_estonian_ci'} selected="selected" {/if}>
                                        ucs2_estonian_ci
                                    </option>
                                    <option value="ucs2_general_ci"
                                            title="Unicode (multilingual), case-insensitive" {if $col eq 'ucs2_general_ci'} selected="selected" {/if}>
                                        ucs2_general_ci
                                    </option>
                                    <option value="ucs2_general_mysql500_ci"
                                            title="Unicode (multilingual)" {if $col eq ''} selected="ucs2_general_mysql500_ci" {/if}>
                                        ucs2_general_mysql500_ci
                                    </option>
                                    <option value="ucs2_german2_ci"
                                            title="German (phone book), case-insensitive" {if $col eq 'ucs2_german2_ci'} selected="selected" {/if}>
                                        ucs2_german2_ci
                                    </option>
                                    <option value="ucs2_hungarian_ci"
                                            title="Hungarian, case-insensitive" {if $col eq 'ucs2_hungarian_ci'} selected="selected" {/if}>
                                        ucs2_hungarian_ci
                                    </option>
                                    <option value="ucs2_icelandic_ci"
                                            title="Icelandic, case-insensitive" {if $col eq 'ucs2_icelandic_ci'} selected="selected" {/if}>
                                        ucs2_icelandic_ci
                                    </option>
                                    <option value="ucs2_latvian_ci"
                                            title="Latvian, case-insensitive" {if $col eq 'ucs2_latvian_ci'} selected="selected" {/if}>
                                        ucs2_latvian_ci
                                    </option>
                                    <option value="ucs2_lithuanian_ci"
                                            title="Lithuanian, case-insensitive" {if $col eq 'ucs2_lithuanian_ci'} selected="selected" {/if}>
                                        ucs2_lithuanian_ci
                                    </option>
                                    <option value="ucs2_persian_ci"
                                            title="Persian, case-insensitive" {if $col eq 'ucs2_persian_ci'} selected="selected" {/if}>
                                        ucs2_persian_ci
                                    </option>
                                    <option value="ucs2_polish_ci"
                                            title="Polish, case-insensitive" {if $col eq ''} selected="selected" {/if}>
                                        ucs2_polish_ci
                                    </option>
                                    <option value="ucs2_roman_ci"
                                            title="West European, case-insensitive" {if $col eq 'ucs2_roman_ci'} selected="selected" {/if}>
                                        ucs2_roman_ci
                                    </option>
                                    <option value="ucs2_romanian_ci"
                                            title="Romanian, case-insensitive" {if $col eq 'ucs2_romanian_ci'} selected="selected" {/if}>
                                        ucs2_romanian_ci
                                    </option>
                                    <option value="ucs2_sinhala_ci"
                                            title="unknown, case-insensitive" {if $col eq 'ucs2_sinhala_ci'} selected="selected" {/if}>
                                        ucs2_sinhala_ci
                                    </option>
                                    <option value="ucs2_slovak_ci"
                                            title="Slovak, case-insensitive" {if $col eq 'ucs2_slovak_ci'} selected="selected" {/if}>
                                        ucs2_slovak_ci
                                    </option>
                                    <option value="ucs2_slovenian_ci"
                                            title="Slovenian, case-insensitive" {if $col eq 'ucs2_slovenian_ci'} selected="selected" {/if}>
                                        ucs2_slovenian_ci
                                    </option>
                                    <option value="ucs2_spanish2_ci"
                                            title="Traditional Spanish, case-insensitive" {if $col eq 'ucs2_spanish2_ci'} selected="selected" {/if}>
                                        ucs2_spanish2_ci
                                    </option>
                                    <option value="ucs2_spanish_ci"
                                            title="Spanish, case-insensitive" {if $col eq 'ucs2_spanish_ci'} selected="selected" {/if}>
                                        ucs2_spanish_ci
                                    </option>
                                    <option value="ucs2_swedish_ci"
                                            title="Swedish, case-insensitive" {if $col eq 'ucs2_swedish_ci'} selected="selected" {/if}>
                                        ucs2_swedish_ci
                                    </option>
                                    <option value="ucs2_turkish_ci"
                                            title="Turkish, case-insensitive" {if $col eq 'ucs2_turkish_ci'} selected="selected" {/if}>
                                        ucs2_turkish_ci
                                    </option>
                                    <option value="ucs2_unicode_520_ci"
                                            title="Unicode (multilingual)" {if $col eq 'ucs2_unicode_520_ci'} selected="selected" {/if}>
                                        ucs2_unicode_520_ci
                                    </option>
                                    <option value="ucs2_unicode_ci"
                                            title="Unicode (multilingual), case-insensitive" {if $col eq 'ucs2_unicode_ci'} selected="selected" {/if}>
                                        ucs2_unicode_ci
                                    </option>
                                    <option value="ucs2_vietnamese_ci"
                                            title="unknown, case-insensitive" {if $col eq 'ucs2_vietnamese_ci'} selected="selected" {/if}>
                                        ucs2_vietnamese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="ujis" title="EUC-JP Japanese">
                                    <option value="ujis_bin"
                                            title="Japanese, Binary" {if $col eq 'ujis_bin'} selected="selected" {/if}>
                                        ujis_bin
                                    </option>
                                    <option value="ujis_japanese_ci"
                                            title="Japanese, case-insensitive" {if $col eq 'ujis_japanese_ci'} selected="selected" {/if}>
                                        ujis_japanese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="utf16" title="UTF-16 Unicode">
                                    <option value="utf16_bin"
                                            title="unknown, Binary" {if $col eq 'utf16_bin'} selected="selected" {/if}>
                                        utf16_bin
                                    </option>
                                    <option value="utf16_croatian_ci"
                                            title="Croatian, case-insensitive" {if $col eq 'utf16_croatian_ci'} selected="selected" {/if}>
                                        utf16_croatian_ci
                                    </option>
                                    <option value="utf16_czech_ci"
                                            title="Czech, case-insensitive" {if $col eq ''} selected="selected" {/if}>
                                        utf16_czech_ci
                                    </option>
                                    <option value="utf16_danish_ci"
                                            title="Danish, case-insensitive" {if $col eq 'utf16_danish_ci'} selected="selected" {/if}>
                                        utf16_danish_ci
                                    </option>
                                    <option value="utf16_esperanto_ci"
                                            title="Esperanto, case-insensitive" {if $col eq 'utf16_esperanto_ci'} selected="selected" {/if}>
                                        utf16_esperanto_ci
                                    </option>
                                    <option value="utf16_estonian_ci"
                                            title="Estonian, case-insensitive" {if $col eq 'utf16_estonian_ci'} selected="selected" {/if}>
                                        utf16_estonian_ci
                                    </option>
                                    <option value="utf16_general_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf16_general_ci'} selected="selected" {/if}>
                                        utf16_general_ci
                                    </option>
                                    <option value="utf16_german2_ci"
                                            title="German (phone book), case-insensitive" {if $col eq 'utf16_german2_ci'} selected="selected" {/if}>
                                        utf16_german2_ci
                                    </option>
                                    <option value="utf16_hungarian_ci"
                                            title="Hungarian, case-insensitive" {if $col eq 'utf16_hungarian_ci'} selected="selected" {/if}>
                                        utf16_hungarian_ci
                                    </option>
                                    <option value="utf16_icelandic_ci"
                                            title="Icelandic, case-insensitive" {if $col eq 'utf16_icelandic_ci'} selected="selected" {/if}>
                                        utf16_icelandic_ci
                                    </option>
                                    <option value="utf16_latvian_ci"
                                            title="Latvian, case-insensitive" {if $col eq 'utf16_latvian_ci'} selected="selected" {/if}>
                                        utf16_latvian_ci
                                    </option>
                                    <option value="utf16_lithuanian_ci"
                                            title="Lithuanian, case-insensitive" {if $col eq 'utf16_lithuanian_ci'} selected="selected" {/if}>
                                        utf16_lithuanian_ci
                                    </option>
                                    <option value="utf16_persian_ci"
                                            title="Persian, case-insensitive" {if $col eq 'utf16_persian_ci'} selected="selected" {/if}>
                                        utf16_persian_ci
                                    </option>
                                    <option value="utf16_polish_ci"
                                            title="Polish, case-insensitive" {if $col eq 'utf16_polish_ci'} selected="selected" {/if}>
                                        utf16_polish_ci
                                    </option>
                                    <option value="utf16_roman_ci"
                                            title="West European, case-insensitive" {if $col eq 'utf16_roman_ci'} selected="selected" {/if}>
                                        utf16_roman_ci
                                    </option>
                                    <option value="utf16_romanian_ci"
                                            title="Romanian, case-insensitive" {if $col eq 'utf16_romanian_ci'} selected="selected" {/if}>
                                        utf16_romanian_ci
                                    </option>
                                    <option value="utf16_sinhala_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf16_sinhala_ci'} selected="selected" {/if}>
                                        utf16_sinhala_ci
                                    </option>
                                    <option value="utf16_slovak_ci"
                                            title="Slovak, case-insensitive" {if $col eq 'utf16_slovak_ci'} selected="selected" {/if}>
                                        utf16_slovak_ci
                                    </option>
                                    <option value="utf16_slovenian_ci"
                                            title="Slovenian, case-insensitive" {if $col eq 'utf16_slovenian_ci'} selected="selected" {/if}>
                                        utf16_slovenian_ci
                                    </option>
                                    <option value="utf16_spanish2_ci"
                                            title="Traditional Spanish, case-insensitive" {if $col eq 'utf16_spanish2_ci'} selected="selected" {/if}>
                                        utf16_spanish2_ci
                                    </option>
                                    <option value="utf16_spanish_ci"
                                            title="Spanish, case-insensitive" {if $col eq 'utf16_spanish_ci'} selected="selected" {/if}>
                                        utf16_spanish_ci
                                    </option>
                                    <option value="utf16_swedish_ci"
                                            title="Swedish, case-insensitive" {if $col eq 'utf16_swedish_ci'} selected="selected" {/if}>
                                        utf16_swedish_ci
                                    </option>
                                    <option value="utf16_turkish_ci"
                                            title="Turkish, case-insensitive" {if $col eq 'utf16_turkish_ci'} selected="selected" {/if}>
                                        utf16_turkish_ci
                                    </option>
                                    <option value="utf16_unicode_520_ci"
                                            title="Unicode (multilingual)" {if $col eq 'utf16_unicode_520_ci'} selected="selected" {/if}>
                                        utf16_unicode_520_ci
                                    </option>
                                    <option value="utf16_unicode_ci"
                                            title="Unicode (multilingual), case-insensitive" {if $col eq 'utf16_unicode_ci'} selected="selected" {/if}>
                                        utf16_unicode_ci
                                    </option>
                                    <option value="utf16_vietnamese_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf16_vietnamese_ci'} selected="selected" {/if}>
                                        utf16_vietnamese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="utf16le" title="UTF-16LE Unicode">
                                    <option value="utf16le_bin" title="unknown, Binary">utf16le_bin</option>
                                    <option value="utf16le_general_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf16le_general_ci'} selected="selected" {/if}>
                                        utf16le_general_ci
                                    </option>
                                </optgroup>
                                <optgroup label="utf32" title="UTF-32 Unicode">
                                    <option value="utf32_bin" title="unknown, Binary">utf32_bin</option>
                                    <option value="utf32_croatian_ci"
                                            title="Croatian, case-insensitive" {if $col eq 'utf32_croatian_ci'} selected="selected" {/if}>
                                        utf32_croatian_ci
                                    </option>
                                    <option value="utf32_czech_ci"
                                            title="Czech, case-insensitive" {if $col eq 'utf32_czech_ci'} selected="selected" {/if}>
                                        utf32_czech_ci
                                    </option>
                                    <option value="utf32_danish_ci"
                                            title="Danish, case-insensitive" {if $col eq 'utf32_danish_ci'} selected="selected" {/if}>
                                        utf32_danish_ci
                                    </option>
                                    <option value="utf32_esperanto_ci"
                                            title="Esperanto, case-insensitive" {if $col eq 'utf32_esperanto_ci'} selected="selected" {/if}>
                                        utf32_esperanto_ci
                                    </option>
                                    <option value="utf32_estonian_ci"
                                            title="Estonian, case-insensitive" {if $col eq 'utf32_estonian_ci'} selected="selected" {/if}>
                                        utf32_estonian_ci
                                    </option>
                                    <option value="utf32_general_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf32_general_ci'} selected="selected" {/if}>
                                        utf32_general_ci
                                    </option>
                                    <option value="utf32_german2_ci"
                                            title="German (phone book), case-insensitive" {if $col eq 'utf32_german2_ci'} selected="selected" {/if}>
                                        utf32_german2_ci
                                    </option>
                                    <option value="utf32_hungarian_ci"
                                            title="Hungarian, case-insensitive" {if $col eq 'utf32_hungarian_ci'} selected="selected" {/if}>
                                        utf32_hungarian_ci
                                    </option>
                                    <option value="utf32_icelandic_ci"
                                            title="Icelandic, case-insensitive" {if $col eq 'utf32_icelandic_ci'} selected="selected" {/if}>
                                        utf32_icelandic_ci
                                    </option>
                                    <option value="utf32_latvian_ci"
                                            title="Latvian, case-insensitive" {if $col eq 'utf32_latvian_ci'} selected="selected" {/if}>
                                        utf32_latvian_ci
                                    </option>
                                    <option value="utf32_lithuanian_ci"
                                            title="Lithuanian, case-insensitive" {if $col eq 'utf32_lithuanian_ci'} selected="selected" {/if}>
                                        utf32_lithuanian_ci
                                    </option>
                                    <option value="utf32_persian_ci"
                                            title="Persian, case-insensitive" {if $col eq 'utf32_persian_ci'} selected="selected" {/if}>
                                        utf32_persian_ci
                                    </option>
                                    <option value="utf32_polish_ci"
                                            title="Polish, case-insensitive" {if $col eq 'utf32_polish_ci'} selected="selected" {/if}>
                                        utf32_polish_ci
                                    </option>
                                    <option value="utf32_roman_ci"
                                            title="West European, case-insensitive" {if $col eq 'utf32_roman_ci'} selected="selected" {/if}>
                                        utf32_roman_ci
                                    </option>
                                    <option value="utf32_romanian_ci"
                                            title="Romanian, case-insensitive" {if $col eq 'utf32_romanian_ci'} selected="selected" {/if}>
                                        utf32_romanian_ci
                                    </option>
                                    <option value="utf32_sinhala_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf32_sinhala_ci'} selected="selected" {/if}>
                                        utf32_sinhala_ci
                                    </option>
                                    <option value="utf32_slovak_ci"
                                            title="Slovak, case-insensitive" {if $col eq 'utf32_slovak_ci'} selected="selected" {/if}>
                                        utf32_slovak_ci
                                    </option>
                                    <option value="utf32_slovenian_ci"
                                            title="Slovenian, case-insensitive" {if $col eq 'utf32_slovenian_ci'} selected="selected" {/if}>
                                        utf32_slovenian_ci
                                    </option>
                                    <option value="utf32_spanish2_ci"
                                            title="Traditional Spanish, case-insensitive" {if $col eq 'utf32_spanish2_ci'} selected="selected" {/if}>
                                        utf32_spanish2_ci
                                    </option>
                                    <option value="utf32_spanish_ci"
                                            title="Spanish, case-insensitive" {if $col eq 'utf32_spanish_ci'} selected="selected" {/if}>
                                        utf32_spanish_ci
                                    </option>
                                    <option value="utf32_swedish_ci"
                                            title="Swedish, case-insensitive" {if $col eq 'utf32_swedish_ci'} selected="selected" {/if}>
                                        utf32_swedish_ci
                                    </option>
                                    <option value="utf32_turkish_ci"
                                            title="Turkish, case-insensitive" {if $col eq 'utf32_turkish_ci'} selected="selected" {/if}>
                                        utf32_turkish_ci
                                    </option>
                                    <option value="utf32_unicode_520_ci"
                                            title="Unicode (multilingual)" {if $col eq 'utf32_unicode_520_ci'} selected="selected" {/if}>
                                        utf32_unicode_520_ci
                                    </option>
                                    <option value="utf32_unicode_ci"
                                            title="Unicode (multilingual), case-insensitive" {if $col eq 'utf32_unicode_ci'} selected="selected" {/if}>
                                        utf32_unicode_ci
                                    </option>
                                    <option value="utf32_vietnamese_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf32_vietnamese_ci'} selected="selected" {/if}>
                                        utf32_vietnamese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="utf8" title="UTF-8 Unicode">
                                    <option value="utf8_bin"
                                            title="Unicode (multilingual), Binary" {if $col eq 'utf8_bin'} selected="selected" {/if}>
                                        utf8_bin
                                    </option>
                                    <option value="utf8_croatian_ci"
                                            title="Croatian, case-insensitive" {if $col eq 'utf8_croatian_ci'} selected="selected" {/if}>
                                        utf8_croatian_ci
                                    </option>
                                    <option value="utf8_czech_ci"
                                            title="Czech, case-insensitive" {if $col eq 'utf8_czech_ci'} selected="selected" {/if}>
                                        utf8_czech_ci
                                    </option>
                                    <option value="utf8_danish_ci"
                                            title="Danish, case-insensitive" {if $col eq 'utf8_danish_ci'} selected="selected" {/if}>
                                        utf8_danish_ci
                                    </option>
                                    <option value="utf8_esperanto_ci"
                                            title="Esperanto, case-insensitive" {if $col eq 'utf8_esperanto_ci'} selected="selected" {/if}>
                                        utf8_esperanto_ci
                                    </option>
                                    <option value="utf8_estonian_ci"
                                            title="Estonian, case-insensitive" {if $col eq 'utf8_estonian_ci'} selected="selected" {/if}>
                                        utf8_estonian_ci
                                    </option>
                                    <option value="utf8_general_ci" title="Unicode (multilingual), case-insensitive"
                                            {if $col eq 'utf8_general_ci'} selected="selected" {/if}>utf8_general_ci
                                    </option>
                                    <option value="utf8_general_mysql500_ci"
                                            title="Unicode (multilingual)" {if $col eq 'utf8_general_mysql500_ci'} selected="selected" {/if}>
                                        utf8_general_mysql500_ci
                                    </option>
                                    <option value="utf8_german2_ci"
                                            title="German (phone book), case-insensitive" {if $col eq 'utf8_german2_ci'} selected="selected" {/if}>
                                        utf8_german2_ci
                                    </option>
                                    <option value="utf8_hungarian_ci"
                                            title="Hungarian, case-insensitive" {if $col eq 'utf8_hungarian_ci'} selected="selected" {/if}>
                                        utf8_hungarian_ci
                                    </option>
                                    <option value="utf8_icelandic_ci"
                                            title="Icelandic, case-insensitive" {if $col eq 'utf8_icelandic_ci'} selected="selected" {/if}>
                                        utf8_icelandic_ci
                                    </option>
                                    <option value="utf8_latvian_ci"
                                            title="Latvian, case-insensitive" {if $col eq 'utf8_latvian_ci'} selected="selected" {/if}>
                                        utf8_latvian_ci
                                    </option>
                                    <option value="utf8_lithuanian_ci"
                                            title="Lithuanian, case-insensitive" {if $col eq 'utf8_lithuanian_ci'} selected="selected" {/if}>
                                        utf8_lithuanian_ci
                                    </option>
                                    <option value="utf8_persian_ci"
                                            title="Persian, case-insensitive" {if $col eq 'utf8_persian_ci'} selected="selected" {/if}>
                                        utf8_persian_ci
                                    </option>
                                    <option value="utf8_polish_ci"
                                            title="Polish, case-insensitive" {if $col eq 'utf8_polish_ci'} selected="selected" {/if}>
                                        utf8_polish_ci
                                    </option>
                                    <option value="utf8_roman_ci"
                                            title="West European, case-insensitive" {if $col eq 'utf8_roman_ci'} selected="selected" {/if}>
                                        utf8_roman_ci
                                    </option>
                                    <option value="utf8_romanian_ci"
                                            title="Romanian, case-insensitive" {if $col eq 'utf8_romanian_ci'} selected="selected" {/if}>
                                        utf8_romanian_ci
                                    </option>
                                    <option value="utf8_sinhala_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf8_sinhala_ci'} selected="selected" {/if}>
                                        utf8_sinhala_ci
                                    </option>
                                    <option value="utf8_slovak_ci"
                                            title="Slovak, case-insensitive" {if $col eq 'utf8_slovak_ci'} selected="selected" {/if}>
                                        utf8_slovak_ci
                                    </option>
                                    <option value="utf8_slovenian_ci"
                                            title="Slovenian, case-insensitive" {if $col eq 'utf8_slovenian_ci'} selected="selected" {/if}>
                                        utf8_slovenian_ci
                                    </option>
                                    <option value="utf8_spanish2_ci"
                                            title="Traditional Spanish, case-insensitive" {if $col eq 'utf8_spanish2_ci'} selected="selected" {/if}>
                                        utf8_spanish2_ci
                                    </option>
                                    <option value="utf8_spanish_ci"
                                            title="Spanish, case-insensitive" {if $col eq 'utf8_spanish_ci'} selected="selected" {/if}>
                                        utf8_spanish_ci
                                    </option>
                                    <option value="utf8_swedish_ci"
                                            title="Swedish, case-insensitive" {if $col eq 'utf8_swedish_ci'} selected="selected" {/if}>
                                        utf8_swedish_ci
                                    </option>
                                    <option value="utf8_turkish_ci"
                                            title="Turkish, case-insensitive" {if $col eq 'utf8_turkish_ci'} selected="selected" {/if}>
                                        utf8_turkish_ci
                                    </option>
                                    <option value="utf8_unicode_520_ci"
                                            title="Unicode (multilingual)" {if $col eq 'utf8_unicode_520_ci'} selected="selected" {/if}>
                                        utf8_unicode_520_ci
                                    </option>
                                    <option value="utf8_unicode_ci"
                                            title="Unicode (multilingual), case-insensitive" {if $col eq 'utf8_unicode_ci'} selected="selected" {/if}>
                                        utf8_unicode_ci
                                    </option>
                                    <option value="utf8_vietnamese_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf8_vietnamese_ci'} selected="selected" {/if}>
                                        utf8_vietnamese_ci
                                    </option>
                                </optgroup>
                                <optgroup label="utf8mb4" title="UTF-8 Unicode">
                                    <option value="utf8mb4_bin"
                                            title="Unicode (multilingual), Binary" {if $col eq 'utf8mb4_bin'} selected="selected" {/if}>
                                        utf8mb4_bin
                                    </option>
                                    <option value="utf8mb4_croatian_ci"
                                            title="Croatian, case-insensitive" {if $col eq 'utf8mb4_croatian_ci'} selected="selected" {/if}>
                                        utf8mb4_croatian_ci
                                    </option>
                                    <option value="utf8mb4_czech_ci"
                                            title="Czech, case-insensitive" {if $col eq 'utf8mb4_czech_ci'} selected="selected" {/if}>
                                        utf8mb4_czech_ci
                                    </option>
                                    <option value="utf8mb4_danish_ci"
                                            title="Danish, case-insensitive" {if $col eq 'utf8mb4_danish_ci'} selected="selected" {/if}>
                                        utf8mb4_danish_ci
                                    </option>
                                    <option value="utf8mb4_esperanto_ci"
                                            title="Esperanto, case-insensitive" {if $col eq 'utf8mb4_esperanto_ci'} selected="selected" {/if}>
                                        utf8mb4_esperanto_ci
                                    </option>
                                    <option value="utf8mb4_estonian_ci"
                                            title="Estonian, case-insensitive" {if $col eq 'utf8mb4_estonian_ci'} selected="selected" {/if}>
                                        utf8mb4_estonian_ci
                                    </option>
                                    <option value="utf8mb4_general_ci"
                                            title="Unicode (multilingual), case-insensitive" {if $col eq 'utf8mb4_general_ci'} selected="selected" {/if}>
                                        utf8mb4_general_ci
                                    </option>
                                    <option value="utf8mb4_german2_ci"
                                            title="German (phone book), case-insensitive" {if $col eq 'utf8mb4_german2_ci'} selected="selected" {/if}>
                                        utf8mb4_german2_ci
                                    </option>
                                    <option value="utf8mb4_hungarian_ci"
                                            title="Hungarian, case-insensitive" {if $col eq 'utf8mb4_hungarian_ci'} selected="selected" {/if}>
                                        utf8mb4_hungarian_ci
                                    </option>
                                    <option value="utf8mb4_icelandic_ci"
                                            title="Icelandic, case-insensitive" {if $col eq 'utf8mb4_icelandic_ci'} selected="selected" {/if}>
                                        utf8mb4_icelandic_ci
                                    </option>
                                    <option value="utf8mb4_latvian_ci"
                                            title="Latvian, case-insensitive" {if $col eq 'utf8mb4_latvian_ci'} selected="selected" {/if}>
                                        utf8mb4_latvian_ci
                                    </option>
                                    <option value="utf8mb4_lithuanian_ci"
                                            title="Lithuanian, case-insensitive" {if $col eq 'utf8mb4_lithuanian_ci'} selected="selected" {/if}>
                                        utf8mb4_lithuanian_ci
                                    </option>
                                    <option value="utf8mb4_persian_ci"
                                            title="Persian, case-insensitive" {if $col eq 'utf8mb4_persian_ci'} selected="selected" {/if}>
                                        utf8mb4_persian_ci
                                    </option>
                                    <option value="utf8mb4_polish_ci"
                                            title="Polish, case-insensitive" {if $col eq ''} selected="selected" {/if}>
                                        utf8mb4_polish_ci
                                    </option>
                                    <option value="utf8mb4_roman_ci"
                                            title="West European, case-insensitive" {if $col eq 'utf8mb4_roman_ci'} selected="selected" {/if}>
                                        utf8mb4_roman_ci
                                    </option>
                                    <option value="utf8mb4_romanian_ci"
                                            title="Romanian, case-insensitive" {if $col eq 'utf8mb4_romanian_ci'} selected="selected" {/if}>
                                        utf8mb4_romanian_ci
                                    </option>
                                    <option value="utf8mb4_sinhala_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf8mb4_sinhala_ci'} selected="selected" {/if}>
                                        utf8mb4_sinhala_ci
                                    </option>
                                    <option value="utf8mb4_slovak_ci"
                                            title="Slovak, case-insensitive" {if $col eq ''} selected="selected" {/if}>
                                        utf8mb4_slovak_ci
                                    </option>
                                    <option value="utf8mb4_slovenian_ci"
                                            title="Slovenian, case-insensitive" {if $col eq 'utf8mb4_slovenian_ci'} selected="selected" {/if}>
                                        utf8mb4_slovenian_ci
                                    </option>
                                    <option value="utf8mb4_spanish2_ci"
                                            title="Traditional Spanish, case-insensitive" {if $col eq 'utf8mb4_spanish2_ci'} selected="selected" {/if}>
                                        utf8mb4_spanish2_ci
                                    </option>
                                    <option value="utf8mb4_spanish_ci"
                                            title="Spanish, case-insensitive" {if $col eq 'utf8mb4_spanish_ci'} selected="selected" {/if}>
                                        utf8mb4_spanish_ci
                                    </option>
                                    <option value="utf8mb4_swedish_ci"
                                            title="Swedish, case-insensitive" {if $col eq 'utf8mb4_swedish_ci'} selected="selected" {/if}>
                                        utf8mb4_swedish_ci
                                    </option>
                                    <option value="utf8mb4_turkish_ci"
                                            title="Turkish, case-insensitive" {if $col eq 'utf8mb4_turkish_ci'} selected="selected" {/if}>
                                        utf8mb4_turkish_ci
                                    </option>
                                    <option value="utf8mb4_unicode_520_ci"
                                            title="Unicode (multilingual)" {if $col eq 'utf8mb4_unicode_520_ci'} selected="selected" {/if}>
                                        utf8mb4_unicode_520_ci
                                    </option>
                                    <option value="utf8mb4_unicode_ci"
                                            title="Unicode (multilingual), case-insensitive" {if $col eq 'utf8mb4_unicode_ci'} selected="selected" {/if}>
                                        utf8mb4_unicode_ci
                                    </option>
                                    <option value="utf8mb4_vietnamese_ci"
                                            title="unknown, case-insensitive" {if $col eq 'utf8mb4_vietnamese_ci'} selected="selected" {/if}>
                                        utf8mb4_vietnamese_ci
                                    </option>
                                </optgroup>
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                    </form>

                </div>
            </div>


        </div>

    </div>
{/block}
