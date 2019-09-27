<?php

namespace App;


use Carbon\Carbon;
use App\Consts;

use Auth;
use DB;
use App;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Log;

class Utils
{
    public static function makeQrCode($text)
    {
        // check if the qr code already exist then return it
        // otherwise, generate new one and return
        $path = storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR
            . "qr_codes" . DIRECTORY_SEPARATOR;

        $filename = $path . $text . ".png";
        if (!file_exists($filename)) {
            QrCode::format('png')->size(220)->generate($text, $filename);
        }

        return "/storage/qr_codes/". $text .".png";
    }

    public static function isTesting()
    {
        return ENV('APP_ENV') == Consts::ENV_TESTING;
    }

    public static function getAllCoins() {

    }

    public static function isEqual($a, $b)
    {
        return abs($a - $b) < 1e-10;
    }

    public static function previous24hInMillis() {
        return Carbon::now()->subDay()->timestamp * 1000;
    }

    public static function previousDayInMillis($day) {
        return Carbon::now()->subDay($day)->timestamp * 1000;
    }

    public static function fixCurrencyName($currency)
    {
        if ($currency === Consts::CURRENCY_WBC) {
            return 'www';
        } else {
            return $currency;
        }
    }

    public static function todaySeoul() {
        return Carbon::today('Asia/Seoul');
    }

    public static function currentMilliseconds() {
        return round(microtime(true) * 1000);
    }

    public static function formatKrwAmount($amount) {
        return number_format(abs($amount));
    }

    public static function millisecondsToDateTime($timestamp, $timezoneOffsetInMins, $format) {
        return Utils::millisecondsToCarbon($timestamp, $timezoneOffsetInMins)->format($format);
    }

    public static function millisecondsToCarbon($timestamp, $timezoneOffsetInMins) {
        return Carbon::createFromTimestampUTC(floor($timestamp/1000))->subMinutes($timezoneOffsetInMins);
    }

    public static function dateTimeToMilliseconds($stringDate) {
        $date = !empty($stringDate) ? Carbon::parse($stringDate) : Carbon::now();
        return $date->timestamp * 1000 + $date->micro;
    }

    public static function setLocale($request) {
        $userService = new UserService();
        $userLocale = $userService->getCurrentUserLocale();
        if ($request->has('lang')) {
            $locale = $request->input('lang');

            if (in_array($locale, Consts::SUPPORTED_LOCALES)) {
                Session::put('user.locale', $locale);
            }
        }
        if (Session::has('user.locale')) {
            $locale = Session::get('user.locale');
            if ($locale !== $userLocale) {
                $userLocale = $userService->updateOrCreateUserLocale($locale);
            }
        }
        if ($userLocale !== App::getLocale()) {
            App::setLocale($userLocale);
        }
        return $userLocale;
    }

    public static function generateRandomString($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = strlen($keyspace) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    public static function createTransactionMessage($transaction)
    {
        $amount = number_format(abs($transaction->amount));
        $text = BigNumber::new($transaction->amount)->comp(0) > 0 ? 'new_deposit' : 'new_withdrawal';
        return __("admin.$text", [
                'amount' => $amount,
                'time' => Carbon::now(Consts::DEFAULT_TIMEZONE)->format('H:i:s')
            ],
            Consts::DEFAULT_USER_LOCALE);
    }

    public static function saveFileToStorage ($file, $id, $pathFolder, $prefixName = null) {
        $storagePath = 'public' . DIRECTORY_SEPARATOR . $pathFolder;
        $filename = $id . '_' .Utils::currentMilliseconds() . '.' . $file->getClientOriginalExtension();
        if (!empty($prefixName)) {
            $filename = $prefixName . '.' .$filename;
        }
        $file->storeAs($storagePath, $filename);
        return "/storage/$pathFolder/$filename";
    }

    public static function getSymbols ($symbol)
    {
        $symbol = strtolower($symbol);

        if (strpos($symbol, '/') == false){
            return;
        }

        $symbol = explode('/', $symbol);

        if ($symbol[0] === 'www') {
            $symbol[0] = 'wbc';
        }

        $currencyCoins = MasterdataService::getOneTable('coin_settings');

        $symbolData = $currencyCoins->first(function($pair) use ($symbol) {
            return $pair->coin === $symbol[0] && $pair->currency === $symbol[1];
        });

        if (! $symbolData){
            return null;
        }

        return $symbolData;
    }

    public static function currentTime() {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        return $date;
    }

    public static function yesterday() {
        $date = Carbon::yesterday('Asia/Ho_Chi_Minh');
        return $date;
    }

    public static function currentTimeStartOfDay() {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->startOfDay();
        return $date;
    }

    public static function currentTimeEndOfDay() {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->endOfDay();
        return $date;
    }

    public static function subMonths() {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30);
        return $date;
    }

    public static function startOfMonthTime() {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth();
        return $date;
    }

    public static function endOfMonthTime() {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth();
        return $date;
    }

    public static function startOfWeekTime() {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek();
        return $date;
    }

    public static function endOfWeekTime() {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->endOfWeek();
        return $date;
    }

    public static function currentTimeSeoul() {
        $date = Carbon::now('Asia/Seoul');
        $date->setTimezone('UTC');
        return $date->timestamp * 1000;
    }

    public static function getCurrentDateSeoul() {
        $date = Carbon::today('Asia/Seoul')->startOfDay();       
        //$date->setTimezone('UTC');       
        return $date->toDateTimeString();
    }

    public static function startTimeTodaySeoul() {
        $date = Carbon::today('Asia/Seoul')->startOfDay();
        $date->setTimezone('UTC');
        return $date->timestamp * 1000;
    }

    public static function startTimePrevDaySeoul() {
        $date = Carbon::yesterday('Asia/Seoul')->startOfDay();
        $date->setTimezone('UTC');
        return $date->timestamp * 1000;
    }

    public static function startYesterdaySeoul() {
        $date = Carbon::yesterday('Asia/Seoul')->startOfDay();
        $date->setTimezone('UTC');
        return $date;
    }
    public static function endYesterdaySeoul() {
        $date = Carbon::yesterday('Asia/Seoul')->endOfDay();
        $date->setTimezone('UTC');
        return $date;
    }

    public static function endTimeTodaySeoul() {
        $date = Carbon::today('Asia/Seoul')->endOfDay();
        $date->setTimezone('UTC');
        return $date->timestamp * 1000;
    }

    public static function startTimeOfDaySeoulBefore($day) {
        $date = Carbon::now('Asia/Seoul')->subDay($day)->startOfDay();
        $date->setTimezone('UTC');
        return $date->timestamp * 1000;
    }

    public static function endTimeOfDaySeoulBefore($day) {
        $date = Carbon::now('Asia/Seoul')->subDay($day)->endOfDay();
        $date->setTimezone('UTC');
        return $date->timestamp * 1000;
    }

    public static function dateToStartDateSeoul($datetime) {
        $date = Carbon::createFromFormat('Y-m-d', $datetime, 'Asia/Seoul')->startOfDay();
        $date->setTimezone('UTC');
        return $date->timestamp * 1000;
    }

    public static function dateToEndDateSeoul($datetime) {
        $date = Carbon::createFromFormat('Y-m-d', $datetime, 'Asia/Seoul')->endOfDay();
        $date->setTimezone('UTC');
        return $date->timestamp * 1000;
    }

    public static function startOfYearTime() {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->startOfYear();
        return $date;
    }

    public static function endOfYearTime() {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->endOfYear();
        return $date;
    }

    public static function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $str .= "\n"; // In case the searched variable is in the last line without \n
        $keyPosition = strpos($str, "{$envKey}=");
        $endOfLinePosition = strpos($str, PHP_EOL, $keyPosition);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
        $str = substr($str, 0, -1);

        file_put_contents($envFile, $str);
    }

    public static function formatStartDate($date) {
        $dateExplode = explode(' - ', $date);
        $startDate = (isset($dateExplode[0]) && !empty($dateExplode[0])) ? Carbon::parse($dateExplode[0])->format('Y-m-d') : Utils::subMonths()->format("Y-m-d");
        return $startDate;
    }

    public static function formatEndDate($date) {
        $dateExplode = explode(' - ', $date);
        $endDate = (isset($dateExplode[1]) && !empty($dateExplode[1])) ? Carbon::parse($dateExplode[1])->format('Y-m-d 23:59:59') : Utils::currentTime()->format("Y-m-d 23:59:59");
        return $endDate;
    }

    public static function formatStartDateWeek($date) {
        $dateExplode = explode(' - ', $date);
        $startDate = (isset($dateExplode[0]) && !empty($dateExplode[0])) ? Carbon::parse($dateExplode[0])->format('Y-m-d') : Utils::startOfWeekTime()->format("Y-m-d");
        return $startDate;
    }

    public static function formatEndDateWeek($date) {
        $dateExplode = explode(' - ', $date);
        $endDate = (isset($dateExplode[1]) && !empty($dateExplode[1])) ? Carbon::parse($dateExplode[1])->format('Y-m-d') : Utils::endOfWeekTime()->format("Y-m-d");
        return $endDate;
    }

    public static function formatStartMonth($date) {
        $dateExplode = explode(' - ', $date);
        $startDate = (isset($dateExplode[0]) && !empty($dateExplode[0])) ? Carbon::parse($dateExplode[0])->format('Y-m-d') : Utils::subMonths()->format("Y-m-d");
        return $startDate;
    }

    public static function formatEndMonth($date) {
        $dateExplode = explode(' - ', $date);
        $endDate = (isset($dateExplode[1]) && !empty($dateExplode[1])) ? Carbon::parse($dateExplode[1])->format('Y-m-d') : Utils::endOfMonthTime()->format("Y-m-d");
        return $endDate;
    }

    public static function formatStartDateForStaff($date) {
        $dateExplode = explode(' - ', $date);
        $startDate = (isset($dateExplode[0]) && !empty($dateExplode[0])) ? Carbon::createFromFormat('d/m/Y', $dateExplode[0])->format('Y-m-d') : Utils::subMonths()->format("Y-m-d");
        return $startDate;
    }

    public static function formatEndDateForStaff($date) {
        $dateExplode = explode(' - ', $date);
        $endDate = (isset($dateExplode[1]) && !empty($dateExplode[1])) ? Carbon::createFromFormat('d/m/Y', $dateExplode[1])->format('Y-m-d 23:59:59') : Utils::currentTime()->format("Y-m-d 23:59:59");
        return $endDate;
    }
}
