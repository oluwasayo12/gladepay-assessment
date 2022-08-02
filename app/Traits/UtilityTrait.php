<?php


namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

trait UtilityTrait
{
 
    public function formatPhoneNumber($destination)
    {
        if ($destination === '') {
            return false;
        }

        $destination = str_replace(" ", ',', $destination);
        $destination = str_replace("\n", ',', $destination);
        $destination = str_replace("\r", ',', $destination);
        $destination = str_replace(",,", ',', $destination);

        $phone_prefix_mtel = array(
            '234804');

        $phone_prefix_reltel = array(
            '234707');

        $phone_prefix_starcomms = array(
            '2347028',
            '2347029',
            '234819');

        $phone_prefix_visafone = array(
            '2347028',
            '2347029',
            '234819');

        $phone_prefix_multilinks = array(
            '2347027',
            '234709');

        $phone_prefix_airtel = array(
            '234701',
            '234708',
            '234802',
            '234808',
            '234812',
            '234902');

        $phone_prefix_glo = array(
            '234705',
            '234805',
            '234807',
            '234811',
            '234815',
            '234905');
        $phone_prefix_etisalat = array(
            '234809',
            '234817',
            '234818',
            '234909');

        $phone_prefix_mtn = array(
            '234703',
            '234706',
            '234803',
            '234806',
            '234810',
            '234813',
            '234814',
            '234816',
            '234903');
        $explode = explode(',', $destination);
        $explode = array_unique($explode);


        $test = array();
        $international = 0;
        $mtel = 0;
        $reltel = 0;
        $starcomms = 0;
        $visafone = 0;
        $multilinks = 0;
        $airtel = 0;
        $glo = 0;
        $etisalat = 0;
        $mtn = 0;
        $total_recipient_numbers = 0;
        $other_numbers = 0;
        $other_numbers_array = array();
        foreach ($explode as $value) {
            # code...
            if (substr($value, 0, 3) == '009') {
                # code...
                //$test[] = preg_replace('/009/', '', $value, 1);
                $value = substr($value, 3);
                $test[] = $value;
            } elseif (substr($value, 0, 1) == '+') {
                # code...
                //$test[] = str_replace("+", '', $value);
                $value = substr($value, 1);
                $test[] = $value;
            } elseif (substr($value, 0, 1) == '0') {
                # code...
                //$test[] = preg_replace('/0/', '234', $value, 1);
                $value = '234' . substr($value, 1);
                $test[] = $value;
            } elseif (substr($value, 0, 3) == '234') {
                # code...
                $test[] = $value;
            }

            if (substr($value, 0, 3) !== '234') {
                $international++;
            }

            if ((substr($value, 0, 3) == '234') && (
                (!in_array(substr($value, 0, 6), $phone_prefix_mtn)) && (!in_array(substr($value, 0, 6), $phone_prefix_mtel)) && (!in_array(substr($value, 0, 6), $phone_prefix_multilinks)) && (!in_array(substr($value, 0, 6), $phone_prefix_starcomms)) && (!in_array(substr($value, 0, 6), $phone_prefix_visafone)) && (!in_array(substr($value, 0, 6), $phone_prefix_etisalat)) && (!in_array(substr($value, 0, 6), $phone_prefix_glo)) && (!in_array(substr($value, 0, 6), $phone_prefix_airtel)) && (!in_array(substr($value, 0, 6), $phone_prefix_reltel))
            )) {
                # code...
                $other_numbers++;
                $other_numbers_array[] = $value;
            }

            foreach ($phone_prefix_mtel as $value1) {
                if (substr($value, 0, 6) == $value1) {
                    # code...
                    $mtel++;
                }
            }

            foreach ($phone_prefix_mtn as $value2) {
                if (substr($value, 0, 6) == $value2) {
                    # code...
                    $mtn++;
                }
            }

            foreach ($phone_prefix_multilinks as $value3) {
                if (substr($value, 0, 6) == $value3) {
                    # code...
                    $multilinks++;
                }
            }
            foreach ($phone_prefix_starcomms as $value4) {
                if (substr($value, 0, 6) == $value4) {
                    # code...
                    $starcomms++;
                }
            }

            foreach ($phone_prefix_visafone as $value5) {
                if (substr($value, 0, 6) == $value5) {
                    # code...
                    $visafone++;
                }
            }

            foreach ($phone_prefix_etisalat as $value6) {
                if (substr($value, 0, 6) == $value6) {
                    # code...
                    $etisalat++;
                }
            }

            foreach ($phone_prefix_glo as $value7) {
                if (substr($value, 0, 6) == $value7) {
                    # code...
                    $glo++;
                }
            }

            foreach ($phone_prefix_reltel as $value8) {
                if (substr($value, 0, 6) == $value8) {
                    # code...
                    $reltel++;
                }
            }

            foreach ($phone_prefix_airtel as $value9) {
                if (substr($value, 0, 6) == $value9) {
                    # code...
                    $airtel++;
                }
            }

            $total_recipient_numbers++;
        }
        return implode(',', $test);
    }
}
