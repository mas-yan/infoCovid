<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class kendalController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        header('Content-Type: application/json');
        $url = file_get_contents("https://corona.kendalkab.go.id/");
        $path = new \DOMDocument();

        libxml_use_internal_errors(true);
        if (!empty($url)) {
            $path->loadHTML($url);
            libxml_clear_errors();
            $xpath = new \DOMXPath($path);

            $update = $xpath->query('/html/body/div[1]/section[2]/div[1]/div/div/div[1]/p/text()[5]');
            $konfirmasi = $xpath->query('/html/body/div[1]/section[2]/div[1]/div/div/div[2]/div[1]/div/div[1]/div/div/div/div[1]/div/div/h2');
            $sembuh = $xpath->query('/html/body/div[1]/section[2]/div[1]/div/div/div[2]/div[1]/div/div[1]/div/div/div/div[2]/div[1]/div[1]/div/h2');
            $dirawat = $xpath->query('//html/body/div[1]/section[2]/div[1]/div/div/div[2]/div[1]/div/div[1]/div/div/div/div[2]/div[1]/div[2]/div/h2');
            $isoman = $xpath->query('/html/body/div[1]/section[2]/div[1]/div/div/div[2]/div[1]/div/div[1]/div/div/div/div[2]/div[1]/div[3]/div/h2');
            $meninggal = $xpath->query('/html/body/div[1]/section[2]/div[1]/div/div/div[2]/div[1]/div/div[1]/div/div/div/div[2]/div[2]/div/div/h2');
            $suspek = $xpath->query('/html/body/div[1]/section[2]/div[1]/div/div/div[2]/div[1]/div/div[2]/div/div/div/div/div/h2/text()');
            $probable = $xpath->query('/html/body/div[1]/section[2]/div[1]/div/div/div[2]/div[2]/div/div[1]/div/div/div/div/div/div/h2');
            $perjalanan = $xpath->query('/html/body/div[1]/section[2]/div[1]/div/div/div[2]/div[2]/div/div[2]/div/div/div/div/div/div/h2');
            $kontak = $xpath->query('/html/body/div[1]/section[2]/div[1]/div/div/div[2]/div[3]/div/div[2]/div/div/div/div/div/div/h2');

            $puskesmas = $xpath->query('//*[@id="example1"]/tbody/tr/td[2]');
            $data_perjalanan = $xpath->query('//*[@id="example1"]/tbody/tr/td[3]');
            $data_kontak = $xpath->query('//*[@id="example1"]/tbody/tr/td[4]');
            $data_suspek = $xpath->query('//*[@id="example1"]/tbody/tr/td[5]');
            $data_probable = $xpath->query('//*[@id="example1"]/tbody/tr/td[6]');
            $data_konfirmasi = $xpath->query('//*[@id="example1"]/tbody/tr/td[7]');

            $update = substr($update[0]->nodeValue, 15, -60);

            $kontak = preg_replace('/\s+/', '', $kontak[0]->nodeValue);
            $perjalanan = preg_replace('/\s+/', '', $perjalanan[0]->nodeValue);
            $probable = preg_replace('/\s+/', '', $probable[0]->nodeValue);
            $meninggal = preg_replace('/\s+/', '', $meninggal[0]->nodeValue);
            $isoman = preg_replace('/\s+/', '', $isoman[0]->nodeValue);
            $dirawat = preg_replace('/\s+/', '', $dirawat[0]->nodeValue);
            $konfirmasi = preg_replace('/\s+/', '', $konfirmasi[0]->nodeValue);
            $sembuh = preg_replace('/\s+/', '', $sembuh[0]->nodeValue);
            $suspek = preg_replace('/\s+/', '', $suspek[0]->nodeValue);

            foreach ($puskesmas as $health) {
                $puskesmas_list[] = [
                    'puskesmas' => $health->nodeValue
                ];
            }

            foreach ($data_kontak as $dkontak) {
                $kontak_list[] = [
                    'kontak' => $dkontak->nodeValue
                ];
            }

            foreach ($data_suspek as $dsuspek) {
                $suspek_list[] = [
                    'suspek' => $dsuspek->nodeValue
                ];
            }

            foreach ($data_probable as $dprobable) {
                $probable_list[] = [
                    'probable' => $dprobable->nodeValue
                ];
            }

            foreach ($data_konfirmasi as $dkonfirmasi) {
                $konfirmasi_list[] = [
                    'konfirmasi' => $dkonfirmasi->nodeValue
                ];
            }

            $i = 0;
            foreach ($data_perjalanan as $dperjalanan) {
                $confirm_list[] = [
                    'puskesmas' => $puskesmas_list[$i]['puskesmas'],
                    'perjalanan' => $dperjalanan->nodeValue,
                    'kontak' => $kontak_list[$i]['kontak'],
                    'suspek' => $suspek_list[$i]['suspek'],
                    'probable' => $probable_list[$i]['probable'],
                    'konfirmasi' => $konfirmasi_list[$i]['konfirmasi'],
                ];
                $i++;
            }
            $response = array(
                'status' => true,
                'message' => 'Get List Data Successfully.',
                'last_update' => $update,
                'total' => [
                    'konfirmasi' => [
                        'total' => $konfirmasi,
                        'sembuh' => $sembuh,
                        'dirawat' => $dirawat,
                        'isoman' => $isoman,
                        'isoman' => $isoman,
                        'meninggal' => $meninggal,
                    ],
                    'suspek' => $suspek,
                    'probable' => $probable,
                    'pelaku perjalanan' => $perjalanan,
                    'kontak erat' => $kontak,
                ],
                'data' => $confirm_list,
            );
            header('Content-Type: application/json');
            // echo json_encode($response);
            return response()->json($response);
        }
    }
}
