<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use function Livewire\str;

function slug($title)
{
    return Str::slug($title) . '-' . Str::random(5);
}

function getRandomName()
{
    return Str::random(5);
}

function getRandomFileName()
{
    return Str::random(16);
}

function deleteImage($path)
{
    if (File::exists('images/' . $path)) {
        File::delete('images/' . $path);
    }
}

function deleteFile($path)
{
    if (File::exists('files/' . $path)) {
        File::delete('files/' . $path);
    }
}

function sendSMS($mobile, $otp, $template)
{
    $API_KEY = '5c4d03c7-094d-11ec-a13b-0200cd936042';
    $url = 'https://2factor.in/API/V1/' . $API_KEY . '/SMS/' . $mobile . '/' . $otp . '/' . $template;
    try {
        return Http::get($url);
    } catch (Exception $e) {
        return ['Status' => 'Failed'];
    }
}

function sendOrderStatusSMS($mobile, $id, $status)
{
    $API_KEY = '5c4d03c7-094d-11ec-a13b-0200cd936042';
    $url = 'https://2factor.in/API/V1/' . $API_KEY . '/ADDON_SERVICES/SEND/TSMS';
    $header = [
        'From' => 'SKYORD',
        'To' => $mobile,
        'TemplateName' => 'order',
        'VAR1' => strval($id),
        'VAR2' => $status,
    ];
    try {
        $response = Http::post($url, $header);
        if ($response->successful() && $response['Status'] == 'Success') {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}

function getUpperStatus($status)
{
    if ($status == config('constants.orderStatus.outForDelivery'))
        return "OUT FOR DELIVERY";
    else
        return strtoupper($status);
}

function validatePhoneNumber($number)
{
    return preg_match("/^[6-9][0-9]{9}$/", $number);
}

function validateOTP($otp)
{
    return preg_match("/^[0-9]{6}$/", $otp);
}

function validatePincode($pincode)
{
    return preg_match("/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/", $pincode);
}

function numberTowords(float $amount)
{
    $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
    // Check if there is any number after decimal
    $amt_hundred = null;
    $count_length = strlen($num);
    $x = 0;
    $string = array();
    $change_words = array(
        0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
    );
    $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($x < $count_length) {
        $get_divider = ($x == 2) ? 10 : 100;
        $amount = floor($num % $get_divider);
        $num = floor($num / $get_divider);
        $x += $get_divider == 10 ? 1 : 2;
        if ($amount) {
            $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
            $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
            $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
         ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
         ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
        } else $string[] = null;
    }
    $implode_to_Rupees = implode('', array_reverse($string));
    $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
    return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
