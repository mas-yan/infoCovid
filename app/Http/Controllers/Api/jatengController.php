<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class jatengController extends Controller
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
        $url = file_get_contents("https://corona.jatengprov.go.id/data");
        $path = new \DOMDocument();

        libxml_use_internal_errors(true);
        if (!empty($url)) {
            $path->loadHTML($url);
            libxml_clear_errors();
            $xpath = new \DOMXPath($path);

            $cities = $xpath->query('//*[@id="pills-domisili3"]/div[1]/table/tbody/tr/td[1]');
            $confirmed = $xpath->query('//*[@id="pills-domisili3"]/div[1]/table/tbody/tr/td[2]');
            $dirawat = $xpath->query('//*[@id="pills-domisili3"]/div[1]/table/tbody/tr/td[3]');
            $recovered = $xpath->query('//*[@id="pills-domisili3"]/div[1]/table/tbody/tr/td[4]');
            $deaths = $xpath->query('//*[@id="pills-domisili3"]/div[1]/table/tbody/tr/td[5]');
            $suspects = $xpath->query('//*[@id="pills-domisili3"]/div[1]/table/tbody/tr/td[6]');
            $update = $xpath->query('/html/body/section[2]/div/div/p/span/b');
            $data_aktif = $xpath->query('//span[@class="font-counter"]/text()');
            $update = substr($update[0]->nodeValue, 34, -36);

            foreach ($cities as $city) {
                $city_list[] = [
                    'kabkota' => $city->nodeValue
                ];
            }

            foreach ($data_aktif as $result) {
                $aktif[] = [
                    $string = str_replace(' ', '', $result->nodeValue)
                ];
            }

            foreach ($dirawat as $rawat) {
                $rawat_list[] = [
                    'Dirawat' => $rawat->nodeValue
                ];
            }

            foreach ($recovered as $recover) {
                $recover_list[] = [
                    'Sembuh' => $recover->nodeValue
                ];
            }
            foreach ($deaths as $death) {
                $death_list[] = [
                    'Meninggal' => $death->nodeValue
                ];
            }

            foreach ($suspects as $suspect) {
                $suspect_list[] = [
                    'Suspek' => $suspect->nodeValue
                ];
            }

            $i = 0;
            foreach ($confirmed as $confirm) {
                $confirm_list[] = [
                    'Kota' => $city_list[$i]['kabkota'],
                    'Terkonfirmasi' => $confirm->nodeValue,
                    'Dirawat' => $rawat_list[$i]['Dirawat'],
                    'Sembuh' => $recover_list[$i]['Sembuh'],
                    'Sembuh' => $recover_list[$i]['Sembuh'],
                    'Meninggal' => $death_list[$i]['Meninggal'],
                    'Suspek' => $suspect_list[$i]['Suspek'],
                ];
                $i++;
            }
            $response = array(
                'status' => true,
                'message' => 'Get List Data Successfully.',
                'last_update' => $update,
                'Konfirmasi' => [
                    'aktif' => $aktif[0][0],
                    'sembuh' => $aktif[2][0],
                    'meninggal' => $aktif[4][0],
                    'total' => $aktif[6][0],
                    'suspek' => $aktif[8][0],
                ],
                'data' => $confirm_list,
            );
            header('Content-Type: application/json');
            // echo json_encode($response);
            return response()->json($response);
        }
    }
}
