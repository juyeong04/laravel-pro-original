<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    function map(){
        return view('map');
    }

    function getopt($opt,$gu,$sopt)
    {
        $lat = 0;
        $lng = 0;
        switch ($gu) {
            case "구 선택":
                $lat = 35.8714354;
                $lng = 128.601445;
                break;
            case "달서구":
                $lat = 35.82997744;
                $lng = 128.5325905;
                break;
            case "달성군":
                $lat = 35.77475029;
                $lng = 128.4313995;
                break;
            case "북구":
                $lat = 35.8858646;
                $lng = 128.5828924;
                break;
            case "남구":
                $lat = 35.84621351;
                $lng = 128.597702;
                break;
            case "서구":
                $lat = 35.87194054;
                $lng = 128.5591601;
                break;
            case "중구":
                $lat = 35.86952722;
                $lng = 128.6061745;
                break;
            case "수성구":
                $lat = 35.85835148;
                $lng = 128.6307011;
                break;
            case "동구":
                $lat = 35.88682728;
                $lng = 128.6355584;
                break;
            default:
                // 기본값 설정
                $lat = 0;
                $lng = 0;
                break;
        }

        $info['latlng']=['lat'=>$lat,'lng'=>$lng];
        $array = explode(',', $opt);
        $soptarray = explode(',', $sopt);
         // '구 선택'이 아닐 때
        if($gu != '구 선택'){
            // 매매가 평균 구하는 쿼리
            $info['savg']=DB::table('s_infos')
            ->select('p_deposit')
            ->where('s_add', 'LIKE', $gu.'%')
            ->where('s_type','매매')
            ->get();
            // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
            if(count($array)==1 && $array[0] != 1){
                $info['sinfo'] =DB::table('s_infos AS sinfo')
                ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
                ->select('sinfo.*', 'phot.url')
                ->where('sinfo.s_add', 'LIKE', $gu.'%')
                ->whereIn('sinfo.s_type', [$array[0]])
                ->where('phot.mvp_photo', '1')
                ->get();
            return $info;
            }
            // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
            else if(count($array)==2){
                $info['sinfo'] =DB::table('s_infos AS sinfo')
                ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
                ->select('sinfo.*', 'phot.url')
                ->where('sinfo.s_add', 'LIKE', $gu.'%')
                ->whereIn('sinfo.s_type', [$array[0], $array[1]])
                ->where('phot.mvp_photo', '1')
                ->get();
            return $info;
            }
            // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
            else if(count($array)==3){
                $info['sinfo'] =DB::table('s_infos AS sinfo')
                ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
                ->select('sinfo.*', 'phot.url')
                ->where('sinfo.s_add', 'LIKE', $gu.'%')
                ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
                ->where('phot.mvp_photo', '1')
                ->get();
            return $info;
            // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때( 구 만 검색)
            }else if($array[0] == 1){
                $info['sinfo'] =DB::table('s_infos AS sinfo')
                ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
                ->select('sinfo.*', 'phot.url')
                ->where('sinfo.s_add', 'LIKE', $gu.'%')
                ->where('phot.mvp_photo', '1')
                ->get();
                return $info;
            }
    // "구 선택"일 때
        } else {
            $info['savg']=DB::table('s_infos')
            ->select('p_deposit')
            ->where('s_type','매매')
            ->get();
            // "구 선택"일 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
            if(count($array)==1 && $array[0] != 1){
                $info['sinfo'] =DB::table('s_infos AS sinfo')
                ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
                ->select('sinfo.*', 'phot.url')
                ->whereIn('sinfo.s_type', [$array[0]])
                ->where('phot.mvp_photo', '1')
                ->get();
            return $info;
            }
            // "구 선택"일 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
            else if(count($array)==2){
                $info['sinfo'] =DB::table('s_infos AS sinfo')
                ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
                ->select('sinfo.*', 'phot.url')
                ->whereIn('sinfo.s_type', [$array[0], $array[1]])
                ->where('phot.mvp_photo', '1')
                ->get();
            return $info;
            }
            // "구 선택"일 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
            else if(count($array)==3){
                $info['sinfo'] =DB::table('s_infos AS sinfo')
                ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
                ->select('sinfo.*', 'phot.url')
                ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
                ->where('phot.mvp_photo', '1')
                ->get();
            return $info;
            // "구 선택"일 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때(구 선택일 때는 아무 값도 설정하지 않았기 때문에 전체값을 넘겨준다.)
            } else if($array[0] == 1){
                $info['sinfo'] =DB::table('s_infos AS sinfo')
                ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
                ->select('sinfo.*', 'phot.url')
                ->where('phot.mvp_photo', '1')
                ->get();
            return $info;
            }
        }
    }
}
